<?php
include_once "../assets/php/helpers.php";
include_once "../assets/php/users.php";

$uname = strip_input($_POST["uname"]);
$psw = strip_input($_POST["psw"]);

if (!validate_login($uname, $psw)) {
  $_POST["FAILURE"];
  header("Location: login.html.php");
  die();
}

$_SESSION["user"] = $uname;

if(is_admin($uname)) {
  header("Location: admin.html.php");
  die();
}

header("Location: ../comic/pages.html.php");
die();