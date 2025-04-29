<?php 
include_once "../../assets/php/helpers.php";
include_once "../../assets/php/admin.php";
include_once "../../assets/php/comic.php";
include_once "../../assets/php/upload_file.php";
include_once "../../assets/php/users.php";

# never allow non-admins in here
if (!session_id()) {
  session_start();
}
if (!isset($_SESSION["user"])) {
  header("Location: ../../comic/pages.html.php");
  die();
}
if (!is_admin($_SESSION["user"])) {
  header("Location: ../profile.html.php");
  die();
}

if ( !(
        isset($_POST["chapter"]) &&
        isset($_POST["page-title"]) &&
        ($_POST["chapter"] !== "new" || isset($_POST["ch-title"]))
        )) {
    header("Location: ../admin.html.php");
    die();
}

$chapters = glob(find_asset("images/pages")."*");
$pages = fetch_files($chapters);

$ch = $_POST["chapter"];
if ($ch === "new") {
  $ch = count($chapters)+1; # for some forsaken reason i 1-indexed them but 0-indexed the displays T-T
  $ch_name = interpolate_title($ch, $_POST["ch-title"]);
  if (!mkdir($ch_path = find_asset("images/pages").$ch_name)) {
    throw new RuntimeException("Failed to create directory `$ch_path`");
  }
}
$page = count($pages[$ch] ?? []); // weird interpolation here don't question it
$ch_path ??= $chapters[$ch];

$page_name = interpolate_title($page, $_POST["page-title"]);
$page_path = "$ch_path/$page_name";

if (upload_file($_FILES['page-upload'], $page_path)) {
  header('Location: ../../comic/pages.html.php');
  die();
}

header('Location: ../admin.html.php');
die();