<?php
include_once "../assets/php/helpers.php";
$layout_args = [
  "type" => "Technical",
  "time" => "5",
  "home" => "../start_page.html.php"
];

$LEVELS = glob("*.*");
?>

<html>

<?= render_layout("head", $layout_args) ?>

<body class="dark-mode">

<div>
  <button id="dark-button" class="button" onclick="darkToggle()">Light Mode</button>
  <?= dump($LEVELS, [basename(__FILE__), "profile.html.php"]); ?>
</div>

<?= render_layout(
  "footer_std",
  $layout_args
); ?>

</body></html>