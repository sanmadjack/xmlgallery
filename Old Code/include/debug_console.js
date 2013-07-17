/* 
 * This class controls the debug console
 */

// This appends a message to the debug console and turns the background red to draw attention
function error(message) {
    if(debugging) {
        document.getElementById("debug_console").innerHTML += "<div class=\"error\">" + message + "</div>";
        document.getElementById("debug_console").className = "debug_console new_error";
    }
}
// This appends a benevolent message to the debug console
function success(message) {
    if(debugging) {
        document.getElementById("debug_console").innerHTML += "<div class=\"success\">" + message + "</div>";
    }
}
// This resets the background color of the debug console when it's opened'
function console_opened() {
        document.getElementById("debug_console").className = "debug_console";
}