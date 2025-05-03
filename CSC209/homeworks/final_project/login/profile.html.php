<?php 
include_once "../assets/php/helpers.php";
include_once "../assets/php/users.php";

if (!session_id()) {
  session_start();
}
if (!isset($_SESSION["user"])) {
  header("Location: ../comic/pages.html.php");
  die();
} elseif (is_admin($_SESSION["user"])) {
  header("Location: ./admin.html.php");
  die();
}

$user = $_SESSION["user"];

$content_for["assets"] = ["profile"];
$content_for["content"] = generate_profile_header($user).'';
?>

<?= render_layout("main", $content_for);