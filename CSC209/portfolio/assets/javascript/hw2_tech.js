/** Toggles whether a nav menu is shown or hidden */
function openMenu() {
  console.log("Hiding/Unhiding menu items.");
  let nav = document.getElementById("nav");
  nav.classList.toggle("hideable");
  nav.classList.toggle("showable");
}