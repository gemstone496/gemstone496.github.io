<?php
include_once "../assets/php/helpers.php";
include_once "../assets/php/users.php";

session_start();
if (isset($_SESSION["user"])) {
  header("Location: ./profile.html.php");
  die();
}

$content_for["assets"] = ["login"];

$content_for["content"] = '
  <div>
    <div class="login-container">
      <div id="login-mode-wrapper" 
           class="form-wrapper login-mode">
        <form id="login-form" method="post"
              onsubmit="verifySubmit(event)"
              action="./actions/verify_login.php">
          <div class="col txt center">
            <h1 class="logo">wildfire</h1>
          </div>
          <div class="col txt center">
            <h3 id="form-title" class="form-title">
              Log into your account
            </h3>
          </div>

          <input id="form-mode" name="mode" type="hidden" value="login">

          <div class="col full-width">
            <div class="form-label">
              <label for="uname">Username:</label>
              <span id="uname-verifier" 
                    class="verifier"></span>
            </div>
            <input id="uname" name="uname" 
                    class="mb-1 form-item" type="text" 
                    placeholder="Enter Username" 
                    oninput="validateNewUserField(userValid)" 
                    required>
          </div>

          <div class="col full-width">
            <div class="form-label">
              <label for="psw">Password:</label>
              <span id="psw-verifier"
                    class="verifier"></span>
            </div>
            <input id="psw" name="psw" 
                   class="mb-1 form-item" type="password" 
                   placeholder="Enter Password" 
                   oninput="validateNewUserField(pswValid)" 
                   required>
          </div>

          <div class="col full-width signup-only">
            <div class="form-label">
              <label for="psw-chk">Confirm Password:</label>
              <span id="psw-chk-verifier" 
                    class="verifier"></span>
            </div>
            <input id="psw-chk" name="psw-chk"
                   class="mb-1 form-item" type="password"
                   placeholder="Confirm Password"
                   onchange="validateNewUserField(pswsMatch)">
          </div>

          <div class="col full-width">
            <button id="submit-btn" class="mb-1 login btn" 
                    type="submit">Log in</button>
          </div>
        </form>
        
        <form id="cancel" class="mb-1" action="../comic/pages.html.php">
          <div class="col full-width">
            <button id="cancel-btn" class="mb-1 btn abort-btn"
                    type="submit">Cancel</button>
          </div>
        </form>
        <span class="col txt center full-width">
          <div><span id="swap-mode">Don\'t have an account?</span>
            <a onclick="loginModeSwap(this)">Sign up</a>
          </div>
        </span>
      </div>
    </div>
  </div>';
?>

<?= render_layout("head", $content_for); ?>