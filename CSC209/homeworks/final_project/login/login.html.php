<?php
include_once "../assets/php/helpers.php";
include_once "../assets/php/users.php";

$content_for["assets"] = ["login"];
?>

<?= render_layout("login", $content_for); ?>
  <div>
    <div class="login-container">
      <div id="login-mode-wrapper" 
           class="form-wrapper login-mode">
        <form id="login-form" method="post"
              onsubmit="verifySubmit(event)"
              action="./actions/verify_login.php">
          <div class="txt-center">
            <h1 class="logo">wildfire</h1>
          </div>
          <div class="txt-center">
            <h3 id="form-title" class="form-title">
              Log into your account
            </h3>
          </div>

          <input id="form-mode" name="mode" type="hidden" value="login">

          <div class="full-span">
            <div class="form-label">
              <label for="uname">Username:</label>
              <span id="uname-verifier" 
                    class="verifier"></span>
            </div>
            <input id="uname" name="uname" 
                    class="form-item" type="text" 
                    placeholder="Enter Username" 
                    oninput="validateNewUserField(userValid)" 
                    required>
          </div>

          <div class="full-span">
            <div class="form-label">
              <label for="psw">Password:</label>
              <span id="psw-verifier"
                    class="verifier"></span>
            </div>
            <input id="psw" name="psw" 
                   class="form-item" type="password" 
                   placeholder="Enter Password" 
                   onchange="validateNewUserField(pswValid)" 
                   required>
          </div>

          <div class="full-span signup-only">
            <div class="form-label">
              <label for="psw-chk">Confirm Password:</label>
              <span id="psw-chk-verifier" 
                    class="verifier"></span>
            </div>
            <input id="psw-chk" name="psw-chk"
                   class="form-item" type="password"
                   placeholder="Confirm Password"
                   onchange="validateNewUserField(pswsMatch)">
          </div>

          <div class="full-span">
            <button id="submit-btn" class="login btn" 
                    type="submit">Log in</button>
          </div>
        </form>
        
        <form id="cancel" action="../comic/pages.html.php">
          <div class="full-span">
            <button id="cancel-btn" class="invert-btn"
                    type="submit">Cancel</button>
          </div>
        </form>
        <span class="txt-center space-above full-span">
          <div><span id="swap-mode">Don't have an account?</span>
            <a onclick="loginModeSwap(this)">Sign up</a>
          </div>
        </span>
      </div>
    </div>
  </div>
</body>
</html>