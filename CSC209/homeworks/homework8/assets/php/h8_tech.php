<?php
include 'helpers.php';

/**
 * dumps all the images from the array
 * @param imgs the array of image filepaths to dump
 * @param classifier the group name of the images (default `bonfire`)
 */
function image_dump(array $imgs, string $classifier = 'bonfire') {
  foreach ($imgs as $img) {
    echo "<img class='$classifier' src='".$img."'>";
  } 
}

/**
 * generates slideshow from supplied files
 * @param imgs the array of image filepaths to use for the slides
 * @param classifier the group name of the images (default `bonfire`)
 */
function gen_slides(array $imgs, string $classifier = 'bonfire') {
  $printout = "";
  $num_slides = count($imgs);
  for ($i = 1; $i <= $num_slides; $i++) {
    $img = $imgs[$i-1];
    $caption = strip_filename($img);
    $printout .= "
      <div id='$caption' class='slide fade inactive'>
        <div class='numbertext'>$i / $num_slides</div>
        <img class='$classifier-slide' src='$img' alt='$caption'>
        <div class='text'>$caption</div>
      </div>";
  }
  return $printout;
}

/**
 * generates clickable dots to highlight which image is selected
 * @param count the number of images in the slideshow
 */
function gen_dots(int $count) {
  $printout = "";
  for ($i = 1; $i <= $count; $i++) {
    $printout .= "<span class='dot' onclick='currentSlide($i)'></span><br>";
  }
  return $printout;
}
?>