/**
 * sends the AJAX request to delete an account from the admin control panel
 * @param {String} modalId the id of the modal submitting the request
 */
function adminDeleteAccount(modalId) {
  const DELETION_PATH = "./actions/delete_account.php";
  let username = document.querySelector(`#${modalId}`).dataset.userDelete;
  ajaxRequest(DELETION_PATH, updateUserList, ["admin-delete", username]);
}

function updateUserList(response) {
  const USERLIST_ID = "userlist";
  const MODAL_ID = "delete-account-modal";
  document.querySelector(`#${MODAL_ID}`).classList.remove("show");
  document.querySelector(`#${USERLIST_ID}`).innerHTML = response;
}

/**
 * checks chapter input and toggles view appropriately
 * @param {HTMLSelectElement} input the input field to check
 * @param {String} objectId the id of the fields to reveal
 */
function newChapter(input, ...objectIds) {
  validateInputField(input.id);
  for (const objectId of objectIds) {
    document.querySelector(`#${objectId}`).classList.toggle("hidden", !(input.value === "new"));
  }
}

/**
 * pops up the admin modal and saves the user being moderated to its dataset for submission
 * @param {String} modalId the id of the modal to show
 * @param {String} user the name of the user being deleted
 */
function showAdminModal(modalId, user) {
  document.querySelector(`#${modalId}`).dataset.userDelete = user;
  showModal(modalId);
}

/**
 * @param {String} response the request to validate
 */
function submitFormOnAjaxSuccess(formId, response) {
  document.querySelector(`form#${formId} input[type=submit]`).toggleAttribute("disabled", false);
  if (response !== "") {
    // throwError(response); // TODO implement
    return;
  }
  let form = document.querySelector(`form#${formId}`);
  form.submit();
}