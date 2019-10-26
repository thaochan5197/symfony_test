import React from "react";
import PropTypes from "prop-types";
import {TextField, Avatar, Button, CssBaseline, Typography, Grid, Link, Box, Paper} from "@material-ui/core";
import {pink, grey} from "@material-ui/core/colors";
import LockOutlinedIcon from '@material-ui/icons/LockOutlined';
import {withStyles} from "@material-ui/core/styles";
import axios from "axios";

const styles = {
    button: {
        background: 'linear-gradient(45deg, #FE6B8B 30%, #FF8E53 90%)',
        color: '#fff',
        marginTop: '1rem',
        height: '50px'
    },
    wrapper: {
        display: 'flex',
        flexDirection: 'column',
        alignItems: 'center',
        marginTop: '6rem',
        padding: '40px'
    },
    avatar: {
        marginBottom: '0.75rem',
        background: pink[500]
    },
    copyright: {
        color: grey[600],
        textAlign: 'center',
        '& a': {
            color: grey[600]
        },
        '& a:hover': {
            color: pink[500]
        }
    },
    action: {
        marginTop: '1rem'
    },
    contentWrapper: {
        height: '100vh'
    },
    image: {
        backgroundImage: 'url(https://www.tokkoro.com/picsup/2808194-landscape-clouds-rock-mountain-forest-storm-road___landscape-nature-wallpapers.jpg)',
        backgroundRepeat: 'no-repeat',
        backgroundSize: 'cover',
        backgroundPosition: 'center',
    }
};

class LoginForm extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            _username: '',
            _password: '',

        };
        this.handleSubmit = this.handleSubmit.bind(this);
        this.handleChange = this.handleChange.bind(this);
    }
    handleChange(event) {
        this.setState({
            [event.target.name]: event.target.value
        });
    }
    handleSubmit(event) {
        event.preventDefault();
        const {_username, _password} = this.state;
        axios.post(
            Routing.generate("fos_user_security_login"),
            {
                _username: _username,
                _password: _password,
                _csrf_token: token,

            },
            {withCredentials: true}
        )
            .then(response=>{
                console.log(response);
                return response.json()
            })
            .then(data => {
                console.log(data);
            })
            .catch(error => {
                console.log("Login error", error);
            });
    }
    render() {
        const {classes} = this.props;
        return (
            <Grid container component="main" className={classes.contentWrapper}>
                <CssBaseline />
                <Grid item xs={false} sm={4} md={7} className={classes.image} />
                <Grid item xs={12} sm={8} md={5}>
                    <div className={classes.wrapper} component={Paper}>
                        <Avatar margin="normal" className={classes.avatar}>
                            <LockOutlinedIcon />
                        </Avatar>
                        <Typography
                            component="h1"
                            variant="h5"
                            margin="normal">
                            SIGN IN
                        </Typography>
                        <form onSubmit={this.handleSubmit}>
                            <TextField
                                variant="outlined"
                                label="Username"
                                name="_username"
                                fullWidth
                                margin="normal"
                                value={this.state._username}
                                onChange={this.handleChange}
                                required
                            />
                            <TextField
                                variant="outlined"
                                label="Password"
                                name="_password"
                                type="password"
                                fullWidth
                                margin="normal"
                                value={this.state._password}
                                onChange={this.handleChange}
                                required
                            />
                            <Button
                                variant="contained"
                                type="submit"
                                fullWidth
                                margin="normal"
                                className={classes.button}>
                                Login
                            </Button>
                            <Grid container>
                                <Grid item xs className={classes.action}>
                                    <Link href="#" variant="body2">
                                        Forgot password?
                                    </Link>
                                </Grid>
                                <Grid item className={classes.action}>
                                    <Link href="#" variant="body2">
                                        {"Don't have an account? Sign Up"}
                                    </Link>
                                </Grid>
                            </Grid>
                            <Box mt={5} className={classes.copyright} >
                                Copyright <Link href="">SilicoVN</Link>
                            </Box>
                        </form>
                    </div>
                </Grid>
            </Grid>
        );
    }
}

LoginForm.propTypes = {
    classes: PropTypes.object.isRequired,
};

export default withStyles(styles)(LoginForm);