/**
 * @param {String} popupId the id of the popup to show
 */
function showPopup(popupId) {
  // Get the popup
  let popup = document.getElementById(popupId);
  let activated = popup.dataset.activated ?? false;

  if (!activated) {
    popup.dataset.activated = true;
    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == popup) {
            popup.style.display = "none"; // marginally faster lookup times...
        }
    }

    hideBtns = document.getElementsByClassName("hide");
    for (const button of hideBtns) {
      button.onclick = function() {
        popup.style.display = "none";
      }
    }
    
  }

  
  popup.style.display='block';
}