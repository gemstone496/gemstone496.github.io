<?php
include "../assets/php/helpers.php";
$layout_args = [
  "type" => "Tutorial",
  "time" => "0",
  "home" => "../start_page.html.php"
];

$tutorials = glob("*.*");
?>
<html>

<?= render_layout("head", $layout_args) ?>

<body class="dark-mode">

<div>
  <h2>List of tutorials</h2>
  <button id="dark-button" class="button" onclick="darkToggle()">Light Mode</button>
  <?php dump($tutorials, [basename(__FILE__)]); ?>
</div>

<?php render_layout(
  "footer_std",
  $layout_args
); ?>

</body></html>