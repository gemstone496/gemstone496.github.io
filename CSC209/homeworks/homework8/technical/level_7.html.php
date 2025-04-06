<?php
include "../assets/php/h8_tech.php";
$TYPE = "Level 7";
$TIME = 5;
$HOME_LINK = "./tech.html.php";

$SLIDEPATHS = glob(find_asset("images").'*', GLOB_ONLYDIR);
$SLIDELIST = array();
foreach($SLIDEPATHS as $slidepath) {
  array_push($SLIDELIST, glob($slidepath.'/*'));
}
?>
<html>
<head>
  <title><?= $TYPE ?></title>
  <link rel="icon" type="image/x-icon" href="../assets/images/favicon.ico">
  <?php import_stylesheets(array("hw8_tech")); ?>
  <?php import_scripts(array("hw8_lvl7_tech")); ?>
</head>
<body class='dark-mode' onload='showSlides(1)'>
  
<section>
  <article style='max-width: fit-content;'>
    <div id='slideshow-container' class='slideshow-container'>
      <?php 
      for ($i = 0; $i < count($SLIDELIST); $i++) {
        $slides = $SLIDELIST[$i];
        $setname = basename($SLIDEPATHS[$i]);
        echo "<div id='$setname-slides' class='$setname ".($i == 0 ? 'show' : 'hide')."'>";
        echo gen_slides($slides, $setname);
        echo "</div>";
      }
      ?>
      
      <a class='prev' onclick='plusSlides(-1)'><</a>
      <a class='next' onclick='plusSlides(1)'>></a>
    </div><br>
  </article>

  <article style='max-width:20px;'>
    <div id='dots' style='text-align:center'>
      <?php 
      for ($i = 0; $i < count($SLIDELIST); $i++) {
        $slides = $SLIDELIST[$i];
        $setname = basename($SLIDEPATHS[$i]);
        echo "<div id='$setname-dots' class='".($i == 0 ? 'show' : 'hide')."'>";
        echo gen_dots(count($slides));
        echo "</div>";
      }
      ?>
    </div>
  </article>
</section>

<section>
  <label for='slidelist'>Choose a project: </label>
    <select id='slidelist' onchange='updateSet(this.value)'>
      <?php
      for ($i = 0; $i < count($SLIDELIST); $i++) {
        echo "<option value='".basename($SLIDEPATHS[$i])."'>".ucfirst(basename($SLIDEPATHS[$i]))."</option>";
      }
      ?>
    </select><br><br>
</section>

<section>
  <button id='dark-button' class='button' onclick='darkToggle()'>Light Mode</button>
</section>

<?php include "../layouts/footer_std.html.php";?>

</body></html>