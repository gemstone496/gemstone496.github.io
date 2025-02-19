function darkToggle() {
  console.log("Toggling dark mode.")
  let on = document.body.classList.toggle("dark-mode");
  on ? document.getElementById("dark-button").innerHTML = "Light Mode" :
    document.getElementById("dark-button").innerHTML = "Dark Mode";
}

function openMenu() {
  console.log("Hiding/Unhiding menu items.");
  let nav = document.getElementById("nav");
  nav.classList.toggle("hideable");
  nav.classList.toggle("showable");
}