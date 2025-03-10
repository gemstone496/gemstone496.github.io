/** Toggles between dark and light modes */
function darkToggle() {
  console.log("Toggling dark mode.")
  let on = document.body.classList.toggle("dark-mode");
  on ? document.getElementById("dark-button").innerHTML = "Light Mode" :
    document.getElementById("dark-button").innerHTML = "Dark Mode";
}

/**
 * @param {String} style the style element of the dimension (including 'px')
 * @returns {Number} the number of the dimension, w/o 'px'
 */
function dimension(style) {
  return Number(style.replace(/px$/, ''));
}