<?php
include "../assets/php/h8_tech.php";
$TYPE = "Level 7";
$TIME = 6;
$HOME_LINK = "./tech.html.php";
$DARK_BUTTON = true;

$SLIDEPATHS = asset_dirsearch("images");
$SLIDELIST = fetch_files($SLIDEPATHS);
?>
<html>
<?= docu_header($TYPE, array("hw8_tech", "hw8_lvl7_tech")) ?>

<body class='dark-mode' onload='updateSet("<?= basename($SLIDEPATHS[0]) ?>")'>
<?= insert_slideshows($SLIDELIST, $SLIDEPATHS); ?>

<br><section>
  
</section>

<?php include "../layouts/footer_std.html.php"; // TODO change to render method ?>

</body></html>