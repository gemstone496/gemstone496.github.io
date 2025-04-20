<?php
/**
 * Fetches all the pages from the listed chapters and returns them
 * @param array $dirlist the list of chapters
 * @return array<string[]> an entry for every chapter containing its pagelist
 */
function fetch_files(array $dirlist) {
  $pages = [];
  foreach($dirlist as $dir) {
    if (is_dir($dir)) {
      $pages[] = glob("$dir/*");
    } else if (is_file($dir)) {
      $pages[] = [$dir];
    }
  }
  return $pages;
}