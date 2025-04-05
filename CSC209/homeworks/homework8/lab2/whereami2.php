<?php
$TYPE = "Lab";
$TIME = "0.5";
?>

<html>
<head>

  
<?php
  include "../assets/php/lab2.php";
  $path = realpath(__DIR__);
  $labNum = extractFolderName($path);
?>

</head>
<body>

This page figures out its whereabouts.
This file is in lab #<?= $labNum ?>.

<?php include "../layouts/footer_std.html.php";?>

</body>
</html>