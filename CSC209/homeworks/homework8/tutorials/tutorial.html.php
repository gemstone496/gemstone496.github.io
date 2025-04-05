<?php
include "../assets/php/helpers.php";
$TYPE = "Tutorial";
$TIME = "3";
$HOME_LINK = "../start_page.html.php";
$TUTORIALS = glob("*.*");
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
  <h2>List of tutorials</h2>
  <button id="dark-button" class="button" onclick="darkToggle()">Light Mode</button>
  <?php dump($TUTORIALS, array(basename(__FILE__))); ?>
</div>

<?php include "../layouts/footer_std.html.php";?>

</body></html>