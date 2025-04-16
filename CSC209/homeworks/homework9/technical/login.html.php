<?php
include_once "../assets/php/helpers.php";
include_once "../assets/php/login.php";

$layout_args = [
  "type" => "Technical",
  "time" => "5",
  "special_assets" => ["login_page"],
  "dark_button" => true
];

$uname = $pwd = "";
?>
<!DOCTYPE html>
<html>
<?= render_layout("head", $layout_args) ?>
<body class="dark-mode">

<h2>Modal Login Form</h2>

  <?php if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!validate_login($_POST["uname"], $_POST["pwd"])) {
      echo "<p class='abort'>Username and password do not match!<br>";
    } else {
      echo "<p>Welcome ".$_POST["uname"]."<br>";
    }
  } ?>
</p>

<button class="login" onclick="showPopup('login-popup', 'login-form', 'login')" style="width:auto;">Login</button>
<button class="login" onclick="showPopup('login-popup', 'login-form', 'signup')" style="width:auto;">Sign Up</button>

<div id="login-popup" class="modal"
     data-login="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
     data-signup="<?= find_asset("php").'labs/save_users.php' ?>">
  
  <form id="login-form" class="modal-content animate" method="post"
        onsubmit="validatePasswords('login-popup')"
        action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <div class="imgcontainer">
      <span class="hide close" title="Close Modal">&times;</span>
      <img src="<?= find_asset("images").'avatar.png' ?>" alt="Avatar" class="avatar">
    </div>

    <div class="container">
      <input type='text' id='homelink' name='homelink' value='technical/login' style='display:none;'>
      <label for="uname"><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="uname" required>
      <label for="pwd"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="pwd" required>
      <label class="signup-only" for="pwd-chk"><b>Confirm Password</b></label>
        <input class="signup-only" type="password" placeholder="Confirm Password" name="pwd-chk">
      <button class="login" type="submit">Login</button>
      <label>
        <input type="checkbox" name="remember"> Remember me
      </label>
    </div>

    <div class="container footer">
      <button type="button" class="hide cancelbtn">Cancel</button>
      <span class="psw"><a href="#">Forgot password?</a></span>
    </div>
  </form>
</div>

<?= render_layout("footer_std", $layout_args); ?>

</body>
</html>
