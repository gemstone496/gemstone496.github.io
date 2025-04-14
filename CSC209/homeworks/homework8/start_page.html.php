<?php 
include './assets/php/helpers.php';
$REFS = array();
$TUTTIME = 3;
$TECHTIME = 10;
$CRTIME = 1;
?>
<html>

<?= docu_header() ?>

<body class="dark-mode">
<div>
  <a class="button" href="./lab1/table.html.php">Lab 1</a>  <a class="button" href="./lab2/whereami2.php">Lab 2</a><br><br>
  <a class="button" href="./tutorials/tutorial.html.php">Tutorial</a>  <a class="button" href="./technical/tech.html.php">Technical</a><br><br>
</div>

<?php include "./layouts/footer_home.html.php";?>

</body>
</html>