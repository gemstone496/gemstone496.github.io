function removeUser(pageURL, uname) {
  let request = new XMLHttpRequest();
  request.onload = function() {
    document.getElementById("user-list").innerHTML = this.responseText;
  }
  request.open("GET", pageURL + "?uname=" + uname);
  request.send();
}

/**
 * @param {String} popupId the id of the popup to show
 */
function showPopup(popupId, popupForm, mode) {
  // Get the popup
  let popup = document.getElementById(popupId);
  popup.dataset.mode = mode;
  document.getElementById(popupForm).action = mode === "signup" ? popup.dataset.signup : popup.dataset.login;
  popup.style.display="block";
    
  // show or hide signup elements accordingly
  let signups = document.getElementsByClassName("signup-only");
  for (let signup of signups) {
    switch (mode) {
      case "login":
        signup.style.display = "none";
        break;
      case "signup":
        signup.style.display = "block";
        break;
    }
  }

  // activate first pop up
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
}

function validatePasswords(popupId) {
  return document.getElementById(popupId).dataset.mode == 'signup' ?
   document.getElementById("pwd").value === document.getElementById("pwd-chk").value : true;
}