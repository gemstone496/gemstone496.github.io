<?php
include_once "../../assets/php/helpers.php";
include_once "../../assets/php/admin.php";
include_once "../../assets/php/users.php";

if (!session_id()) {
  session_start();
}
if (!isset($_SESSION["user"])) {
  header("Location: ../../comic/pages.html.php");
  die();
}

$user = $_SESSION["user"];
if (is_admin($user) && isset($_GET["admin-delete"])) { # admins delete other accounts!
  $user = $_GET["admin-delete"];
  echo "<div class='verifier'>Deleted account <code>$user</code></div>";
} 
if (!is_admin($user)) { # admin accounts are not deletable
  $user_dir = find_asset("data/users/$user");
  $user_files = glob("$user_dir*");
  foreach ($user_files as $file) {
    unlink($file);
  }
  rmdir($user_dir);
  
  if (!is_admin($_SESSION["user"])) {
    unset($_SESSION["user"]);
    header("Location: ../../comic/pages.html.php");
    die();
  } else {
    echo generate_user_list();
  }
}