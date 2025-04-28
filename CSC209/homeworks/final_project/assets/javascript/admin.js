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