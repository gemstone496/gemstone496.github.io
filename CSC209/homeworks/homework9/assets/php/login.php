<?php
include_once "helpers.php";

/**
 * Counts the number of users in provided filename
 * @param string $filename name of file to count
 * @return int half the number of lines in file
 */
function count_users(string $filename): int {
  $filepath = find_asset("output").$filename;
  return count(read_data($filepath)); // every user made 2 entries
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
  $users = read_data(find_asset("output")."users.json");

  return $users[$username] === $password;
}