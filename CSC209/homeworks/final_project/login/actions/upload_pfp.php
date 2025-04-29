<?php
include_once "../../assets/php/helpers.php";
include_once "../../assets/php/admin.php";
include_once "../../assets/php/upload_file.php";
include_once "../../assets/php/users.php";

if (!session_id()) {
  session_start();
}
if (!isset($_SESSION["user"])) {
  header("Location: ../comic/pages.html.php");
  die();
}

$user = $_SESSION["user"];

$upload_dir = find_asset("data/users/$user");
$upload_name = $upload_dir."_pfp_$user";
$pfp = fetch_pfp($user);

if (upload_file($_FILES["pfp-upload"], $upload_name)) {
  if(count(glob($upload_dir."_php_$user")) > 1) {
    unlink($pfp);
  }
}

header("Location: ../profile.html.php");
die();