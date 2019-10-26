import React from "react";
import NavBar from './Components/NavBar';
import {ThemeProvider} from "@material-ui/core/styles";
import theme from "./theme";

class App extends React.Component {
    render() {
        return (
            <ThemeProvider theme={theme}>
                {/*<NavBar />*/}
            </ThemeProvider>
        )
    }
}

export default App;