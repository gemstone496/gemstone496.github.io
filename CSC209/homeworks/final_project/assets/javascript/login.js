/**
 * 
 * @param {HTMLButtonElement} button the button clicked
 * @param {String} wrapperId the wrapper id to set
 * @param {String} titleId the title id to update
 */
function loginModeSwap(button, wrapperId="login-mode-wrapper", titleId="form-title") {
  let loggingIn = document.getElementById(wrapperId).classList.toggle("login-mode");
  button.textContent = loggingIn ? "Sign up" : "Log in";
  document.getElementById(titleId).textContent = loggingIn ? 
    "Log into your account" : "Sign up for a new account";
  window.scrollTo({top: 0, behavior: 'smooth'}); // https://stackoverflow.com/questions/15935318/smooth-scroll-to-top
}