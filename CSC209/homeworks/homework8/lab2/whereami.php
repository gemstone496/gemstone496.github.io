<?php
$TYPE = "Lab";
$TIME = "0.5";
$HOME_LINK = "../sta"
?>

<html>
<head>

  
<?php
  $path = realpath(__DIR__);
  $basename = basename($path);
  $labNumStr = substr($basename, strlen($basename)-1, strlen($basename)); 
  $labNum = is_numeric($labNumStr) ? intval($labNumStr) : "??";
?>

</head>
<body>

This page figures out its whereabouts.
This file is in lab #<?= $labNum ?>.

<?php include "../layouts/footer_std.html.php";?>

</body>
</html>