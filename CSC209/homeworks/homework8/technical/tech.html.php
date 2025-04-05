<?php
include "../assets/php/helpers.php";
$TYPE = "Technical";
$TIME = "5";
$HOME_LINK = "../start_page.html.php";
$LEVELS = glob("*.*");
?>
<html>
<head>
  <title>Tutorials</title>
  <link rel="icon" type="image/x-icon" href="../assets/images/favicon.ico">
  <link rel="stylesheet" href="../assets/stylesheets/global.css">
  <link rel="stylesheet" href="../assets/stylesheets/dark_mode.css">
  <script src="../assets/javascript/helpers.js"></script>
</head>
<body class="dark-mode">

<div>
  <button id="dark-button" class="button" onclick="darkToggle()">Light Mode</button>
  <?php dump($LEVELS, array(basename(__FILE__))); ?>
</div>

<?php include "../layouts/footer_std.html.php";?>

</body></html>