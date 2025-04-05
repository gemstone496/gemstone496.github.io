<?php 
function extractFolderName(string $path) {
  $basename = basename($path);
  $chars = preg_split('//u', $basename, -1, PREG_SPLIT_NO_EMPTY); // https://www.geeksforgeeks.org/how-to-iterate-over-characters-of-a-string-in-php/
  $numStr = "";
  foreach ($chars as $char) {
    if (is_numeric($char)) { $numStr = $numStr.$char; }
    else { $numStr = ""; }
  }
  $numStr = $numStr == "" ? 0 : $numStr;
  return intval($numStr);
}
?>