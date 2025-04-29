const FORM_MODE_ID = "form-mode";
const FORM_TITLE_ID = "form-title";
const FORM_WRAPPER_ID = "login-mode-wrapper";
const LOGIN_FORM_ID = "login-form";
const MODE_SWAP_ID = "swap-mode";
const PSW_ID = "psw";
const PSW_CHK_ID = "psw-chk"
const SUBMIT_BTN_ID = "submit-btn";
const UNAME_ID = "uname";
const UNAME_TAKEN_URL = "./actions/is_login_taken.php";

/**
 * swaps between login-mode and signup-mode
 * @param {HTMLElement} button the button clicked
 */
function loginModeSwap(button) {
  // which toggle mode
  let loggingIn = document.getElementById(FORM_WRAPPER_ID).classList.toggle("login-mode");
  // change this button
  button.textContent = loggingIn ? "Sign up" : "Log in";
  // change title of form
  document.getElementById(FORM_TITLE_ID).textContent = loggingIn ? "Log into your account" : "Sign up for a new account";
  // change mode-swap message
  document.getElementById(MODE_SWAP_ID).textContent = loggingIn ? "Don't have an account?" : "Already have an account?";
  
  // change submit button option
  document.getElementById(SUBMIT_BTN_ID).textContent = loggingIn ? "Log in" : "Sign up";
  // change whether a password confirmation is required
  document.getElementById(PSW_CHK_ID).toggleAttribute("required");
  // update the form mode
  document.getElementById(FORM_MODE_ID).value = loggingIn ? "login" : "signup";
  // purge verification checks
  let verifiers = document.getElementsByClassName("verifier");
  for (let verifier of verifiers) { verifier.textContent = ""; }
  // scroll to top
  window.scrollTo({top: 0, behavior: 'smooth'}); // https://stackoverflow.com/questions/15935318/smooth-scroll-to-top
}

/**
 * decides whether the psw and psw-chk match and provides helpful feedback if not
 * @returns true iff the psws match
 */
function pswsMatch() {
  let match = document.getElementById(PSW_ID).value === document.getElementById(PSW_CHK_ID).value;
  let msg = "* Passwords do not match!";
  document.getElementById(`${PSW_CHK_ID}-verifier`).textContent = match ? "" : msg;
  document.getElementById(`${PSW_ID}-verifier`).textContent = match ? "" : msg;
  return match;
}

/**
 * decides if psw is long enough and displays helpful feedback
 * @returns true iff the psw is long enough
 */
function pswValid() {
  let msg;
  let val = document.getElementById(PSW_ID).value;
  let check = val.length >= 8;
  msg = val.length <= 0 ? 
    "* Please enter a password" : "* Password must be at least 8 characters long";
  document.getElementById(`${PSW_ID}-verifier`).textContent = check ? "" : msg;
  return check;
}

/**
 * @param {String} response the request to process
 */
function unameThrowError(response) {
  let verifier = document.getElementById(`${UNAME_ID}-verifier`);
  verifier.textContent = response;
}

/**
 * validates a new username according to AJAX request to the server
 * @param {String} val the usernmae to validate
 * @param {(response: String) => void} loadMethod the method to run 
 */
function userNewUsername(val, loadMethod) {
  ajaxRequest(url, loadMethod, ["uname", val]);
}

/**
 * decides if the username a valid and provides helpful feedback
 * @returns true iff username is valid
 */
function userValid(withAjax = true) {
  let val = document.querySelector(`#${UNAME_ID}`).value;
  let verifier = document.querySelector(`#${UNAME_ID}-verifier`);
  let check = val.match(/^[a-zA-Z]\w*$/);
  let msg = val.length <= 0 ? "* Please enter a username" : "* Usernames begin with a letter and can't contain special characters";
  verifier.textContent = check ? "" : msg;
  if (!check) { return false; }

  // ajax request for existing usernames
  if (withAjax) { userNewUsername(val, unameThrowError); }
  // this will not consistently bar form submission for invalid usernames due to asynchronous fetching
  return val;
}

/**
 * checks if signup-mode is active and then validates new user info
 * @param {Function} method the method to verify for new users
 * @returns false iff signup-mode and invalid signup data
 */
function validateNewUserField(method) {
  // don't bother unless signup-mode
  if (document.querySelector(`#${FORM_MODE_ID}`).value === "login") {
    return true;
  }
  return method();
}

/**
 * Verifies form submission and then runs an AJAX request to validate new users
 * @param {Event} e the submission event
 */
function verifySubmit(e) {
  // let the server handle login requests instead?
  if (document.querySelector(`#${FORM_MODE_ID}`).value === "login") {
    return true;
  }
  // just get out if the inputs are invalid
  e.preventDefault(); // this is the fucked up part
  let username = userValid(false);
  let pswCheck = pswValid();
  let pswMatch = pswsMatch();
  if (!username || !pswCheck || !pswMatch) {
    return false;
  }
  document.querySelector(`#${SUBMIT_BTN_ID}`).toggleAttribute("disabled", true);
  userNewUsername(username, submitFormOnAjaxSuccess);
  return false;
}

/**
 * @param {String} response the request to validate
 */
function submitFormOnAjaxSuccess(response) {
  document.querySelector(`#${SUBMIT_BTN_ID}`).toggleAttribute("disabled", false);
  if (response !== "") {
    unameThrowError(response);
    return;
  }
  let form = document.querySelector(`form#${LOGIN_FORM_ID}`);
  form.submit();
}