<?php
include 'helpers.php';

/**
 * @param string $asset_name subfolder of assets to search for images in (default `assets`)
 */
function asset_dirsearch(string $asset_name = "assets") {
  $paths = glob(find_asset($asset_name).'*', GLOB_ONLYDIR);
  return $paths;
}

/**
 * @param array $files_to_fetch the list of directories containing the desired files.
 * Each directory will correspond to a column in the 2d array returned
 */
function fetch_files(array $files_to_fetch) {
  $files = [];
  foreach($files_to_fetch as $path) {
    array_push($files, glob("$path/*"));
  }
  return $files;
}

/**
 * dumps all the images from the array
 * @param array $imgs the array of image filepaths to dump
 * @param string $classifier the group name of the images (default `bonfire`)
 */
function image_dump(array $imgs, string $classifier = 'bonfire') {
  foreach ($imgs as $img) {
    echo "<img class='$classifier' src='".$img."'>";
  }
}

/**
 * generates slideshow from supplied files
 * @param array $imgs the array of image filepaths to use for the slides
 * @param string $classifier the group name of the images (default `bonfire`)
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
 * @param int $count the number of images in the slideshow
 */
function gen_dots(int $count) {
  $printout = "";
  for ($i = 1; $i <= $count; $i++) {
    $printout .= "<span class='dot' onclick='currentSlide($i)'></span><br>";
  }
  return $printout;
}

/**
 * generates html to insert a set of slideshows so that they can easily be swapped
 * @param array $slideshows the array different slideshows (each an array of image paths)
 * @param array $paths the paths to each set of slideshow (for classifying each)
 */
function insert_slideshows(array $slideshows, array $paths) {

  $html_slides = "";
  $html_dots = "";
  $html_selector = "";
  for ($i = 0; $i < count($slideshows); $i++) {
    $slides = $slideshows[$i];
    $setname = basename($paths[$i]);
    $html_slides .= "
        <div id='$setname-slides' class='$setname ".($i == 0 ? 'show' : 'hide')."'>
          ".gen_slides($slides, $setname)."</div>";
    $html_dots .= "
        <div id='$setname-dots' class='".($i == 0 ? 'show' : 'hide')."'>
          ".gen_dots(count($slideshows[$i]))."</div>";
    $html_selector .= "
        <option value='$setname'>".ucfirst($setname)."</option>";
  }
  
  $printout = "
  <section class='flex-center'>
    <article style='max-width: fit-content;'>
      <div id='slideshow-container' class='slideshow-container'>$html_slides
        <a class='prev' onclick='plusSlides(-1)'><</a>
        <a class='next' onclick='plusSlides(1)'>></a>
      </div><br>
    </article>
    <article style='max-width: fit-content;'>
      <div id='dots'>$html_dots
      </div>
    </article>
  </section>
  
  <section class='flex-center'>
    <label for='slidelist'>Choose a project: </label>
      <select id='slidelist' class='button' onchange='updateSet(this.value)'>$html_selector
      </select>
  </section>
  ";

  return $printout;
}
?>