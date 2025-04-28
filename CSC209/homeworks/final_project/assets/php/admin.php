<?php
function interpolate_title(int $number, string $title): string {
  return normalize_int($number).'_' .
    str_replace(' ','_', strtolower($title));
}

/**
 * extends $int to hit $digits sig figs
 * @param int $int the int to extend
 * @param int $digits the number of digits required
 * @return string the stringified int with trailing 0s up to length digits
 */
function normalize_int(int $int, int $digits=2): string {
  $out = (string) $int;
  while (strlen($out) < $digits) {
    $out = "0$out";
  }
  return $out;
}