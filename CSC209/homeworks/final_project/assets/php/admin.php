<?php
/**
 * takes a number and a string and interprets them into the format for new page uploads: xx_title_words
 * @param int $number number to interpolate
 * @param string $title raw title to interpolate
 * @return string the correct formatted title
 */
function interpolate_title(int $number, string $title): string {
  return normalize_int($number).'_' .
    str_replace(' ','_', strtolower($title));
}

/**
 * generates full list of users for admins to moderate
 * @return string the html output to write the full list of users
 */
function generate_user_list(): string {
  $printout = '
  ';
  $userlist = glob(find_asset('data/users').'*');
  foreach ($userlist as $user) {
    $username = basename($user);
    $printout .= '<div class="row">
    '.$username.'
    <button class="btn abort-btn" onclick="showAdminModal(\'delete-account-modal\', \''.$username.'\')"'.(
      is_admin($username) ? ' disabled' : ''
    ).'>
      '.(is_admin($username) ? ' ADMIN' : 'Delete User').'
    </button>
  </div>';
  }

  return $printout;
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