<?php 
include_once "../assets/php/helpers.php";
include_once "../assets/php/users.php";

session_start();
if (!isset($_SESSION["user"])) {
  header("Location: ../comic/pages.html.php");
  die();
} elseif (is_admin($_SESSION["user"])) {
  header("Location: ./admin.html.php");
  die();
}


$content_for["assets"] = [];
$content_for["content"] = $_SESSION["user"];
?>

<?= render_layout("main", $content_for);