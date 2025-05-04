/**
 * submits an ajax request to the server at relative path url, with parama
 * @param {String} url the String url to request from
 * @param {(response: String) => void} loadMethod the method to call on the request text
 * @param  {...any} params (name, value) pairs of url arguments to tack onto the url
 */
function ajaxRequest(url, loadMethod, ...params) {
  let urlWithParams = new URL(url, window.location.href);
  for (const arg of params) {
    urlWithParams.searchParams.append(arg[0], arg[1]);
  }
  let request = new XMLHttpRequest();
  request.onload = function() { loadMethod(this.responseText); };
  request.timeout = 1000;
  request.open("GET", urlWithParams);
  request.send();
}

/**
 * @param {String} style the style element of the dimension (including 'px')
 * @returns {Number} the number of the dimension, w/o 'px'
 */
function dimension(style) {
  return Number(style.replace(/px$/, ''));
}

/**
 * shows or hides an object using classList.toggle
 * @param {string} id the id of the object to show/hide
 * @returns true if object was hidden, false if object was shown
 */
function toggleObjectHidden(id) {
  return document.querySelector(`#${id}`).classList.toggle("hidden");
}