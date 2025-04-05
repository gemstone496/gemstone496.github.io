<?php
include "../assets/php/h8_tech.php";
$TYPE = "Level 6";
$TIME = 3;
$HOME_LINK = "./tech.html.php";
$IMGS = glob(find_asset("images/bonfire").'*');
?>
<html>
<head>
  <title><?= $TYPE ?></title>
  <link rel="icon" type="image/x-icon" href="../assets/images/favicon.ico">
  <?php import_stylesheets(array("hw8_tech")); ?>
  <script src="../assets/javascript/helpers.js"></script>
  <script src="../assets/javascript/hw8_tech.js"></script>
</head>
<body class="dark-mode" onload="showSlides(1)">

<section>
  <article style="max-width: fit-content;">
    <div id="slideshow-container" class="slideshow-container">
      <?= gen_slides($IMGS); ?>
      
      <a class="prev" onclick="plusSlides(-1)"><</a>
      <a class="next" onclick="plusSlides(1)">></a>
    </div><br>
  </article>

  <article style="max-width:20px;">
    <div id="dots" style="text-align:center">
      <?= gen_dots(count($IMGS)); ?>
    </div>
  </article>
</section>

<section>
  <button id="dark-button" class="button" onclick="darkToggle()">Light Mode</button>
</section>

<?php include "../layouts/footer_std.html.php";?>

</body></html>