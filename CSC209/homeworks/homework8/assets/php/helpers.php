<?php
/**
 * @param assetname subfolder of assets to search for images in (default `assets`)
 */
function asset_dirsearch(string $assetname = "assets") {

}

/**
 * @param specials specialized stylesheets to import. DO NOT include `.css`, i will do that for you
 * @param dirname the directory name to search for (by default searches for `stylesheets`)
 * @param defaults the file names (name only, no suffix) to import by default
 */
function import_stylesheets(array $specials, 
                            string $dirname = "stylesheets", 
                            array $defaults = array("global", "dark_mode")) {
  $stylesheets = find_asset($dirname);
  $sheetnames = array_merge($defaults, $specials);
  foreach ($sheetnames as $file) {
    if (is_file($stylesheets.$file.'.css')) {
      echo "<link rel='stylesheet' href='".$stylesheets.$file.".css'>";
    }
  }
}

/**
 * @param specials specialized stylesheets to import. DO NOT include `.js`, i will do that for you
 * @param dirname the directory name to search for (by default searches for `javascript`)
 * @param defaults the file names (name only, no suffix) to search for by default
 */
function import_scripts(array $specials, 
                            string $dirname = "javascript", 
                            array $defaults = array("helpers")) {
  $scripts = find_asset($dirname);
  $scriptnames = array_merge($defaults, $specials);
  foreach ($scriptnames as $file) {
    if (is_file($scripts.$file.'.js')) {
      echo "<script src='".$scripts.$file.".js'></script>";
    }
  }
}

/**
 * finds the asset folder and returns the pathname to the specified subfolder
 * @param dirname the name of the directory in assets to search for
 * @return `[../]*assets/$dirname/`, or just `[../]*assets/` if not found
 */
function find_asset(string $dirname) {
  $wcd = '.';
  for ($i = 0; $i < 5; $i++) { // don't go more than 5 layers up
    if(is_dir($wcd."/assets")) {
      $wcd .= "/assets";
      break;
    } elseif (is_dir($wcd."/$dirname")) { // e.g. a `css` folder
      break;
    } else {
      $wcd .= '/..';
    }
  }
  if (is_dir($wcd."/$dirname")) {
    $wcd .= "/$dirname";
  }
  return $wcd.'/';
}

/**
 * dumps supplied files into an ordered list
 * @param files the array of all files to dump
 * @param exclude (optional) the array of files included in the list which should not be dumped
 */
function dump(array $files, array $exclude = array()) {
  echo "<ol>";
  foreach ($files as $file) {
    if (!in_array($file, $exclude)) {
      echo "<li><a href=$file>";
      echo( strip_filename($file) );
      echo "</a></li>";
    }
  }
  echo "</ol>";
}

/**
 * strips a supplied filename to human-readable caption
 * @param filename the name to strip down
 */
function strip_filename(string $filename) {
  return ucfirst(preg_replace("/[_-]/", " ", preg_replace("/\.(\w*)/", "", basename($filename))));
}
?>