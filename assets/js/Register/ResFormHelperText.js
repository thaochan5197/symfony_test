import React from "react";
import {FormHelperText} from "@material-ui/core";
import Notification from "./Notification";

class ResFormHelperText extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            status: false,
        };
        this.validateText = this.validateText.bind(this);
    }

    validateText(event) {
        this.setState({
            status: true
        })
    }

    render() {
        return (
            <FormHelperText error>{this.state.status ? <Notification /> : undefined}</FormHelperText>
        )
    }
}

export default ResFormHelperText;