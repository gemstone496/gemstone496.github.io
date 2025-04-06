<?php
include "../assets/php/helpers.php";
$TYPE = "Technical";
$TIME = "10";
$HOME_LINK = "../start_page.html.php";
$LEVELS = glob("*.*");
?>
<html>
<head>
  <title>Tutorials</title>
  <link rel="icon" type="image/x-icon" href="../assets/images/favicon.ico">
  <?php import_stylesheets(array()); ?>
  <?php import_scripts(array()); ?>
</head>
<body class="dark-mode">

<div>
  <button id="dark-button" class="button" onclick="darkToggle()">Light Mode</button>
  <?php dump($LEVELS, array(basename(__FILE__))); ?>
</div>

<?php include "../layouts/footer_std.html.php";?>

</body></html>