import React from "react";
import PropTypes from "prop-types";
import {TextField, Paper, Button} from "@material-ui/core";
import {withStyles} from "@material-ui/core/styles";
import axios from "axios";

const styles = {
   root: {
       background: 'linear-gradient(45deg, #FE6B8B 30%, #FF8E53 90%)',
       color: '#fff',
   }
};

class LoginForm extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            txtUserName: '',
            txtUserPassword: ''
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
        const {txtUserName, txtUserPassword} = this.state;
        axios.post(
            "",
            {
                user: {
                    username: txtUserName,
                    password: txtUserPassword
                }
            },
            {withCredentials: true}
        )
            .then(response => {
                console.log(response);
                if (response.data.code == 200) {
                    console.log("Login successfull");
                }
                else if (response.data.code == 204) {
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
            })
        event.preventDefault();
    }
    render() {
        const {classes} = this.props;
        return (
            <Paper>
                <form onSubmit={this.handleSubmit}>
                    <TextField
                        label="Username"
                        name="txtUserName"
                        type="text"
                        value={this.state.txtUserName}
                        onChange={this.handleChange}
                        required
                    />
                    <TextField
                        label="Password"
                        name="txtUserPassword"
                        type="password"
                        value={this.state.txtUserPassword}
                        onChange={this.handleChange}
                        required
                    />
                    <Button
                        variant="contained"
                        className={classes.root}
                        type="submit">
                        Login
                    </Button>
                </form>
            </Paper>
        )
    }
}

LoginForm.propTypes = {
    classes: PropTypes.object.isRequired,
};

export default withStyles(styles)(LoginForm);