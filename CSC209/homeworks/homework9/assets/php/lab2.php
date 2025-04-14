<?php 

/**
 * Counts the number of users in provided filename
 * @param string $filename name of file to count
 * @return int half the number of lines in file
 */
function count_users(string $filename): int {
  $filepath = find_asset("output").$filename;
  $count = 0;
  $user_file = fopen($filepath, "r");
  while (($line = fgets($user_file)) !== false) {
    $count++;
  }
  fclose($user_file);
  return $count / 2; // every user made 2 entries
}

/**
 * extracts the numerical suffix of the folder provided
 * @param string $path the path to the folder
 * @return int its numerical suffix
 */
function extractFolderName(string $path): int {
  $basename = basename($path);
  $chars = preg_split('//u', $basename, -1, PREG_SPLIT_NO_EMPTY); // https://www.geeksforgeeks.org/how-to-iterate-over-characters-of-a-string-in-php/
  $numStr = "";
  foreach ($chars as $char) {
    $numStr = is_numeric($char) ? $numStr.$char : "";
  }
  $numStr = $numStr == "" ? 0 : $numStr;
  return intval($numStr);
}