<?php 
include_once "../assets/php/helpers.php";
include_once "../assets/php/comic.php";
include_once "../assets/php/users.php";

# never allow non-admins in here
session_start();
if (!isset($_SESSION["user"])) {
  header("Location: ../comic/pages.html.php");
  die();
}
if (!is_admin($_SESSION["user"])) {
  header("Location: ./profile.html.php");
  die();
}