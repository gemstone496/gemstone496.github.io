const REMOVE_PFP_URL = "./actions/remove_pfp.php";

/**
 * uses an ajax request to remove the user's pfp
 */
function removePfp(defaultImgPath) {
  ajaxRequest(REMOVE_PFP_URL, updatePfp);
  let pfps = document.querySelectorAll("img.pfp.user");
  for (const pfp of pfps) {
    pfp.src = defaultImgPath; // update this while ajax runs
  }
}

function updatePfp(response) {
  document.querySelector("#pfp-verified").textContent = response;
  document.querySelector("#pfp-upload-verifier").textContent = "";
}

/**
 * decides if the file upload is a valid one and provides helpful feedback
 * @param {String} filepath the path to the submitted file
 * @returns the error message to display (empty if no errors)
 */
function fileValid(filepath) {
  let check = filepath.search(/\.png|\.jpg|\.bmp$/);
  let msg = check !== -1 ? "" : "* Please choose an image file.";
  return msg;
}

/**
 * decides if the select field is a valid one and provides helpful feedback
 * @returns the error message to display (empty if no errors)
 */
function selectValid(val) {
  let check = val !== "";
  let msg = check ? "" : "* Please select a chapter.";
  msg = check ? "" : msg;
  return msg;
}

/**
 * decides if the title a valid one and provides helpful feedback
 * @returns the error message to display (empty if no errors)
 */
function titleValid(val) {
  let check = val.length <= 30 && val.match(/^[a-z][\w ]*$/i);
  let msg = (val.length <= 0 || val.length > 30) ? "* Please enter a title shorter than 30 characters." : "* Titles begin with a letter. Don't use special characters.";
  msg = check ? "" : msg;
  return msg;
}

/**
 * checks whether a field is valid and updates its verifier to match
 * @param {String} id the id of the field to validate
 * @returns true iff the field's value is acceptable
 */
function validateInputField(id) {
  let msg = "", field, val, verifier;
  field = document.querySelector(`#${id}`);
  val = field.value;
  verifier = document.querySelector(`#${id}-verifier`);
  if (field.type === "text") { msg = titleValid(val); }
  else if (field.type === "file") { msg = fileValid(val); }
  else { msg = selectValid(val); }
  verifier.textContent = msg;
  return msg === "";
}

/**
 * Verifies form submission and then runs an AJAX request to validate new users
 * @param {Event} e the submission event
 * @param {String} formId the id of the form submitting
 * @param {Boolean} ajaxCheck whether to prevent default and submit on AJAX success instead
 */
function verifySubmit(e, formId, ajaxCheck=false) {
  e.preventDefault(); // never submit except manually
  // get out if the inputs are invalid
  let form = document.querySelector(`#${formId}`);
  let flag = true;
  for (const input of form.querySelectorAll("input")) {
    if (input.type === "text" && input.classList.contains("hidden")) {
      input.value = ""; // reset and don't validate hidden fields
    } else if (input.type !== "hidden" && !validateInputField(input.id)) {
      flag = false;
    }
  }
  for (const input of form.querySelectorAll("select")) {
    if (!validateInputField(input.id)) {
      flag = false;
    }
  }
  if (!flag) {
    return false;
  } else if (!ajaxCheck) {
    form.submit();
    return true;
  }

  form.querySelector(`input[type=submit]`).toggleAttribute("disabled", true);
  // TODO implement ajax for generality
  return false;
}