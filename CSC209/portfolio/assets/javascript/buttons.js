/** Toggles the page between light and dark mode */
function darkToggle() {
  let on = document.body.classList.toggle("dark-mode");
  on ? document.getElementById("dark-button").innerHTML = "Light Mode" :
    document.getElementById("dark-button").innerHTML = "Dark Mode";
}
/** HW2 description button */
function describeMe() {
  let description = document.getElementById("description");
  let hidden = description.classList.toggle("hidden");
  if (hidden) {
    description.innerHTML = "";
    document.getElementById("read-me").innerHTML = "Show more";
  } else {
    description.innerHTML = "[[describe here]]";
    document.getElementById("read-me").innerHTML = "Show less";
  }
}

/**
 * @param {String} style the style element of the dimension (including 'px')
 * @returns {Number} the number of the dimension, w/o 'px'
 */
function dimension(style) {
  return Number(style.replace(/px$/, ''));
}