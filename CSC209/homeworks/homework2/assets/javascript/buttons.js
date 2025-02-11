function darkToggle() {
  let on = document.body.classList.toggle("dark-mode");
  on ? document.getElementById("dark-button").innerHTML = "Light Mode" :
    document.getElementById("dark-button").innerHTML = "Dark Mode";
}
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