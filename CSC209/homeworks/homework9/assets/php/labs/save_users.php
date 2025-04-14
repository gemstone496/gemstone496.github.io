<?php
include "../helpers.php";
$layout_args = [
  "type" => "Profile"
];
?>

<html>
<?= render_layout("head", $layout_args) ?>
<body>

Welcome <?php echo $_POST["uname"]; ?><br>
Your password is: <?php echo $_POST["pwd"]; ?>

<?php
$fp = fopen("../../../output/users.txt", "a");

fwrite($fp, $_POST["uname"]);
fwrite($fp, "\n");
fwrite($fp, $_POST["pwd"]);
fwrite($fp, "\n");

fclose($fp)
?>

</body>
</html>