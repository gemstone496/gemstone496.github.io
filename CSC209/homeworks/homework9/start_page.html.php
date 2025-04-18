<?php 
include_once './assets/php/helpers.php';
$layout_args = [
  "type" => "Homework 9",
  "dark_button" => true,
  "refs" => [],
  "tut_time" => 5,
  "tech_time" => 5,
  "cr_time" => 4
];
?>
<html>

<?= render_layout("head", $layout_args) ?>

<body class="dark-mode">
<div>
  <a class="button" href="./lab1/login.html">Lab 1</a>
  <a class="button" href="./lab2/login.html.php">Lab 2</a><br><br>
  <a class="button" href="./tutorials/tutorial.html.php">Tutorial</a>
  <a class="button" href="./technical/tech.html.php">Technical</a>
  <a class="button" href="./creative/login.html.php">Creative</a><br><br>
</div>

<?php 
render_layout(
  "footer_home",
  $layout_args
)
?>

</body>
</html>