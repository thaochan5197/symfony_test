/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.css in this case)
import '../css/app.css';
import React from "react";
import ReactDOM from 'react-dom';
import PropTypes from "prop-types";
import {TextField, Paper, Button} from "@material-ui/core";
// import {withStyles} from "@material-ui/core/styles";
import axios from "axios";
require('@fortawesome/fontawesome-free/css/all.min.css');
require('@fortawesome/fontawesome-free/js/all.js');

// loads the jquery package from node_modules


// import the function from greet.js (the .js extension is optional)
// ./ (or ../) means to look for a local file

// const styles = {
//     root: {
//         background: 'linear-gradient(45deg, #FE6B8B 30%, #FF8E53 90%)',
//         color: '#fff',
//     }
// };



class LoginForm extends React.Component {
    constructor(props) {super(props);
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
        console.log("fhdj");
        axios.post(
            "http://127.0.0.1:8000/login_check",
            {
                    _username: _username,
                    _password: _password,
                    _csrf_token: token,

            },
            {withCredentials: true}
        )
            .then(response => {
                console.log(response);

                if (response.status == 200) {
                    console.log("Login successfull");
                    alert("Login successfull");
                }
                else if (response.status == 302) {
                    console.log("Username password do not match");
                    alert("Username Password do not match")
                }
                else {
                    console.log("Username does not exists");
                    alert("Username does not exist");
                }
            })
            .catch(error => {
                console.log("Login error", error);
            });
    }
    render() {
        // const {classes} = this.props;
        return (
            <Paper>
                <form onSubmit={this.handleSubmit}>
                    <TextField
                        label="Username"
                        name="_username"
                        type="text"
                        value={this.state._username}
                        onChange={this.handleChange}
                        required
                    />
                    <TextField
                        label="Password"
                        name="_password"
                        type="password"
                        value={this.state._password}
                        onChange={this.handleChange}
                        required
                    />
                    <Button
                        variant="contained"
                        type="submit">
                        Login
                    </Button>
                </form>
            </Paper>
        )
    }
}

// LoginForm.propTypes = {
//     classes: PropTypes.object.isRequired,
// };

export default LoginForm;

ReactDOM.render(<LoginForm />, document.getElementById('root'));