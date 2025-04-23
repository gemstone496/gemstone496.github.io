<?php
include_once "../assets/php/helpers.php";
include_once "../assets/php/users.php";

$content_for["assets"] = ["login"];

$uname = $pwd = "";
?>

<?= render_layout("login", $content_for); ?>
<body>
  <div>
    <div class="login-container">
      <div id="login-mode-wrapper" class="form-wrapper login-mode">
        <form id="login-form" method="post"
              onsubmit=""
              action="./verify_login.php">
          <div class="txt-center"><h1 class="logo">wildfire</h1></div>
          <div class="txt-center">
            <h3 id="form-title" class="form-title">Log into your account</h3>
          </div>

          <div class="full-span">
            <label class="form-label" for="uname">Username:</label>
              <input name="uname" class="form-item" type="text" placeholder="Enter Username" onchange="" required>
          </div>
          <div class="full-span">
            <label class="form-label" for="psw">Password:</label>
              <input name="psw" class="form-item" type="password" placeholder="Enter Password" onchange="" required>
          </div>
          <div class="full-span">
            <label class="form-label signup-only" for="psw-chk">Confirm Password:</label>
              <input name="psw-chk" class="form-item signup-only" type="password" placeholder="Confirm Password" onchange="">
          </div>
          <div class="full-span">
            <button class="login form-button" type="submit">Login</button>
          </div>
        </form>
        
        <form id="cancel" action="../comic/pages.html.php">
          <div class="full-span">
            <button type="submit" class="cancel-btn">Cancel</button>
          </div>
        </form>
        <span class="txt-center space-above full-span">
          <a onclick="loginModeSwap(this, 'login-mode-wrapper')">Sign up</a>
        </span>
      </div>
    </div>
  </div>
</body>
</html>
