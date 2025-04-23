/**
 * hides or shows the responsive menu items on small screens
 * @param {HTMLElement} element the item clicked to call this
 */
function openMenu(element) {
  let responsives, response;
  responsives = document.getElementsByClassName("responsive");
  if (responsives.length > 0) {
    response = responsives[0].style.display === "block" ? "none" : "block";
  }
  for (let responsive of responsives) {
    responsive.style.display = response;
  }
  
  response === "none" ? element.classList.remove("hidden") : element.classList.add("hidden"); // continue showing the menu
}