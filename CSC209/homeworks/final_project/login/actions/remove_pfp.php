<?php
include_once "../assets/php/helpers.php";
include_once "../assets/php/users.php";

if (!session_id()) {
  session_start();
}
if (!isset($_SESSION["user"])) {
  $user = $_SESSION["user"];
}

if ($pfp = fetch_pfp($user) && unlink($pfp)) {
  echo "Profile picture removed successfully!";
} else {
  echo "";
}

