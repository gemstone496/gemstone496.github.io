<?php 
include_once "../../assets/php/helpers.php";
include_once "../../assets/php/admin.php";
include_once "../../assets/php/comic.php";
include_once "../../assets/php/users.php";

# never allow non-admins in here
session_start();
if (!isset($_SESSION["user"])) {
  header("Location: ../../comic/pages.html.php");
  die();
}
if (!is_admin($_SESSION["user"])) {
  header("Location: ../profile.html.php");
  die();
} if ( !(
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

# https://www.php.net/manual/en/features.file-upload.php
# code for the rest of this file is modified off of the base from this post in the php docs page
try {
  // Undefined | Multiple Files | $_FILES Corruption Attack
  // If this request falls under any of them, treat it invalid.
  if (
    !isset($_FILES['page-upload']['error']) ||
    is_array($_FILES['page-upload']['error'])
  ) {
    throw new RuntimeException('Invalid parameters.');
  }

  // Check $_FILES['page-upload']['error'] value.
  switch ($_FILES['page-upload']['error']) {
    case UPLOAD_ERR_OK:
      break;
    case UPLOAD_ERR_NO_FILE:
      throw new RuntimeException('No file sent.');
    case UPLOAD_ERR_INI_SIZE:
    case UPLOAD_ERR_FORM_SIZE:
      throw new RuntimeException('Exceeded filesize limit.');
    default:
      throw new RuntimeException('Other errors.');
  }

  // You should also check filesize here. 
  if ($_FILES['page-upload']['size'] > 7500000) {
    throw new RuntimeException('Exceeded filesize limit.');
  }

  # resource https://www.php.net/manual/en/features.file-upload.php said this method is unreliable. i'm inclined to trust it, as it's in the official php docs page
  # unfortunately, idk how to get finfo to work properly without a php.ini file that you wouldn't have anyways
  # code snippets, for this block only, modified from https://www.geeksforgeeks.org/how-to-check-the-type-and-size-before-file-uploading-in-php/
  $ext = strtolower(pathinfo($_FILES['page-upload']['name'], PATHINFO_EXTENSION));
  if (false === array_search(
    $ext,
    ['jpg', 'jpeg', 'png', "bmp"],
    true
  )) {
    throw new RuntimeException('Invalid file format.');
  }

  // name it
  // DO NOT USE $_FILES['page-upload']['name'] WITHOUT ANY VALIDATION !!
  // On this example, obtain safe unique name from its binary data.
  if (!move_uploaded_file(
    $_FILES['page-upload']['tmp_name'],
    sprintf("$page_path.%s", $ext)
  )) {
    throw new RuntimeException('Failed to move uploaded file.');
  }
} catch (RuntimeException $e) {

  echo $e->getMessage();

}

header('Location: ../../comic/pages.html.php');
die();