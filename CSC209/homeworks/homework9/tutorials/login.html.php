<?php
include_once "../assets/php/helpers.php";

$layout_args = [
  "type" => "Tutorial",
  "time" => "3",
  "special_assets" => ["login_page"]
];
?>
<!DOCTYPE html>
<html>
<?= render_layout("head", $layout_args) ?>
</head>
<body>

<h2>Modal Login Form</h2>

<button onclick="showPopup('login-popup')" style="width:auto;">Login</button>

<div id="login-popup" class="modal">
  
  <form class="modal-content animate" action="/action_page.php" method="post">
    <div class="imgcontainer">
      <span class="hide close" title="Close Modal">&times;</span>
      <img src="<?= find_asset("images").'avatar.png' ?>" alt="Avatar" class="avatar">
    </div>

    <div class="container">
      <label for="uname"><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="uname" required>
      <label for="pwd"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="pwd" required>
      <button type="submit">Login</button>
      <label>
        <input type="checkbox" name="remember"> Remember me
      </label>
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" class="hide cancelbtn">Cancel</button>
      <span class="psw"><a href="#">Forgot password?</a></span>
    </div>
  </form>
</div>

<script>

</script>

</body>
</html>
