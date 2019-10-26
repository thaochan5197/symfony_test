import React from "react";
import {withStyles} from "@material-ui/core/styles";
import PropTypes from "prop-types";

const styles = theme => ({
    h2: {
        color: theme.color.primary
    }
})


class NavBar extends React.Component {
    render() {
        const {classes} = this.props;
        return <h2 className={classes.h2}>Welcome to you!</h2>
    }
}

NavBar.propTypes = {
    classes: PropTypes.object.isRequired,
};

export default withStyles(styles)(NavBar);