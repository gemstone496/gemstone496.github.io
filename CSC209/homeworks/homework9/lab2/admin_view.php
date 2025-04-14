<?php 
include '../assets/php/helpers.php';
include '../assets/php/lab2.php';
?>
<!DOCTYPE html>
<html>
<?= render_layout("head", ["type" => "Admin"]) ?>
<body class='dark-mode'>

<h2>User Display</h2>

<div id="user-count">
  <?= count_users("users.txt"); ?>
</div>

<h2>Create New Account</h2>

<form action='../assets/php/labs/save_users.php' method='post'>
  <label for='uname'>Username:</label><br>
    <input type='text' id='uname' name='uname' value='crownofburningviolets'><br>
  <label for='pwd'>Password:</label><br>
    <input type='password' id='pwd' name='pwd'><br><br>
  <input type='submit' value='Submit'>
</form> 

<p>If you click the "Submit" button, the form-data will be sent to a page called `save_users.php`.</p>

</body>
</html>