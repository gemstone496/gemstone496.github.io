<?php include_once '../assets/php/helpers.php' ?>
<!DOCTYPE html>
<html>
<?= render_layout("head", ["type" => "Create Account"]) ?>
<body class='dark-mode'>

<h2>HTML Forms</h2>

<form action='../assets/php/labs/save_users.php' method='post'>
    <input type='text' id='homelink' name='homelink' value='lab2/login' style='display:none;'>
  <label for='uname'>Username:</label><br>
    <input type='text' id='uname' name='uname' value='crownofburningviolets'><br>
  <label for='pwd'>Password:</label><br>
    <input type='password' id='pwd' name='pwd'><br><br>
  <input type='submit' value='Submit'>
</form> 

<p>If you click the "Submit" button, the form-data will be sent to a page called `save_users.php`.</p>

</body>
</html>