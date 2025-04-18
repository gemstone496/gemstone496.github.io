<?php
include_once "../assets/php/helpers.php";
include_once "../assets/php/login.php";
$layout_args = [
  "type" => "Profile",
  "home" => "login.html.php",
  "dark_button" => true
];
?>

<html>
<?= render_layout("head", $layout_args) ?>
<body class="dark-mode">

<?php
$output = "../output/users.json";
if (file_exists($output)) {
  $fp = fopen($output, "r");
    $json = fread($fp, filesize($output));
    $users = json_decode($json, true);
  fclose($fp);
} else {
  $users = [];
}

$uname = $_POST["uname"];
$pwd = $_POST["pwd"];
if ($users["uname"] == null || $users["uname"] == $pwd) {
  if ($users["uname"] == null) {
    $users = array_merge($users, [$uname => $pwd]);

    $fp = fopen($output,"w");
    fwrite($fp, json_encode($users));

    fclose($fp);
  } ?>
  Welcome <?= $_POST["uname"]; ?><br>
  Your password is: <?= $_POST["pwd"]; ?>
<?php } elseif ($users["uname"] != $pwd) { ?>
  Login failed for user <?= $_POST["uname"]; ?>. Password did not match.
<?php }
?>

<?= render_layout("footer_std", $layout_args) ?>

</body>
</html>