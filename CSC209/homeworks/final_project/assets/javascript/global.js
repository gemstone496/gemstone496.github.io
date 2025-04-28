/**
 * shows or hides an object using classList.toggle
 * @param {string} id the id of the object to show/hide
 * @returns true if object was hidden, false if object was shown
 */
function toggleObjectHidden(id) {
  return document.querySelector(`#${id}`).classList.toggle("hidden");
}