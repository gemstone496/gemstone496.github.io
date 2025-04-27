/**
 * Shows a designated modal onscreen
 * @param {string} id the modal id to select to show
 */
function showModal(id) {
  let modal = document.querySelector(`#${id}`);
  modal.classList.add("show");  // Get the popup

  // activate first pop up
  let activated = modal.dataset.activated ?? false;
  if (!activated) {
    console.log("activating")
    modal.dataset.activated = true;
    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
      if (event.target == modal) {
        modal.classList.remove("show");
      }
    }

    hideBtns = document.getElementsByClassName("modal-close");
    for (const button of hideBtns) {
      button.onclick = function() {
        modal.classList.remove("show");
      }
    }
  }
}

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