import React from "react";
import {FormControl, Input, InputLabel} from "@material-ui/core";
import ResFormHelperText from "./ResFormHelperText";

class ResFormControl extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            value: props.value,
        };
        this.handleChange = this.handleChange.bind(this);
    }
    handleChange(event){
        this.setState({
           value: event.target.value
        });
    }
    render() {
        return (
            <FormControl
                margin="normal"
                variant="outlined"
                fullWidth
            >
                <InputLabel>{this.props.label}</InputLabel>
                <Input
                    name={this.props.name}
                    type={this.props.type}
                    required
                    value={this.state.value}
                    onChange={this.handleChange}
                />
                <ResFormHelperText />
            </FormControl>
        )
    }
}

export default ResFormControl;