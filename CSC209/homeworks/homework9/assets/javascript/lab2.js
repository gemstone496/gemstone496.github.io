/**
 * Updates a single element on the page using AJAX
 * @param {String} pageURL the url of the requesting page
 * @param {string} elementId the string id of the element to update
 */
function updateElement(pageURL, elementId) {
  let request = new XMLHttpRequest();
  request.onload = function() {
    document.getElementById(elementId).textContent = this.responseText;
  }
  request.open("GET", pageURL);
  request.send();
}