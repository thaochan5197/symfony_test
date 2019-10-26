import React from "react";
import PropTypes from "prop-types";
import {TextField, Avatar, Button, CssBaseline, Typography, Grid, Link, Box, Paper, FormControl, InputLabel, FormHelperText, Input} from "@material-ui/core";
import {pink, grey, green} from "@material-ui/core/colors";
import PersonAdd from '@material-ui/icons/PersonAdd';
import {withStyles} from "@material-ui/core/styles";
import ResFormControl from "./ResFormControl";
import axios from "axios";

const styles = {
    button: {
        background: 'linear-gradient(45deg, #4caf50 30%, #8bc34a 90%)',
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
        background: green[500]
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

class RegisterForm extends React.Component {
    // constructor(props) {super(props);
    //     this.state = {
    //         _email: '',
    //         _username: '',
    //         _password: '',
    //         _confirmPassword: ''
    //
    //     };
    //     this.handleSubmit = this.handleSubmit.bind(this);
    //     this.handleChange = this.handleChange.bind(this);
    // }
    // handleChange(event) {
    //     this.setState({
    //         [event.target.name]: event.target.value
    //     });
    // }
    handleSubmit(event) {
        event.preventDefault();
        const {_username, _password, _email, _confirmPassword} = this.state;
        if (_password !== _confirmPassword) {
            alert('Password dont match');
        }
        else {
            alert('Thanks for signing up!');
        }
        // axios.post(
        //     Routing.generate("user_security_check"),
        //     {
        //         _username: _username,
        //         _password: _password,
        //         _csrf_token: token,
        //
        //     },
        //     {withCredentials: true}
        // )
        //     .then(response => {
        //         console.log(response);
        //         if (response.status == 200) {
        //             console.log("Login successfull");
        //             alert("Login successfull");
        //         }
        //         else if (response.status == 302) {
        //             console.log("Username password do not match");
        //             alert("Username Password do not match")
        //         }
        //         else {
        //             console.log("Username does not exists");
        //             alert("Username does not exist");
        //         }
        //     })
        //     .catch(error => {
        //         console.log("Login error", error);
        //     });
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
                            <PersonAdd />
                        </Avatar>
                        <Typography
                            component="h1"
                            variant="h5"
                            margin="normal">
                            SIGN UP
                        </Typography>
                        <form onSubmit={this.handleSubmit}>
                            <ResFormControl label="Email" type="email" name="_email" />
                            <ResFormControl label="Username" type="text" name="_username" />
                            <ResFormControl label="Password" type="password" name="_password" />
                            <ResFormControl label="Confirm Password" type="password" name="_confirmPassword" />
                            <Button
                                variant="contained"
                                type="submit"
                                fullWidth
                                margin="normal"
                                className={classes.button}>
                                Sign up
                            </Button>
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

RegisterForm.propTypes = {
    classes: PropTypes.object.isRequired,
};

export default withStyles(styles)(RegisterForm);