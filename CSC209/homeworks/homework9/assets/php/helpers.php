<?php

/**
 * renderer for repeated layouts. 
 * work in progress to figure out how to do proper layouts, for now i can't use a yield
 * layouts just are for dedicated code segments (head, header, footer, etc) not a full-page spread
 * @param string $style the name of the layout to include (e.g. `footer_std` or `head`)
 * @param array $args any args used by the layout. build layouts so required args have defaults!
 */
function render_layout(string $style, array $render_args = []): void {
  $layout_path = find_asset("layouts").$style.'.html.php';
  include $layout_path;
}

/**
 * @param array $specials specialized stylesheets to import. DO NOT include `.css`, i will do that for you
 * @param string $dirname the directory name to search for (by default searches for `stylesheets`)
 * @param array $defaults the file names (name only, no suffix) to import by default
 * @return string the html markup for the page stylesheet link tags
 */
function import_stylesheets(array $specials,
                            string $dirname = "stylesheets", 
                            array $defaults = ["global", "dark_mode"]): string {
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
 * @param array $specials specialized stylesheets to import. DO NOT include `.js`, i will do that for you
 * @param string $dirname the directory name to search for (by default searches for `javascript`)
 * @param array $defaults the file names (name only, no suffix) to search for by default
 * @return string the html markup for the js script tags
 */
function import_scripts(array $specials, 
                        string $dirname = "javascript", 
                        array $defaults = ["helpers"]): string {
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
 * finds the asset folder and returns the pathname to the specified subfolder
 * @param string $dirname the name of the directory in assets to search for
 * @return string `[../]*assets/$dirname/`, or just `[../]*assets/` if not found
 */
function find_asset(string $dirname = "assets"): string {
  $wcd = '.';
  for ($i = 0; $i < 5; $i++) { // don't go more than 5 layers up
    if(is_dir("$wcd/$dirname")) { // if you find the asset here, leave
      break;
    } elseif (is_dir("$wcd/assets")) { // if there's an `assets` folder, go there
      $wcd .= "/assets";
      break;
    } else {
      $wcd .= '/..';
    }
  }
  if (is_dir("$wcd/$dirname")) {
    $wcd .= "/$dirname";
  }
  return "$wcd/";
}

/**
 * dumps supplied files into an ordered list
 * @param array $files the array of all files to dump
 * @param array $exclude (optional) the array of files included in the list which should not be dumped
 * @return string the html markup for an ordered list of the specified files
 */
function dump(array $files, array $exclude = []): string {
  $printout = "<ol>";
  foreach ($files as $file) {
    if (!in_array($file, $exclude)) {
      $printout .= "<li><a href=$file>";
      $printout .= strip_filename($file);
      $printout .= "</a></li>";
    }
  }
  $printout .= "</ol>";

  return $printout;
}

/**
 * strips a supplied filename to human-readable caption
 * @param string $filename the name to strip down
 * @return string the cleaned and stripped readable filename
 */
function strip_filename(string $filename): string {
  return ucfirst(preg_replace("/[_-]/", " ", preg_replace("/\.(\w*)/", "", basename($filename))));
}

/**
 * @deprec hw 9
 * use `render_layout("head", [ "type" => <type>, "special_assets" => [<specials>] ])
 */
function docu_header(string $type = "Daughter of the Blaze", array $special_assets = []): string {
  $html = "";
  $html .= "<head>
    <title>$type</title>
    <link rel='icon' type='image/x-icon' href='".find_asset("images")."favicon.ico'>
    ".import_stylesheets($special_assets)."
    ".import_scripts($special_assets)."\n</head>";
  return $html;
}