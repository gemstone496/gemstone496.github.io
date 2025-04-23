<?php
declare(strict_types= 1);

/**
 * finds the asset and returns the pathname to the specified file or directory
 * @param string $dirname the name of the directory in assets to search for
 * @return string `./[../]*assets/$dirname[/]`, or just `[../]*assets/` if not found
 */
function find_asset(string $dirname = "assets"): string {
  $wcd = '.';
  for ($i = 0; $i < 5; $i++) { // don't go more than 5 layers up
    if(file_exists("$wcd/$dirname")) { // if you find the asset here, leave
      break;
    } elseif (is_dir("$wcd/assets")) { // if there's an `assets` folder, go there
      $wcd .= "/assets";
      break;
    } else {
      $wcd .= '/..';
    }
  }
  if (file_exists("$wcd/$dirname")) {
    $wcd .= "/$dirname";
  }
  if (is_dir($wcd)) {
    $wcd .= "/";
  }
  return $wcd;
}

/**
 * @param array $specials specialized stylesheets to import. DO NOT include `.css`, i will do that for you
 * @param string $dirname the directory name to search for (by default searches for `stylesheets`)
 * @param array $defaults the file names (name only, no suffix) to import by default
 * @return string the html markup for the page stylesheet link tags
 */
function import_stylesheets(array $specials,
                            string $dirname = "stylesheets", 
                            array $defaults = ["global"]): string {
  $printout = "";
  $stylesheets = find_asset($dirname);
  $sheetnames = array_merge($defaults, $specials);
  foreach ($sheetnames as $file) {
    if (is_file("$stylesheets$file.css")) {
      $printout .= "<link rel='stylesheet' href='$stylesheets$file.css'>";
    }
  }
  return $printout;
}

/**
 * @param array $specials specialized scripts to import. DO NOT include `.js`, i will do that for you
 * @param string $dirname the directory name to search for (by default searches for `javascript`)
 * @param array $defaults the file names (name only, no suffix) to search for by default
 * @return string the html markup for the js script tags
 */
function import_scripts(array $specials, 
                        string $dirname = "javascript", 
                        array $defaults = ["global"]): string {
  $printout = "";
  $scripts = find_asset($dirname);
  $scriptnames = array_merge($defaults, $specials);
  foreach ($scriptnames as $file) {
    if (is_file("$scripts$file.js")) {
      $printout .= "<script src='$scripts$file.js'></script>";
    }
  }
  return $printout;
}

/**
 * reads data from a specified .json file on the server
 * @param mixed $path the full path to the file (use path generation methods elsewhere!!)
 */
function read_data($path) {
  $fp = fopen($path, "r");
    $json = fread($fp, filesize($path));
    $content = json_decode($json,true);
  fclose($fp);
  return $content;
}

/**
 * renderer for repeated layouts (header, footer, login pages, etc)
 * @param string $layout the name of the page's layout (e.g. `main` or `login`)
 * @param array $args any args used by the layout, by associative array (should all be optional in they layout)
 */
function render_layout(string $layout, array $content_for = []): void {
  $layout_path = find_asset("layouts").$layout.'.php';
  include $layout_path;
}

/**
 * strips a supplied filename to human-readable caption
 * @param string $filename the name to strip down
 * @param bool $cap whether to capitalize the first letter
 * @return string the cleaned and stripped readable filename
 */
function strip_filename(string $filename, bool $cap = true): string {
  $stripped = preg_replace("/[_-]/", " ",  # delineators swap to spaces
    preg_replace("/^[0-9]+[_-]/","", # clean page numbers/ch numbers
      preg_replace("/\.(\w*)/", "", basename($filename)) # clean file suffixes
    )
  );
  return $cap ? ucfirst($stripped) : $stripped; # capitalize first letter if appropriate
}

/**
 * strips the provided string input from client (for form handling)
 * @param string $input the client's input
 * @return string the stripped, html_safe version of input
 */
function strip_input(string $input): string {
  return htmlspecialchars($input);
}