<?php 
include_once '../assets/php/helpers.php';
include_once '../assets/php/lab2.php';

$layout_args = [
  "type" => "Admin",
  "special_assets" => ["lab2"]
];
?>
<!DOCTYPE html>
<html>
<?= render_layout("head", $layout_args) ?>
<body class='dark-mode'>

<h2>User Display</h2>

<div>
<div id="user-count">
  <?= count_users("users.txt"); ?>
</div>
<br><button class='button' 
    onclick='updateElement("<?= find_asset("layouts")."user_count.html.php" ?>", "user-count")'>
  Recount
</button>
</div>

<h2>Create New Account</h2>

<form action='../assets/php/labs/save_users.php' method='post'>
    <input type='text' id='homelink' name='homelink' value='lab2/admin_view' style='display:none;'>
  <label for='uname'>Username:</label><br>
    <input type='text' id='uname' name='uname' value='crownofburningviolets'><br>
  <label for='pwd'>Password:</label><br>
    <input type='password' id='pwd' name='pwd'><br><br>
  <input type='submit' value='Submit'>
</form> 

<p>If you click the "Submit" button, the form-data will be sent to a page called `save_users.php`.</p>

</body>
</html>