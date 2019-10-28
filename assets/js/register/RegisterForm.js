import React from "react";
import PropTypes from "prop-types";
import {Avatar, Button, CssBaseline, Typography, Grid, Link, Box, Paper, FormControl, InputLabel, Input, Select, MenuItem} from "@material-ui/core";
import {pink, grey, green, red} from "@material-ui/core/colors";
import PersonAdd from '@material-ui/icons/PersonAdd';
import {withStyles} from "@material-ui/core/styles";
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
    },
    errorMsg: {
        color: red[500]
    }
};

// const validEmailRegex = RegExp(/^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i);
// const validateForm = (errors) => {
//     let valid = true;
//     Object.values(errors).forEach(
//         (val) => val.length > 0 && (valid = false)
//     );
//     return valid;
// }

class RegisterForm extends React.Component {
    constructor(props) {super(props);
        this.state = {
            _email: '',
            _username: '',
            _password: '',
            _confirmPassword: '',
            errors: {}
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
        const {_username, _password, _email, _confirmPassword} = this.state;
        if (this.validateForm()) {
            axios.post(
                Routing.generate("fos_user_registration_register"),
                {
                    _email: _email,
                    _username: _username,
                    _password: _password,
                    _confirmPassword: _confirmPassword,
                    // _csrf_token: token,

                },
                {withCredentials: true}
            )
                .then(data => {
                    console.log(data);
                })
                .catch(error => {
                    console.log("Login error", error);
                });
        }
    }
    validateForm() {
        let errors = {};
        let formIsValid = true;

        if (!this.state._username.match(/^(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._]+(?<![_.])$/)) {
            formIsValid = false;
            errors["_username"] = "*Your username is not valid.";
        }

        let pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
        if (!pattern.test(this.state._email)) {
            formIsValid = false;
            errors["_email"] = "*Your email address is not valid.";
        }

        if (this.state._password.length < 8) {
            formIsValid = false;
            errors["_password"] = "*Your password must be at least 8 characters.";
        }

        if (this.state._password !== this.state._confirmPassword) {
            formIsValid = false;
            errors["_confirmPassword"] = "*Your password doesn't match.";
        }

        this.setState({
            errors: errors
        });

        return formIsValid;
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
                            <FormControl
                                margin="normal"
                                fullWidth
                            >
                                <InputLabel>Email</InputLabel>
                                <Input
                                    name="_email"
                                    type="text"
                                    required
                                    value={this.state._email}
                                    onChange={this.handleChange}
                                />
                                <div className={classes.errorMsg}>{this.state.errors._email}</div>
                            </FormControl>
                            <FormControl
                                margin="normal"
                                fullWidth
                            >
                                <InputLabel>Username</InputLabel>
                                <Input
                                    name="_username"
                                    type="text"
                                    required
                                    value={this.state._username}
                                    onChange={this.handleChange}
                                />
                                <div className={classes.errorMsg}>{this.state.errors._username}</div>
                            </FormControl>
                            <FormControl
                                margin="normal"
                                fullWidth
                            >
                                <InputLabel>Password</InputLabel>
                                <Input
                                    name="_password"
                                    type="password"
                                    required
                                    value={this.state._password}
                                    onChange={this.handleChange}
                                />
                                <div className={classes.errorMsg}>{this.state.errors._password}</div>
                            </FormControl>
                            <FormControl
                                margin="normal"
                                fullWidth
                            >
                                <InputLabel>Confirm Password</InputLabel>
                                <Input
                                    name="_confirmPassword"
                                    type="password"
                                    required
                                    value={this.state._confirmPassword}
                                    onChange={this.handleChange}
                                />
                                <div className={classes.errorMsg}>{this.state.errors._confirmPassword}</div>
                            </FormControl>
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