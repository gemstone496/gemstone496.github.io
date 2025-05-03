<?php
include_once "../../assets/php/helpers.php";
include_once "../../assets/php/users.php";

session_start();
if (isset($_SESSION["user"])) {
  unset($_SESSION["user"]);
}

header("Location: ../../comic/pages.html.php");