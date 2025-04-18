<?php
include_once "../assets/php/helpers.php";
include_once "../assets/php/login.php";

$layout_args = [
  "type" => "Admin",
  "home" => "login.html.php",
  "special_assets" => ["login_page"],
  "dark_button" => true
];

$uname = $pwd = "";
?>
<!DOCTYPE html>
<html>
<?= render_layout("head", $layout_args) ?>
<body class="dark-mode">

<h2>Administrator View</h2>

<div id="user-list">
<?php
foreach (read_data("../output/users.json") as $uname => $pwd) {
  echo "
  <p>User: $uname <button class='cancelbtn' onclick='removeUser(\"delete_user.php\", \"$uname\")'>Delete User</button></p>";
}
?>
</div>

<?= render_layout("footer_std", $layout_args); ?>

</body>
</html>
