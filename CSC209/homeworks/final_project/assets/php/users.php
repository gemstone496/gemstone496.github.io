<?php
include_once "helpers.php";

/**
 * is the specified user an admin?
 * @param string $uname username to look up
 * @return bool Y/N is uname in the set of admins
 */
function is_admin(string $uname): bool {
  $admins = read_data(find_asset("users").'admins.json');
  // admins["$uname"] exists iff $uname is admin.
  // stored in associative array for faster lookups.
  // the site has no built-in ways to change admins, they are fixed.
  return $admins && array_key_exists($uname, $admins);
}

/**
 * returns the password of user $uname, null if user does not exist
 * WARNING: this method uses slow lookups. may need adjustment for larger userbases
 * @param string $uname the username to check
 * @return string username's password
 */
function user_psw(string $uname): string {
  $users = glob(find_asset('data/users').'*');
  foreach ($users as $user) {
    if (strip_filename($user, false) === $uname) {
      return read_data($user)["psw"];
    }
  }
  return null;
}

/**
 * do my inputs match my outputs? let's find out!
 * @param string $username raw user input (to be escaped)
 * @param string $password raw password to match
 * @return bool do they match?
 */
function validate_login(string $username, string $password): bool {
  $username = strip_input($username);
  $password = strip_input($password);

  return $password !== null && $password === user_psw($username);
}