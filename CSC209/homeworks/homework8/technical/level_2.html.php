<?php
include "../assets/php/h8_tech.php";
$TYPE = "Level 2";
$TIME = 2;
$HOME_LINK = "./tech.html.php";
$IMGS = glob("../assets/images/bonfire/*.png");
?>
<html>
<head>
  <title>Level 2</title>
  <link rel="icon" type="image/x-icon" href="../assets/images/favicon.ico">
  <?php import_stylesheets(array("hw8_tech")); ?>
  <script src="../assets/javascript/helpers.js"></script>
</head>
<body class="dark-mode">

<div>
  <button id="dark-button" class="button" onclick="darkToggle()">Light Mode</button><br>
  <?php image_dump($IMGS); ?>
</div>

<?php include "../layouts/footer_std.html.php";?>

</body></html>