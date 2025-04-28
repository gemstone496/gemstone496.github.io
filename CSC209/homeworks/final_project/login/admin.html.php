<?php 
include_once "../assets/php/helpers.php";
include_once "../assets/php/comic.php";
include_once "../assets/php/users.php";

# never allow non-admins in here
session_start();
if (!isset($_SESSION["user"])) {
  header("Location: ../../comic/pages.html.php");
  die();
}
if (!is_admin($_SESSION["user"])) {
  header("Location: ../profile.html.php");
  die();
}

$chapters = glob(find_asset("images/pages")."*");
$pages = fetch_files($chapters);

$content_for["assets"] = ["admin"];
$content_for["content"] = '
<div>
  <h2 class="mb-1">Upload new page</h2>
  <form id="page-upload-form" method="post" action="./actions/add_page.php">
    <div id="upload-wrapper" class="col lr-pad">
      <div class="row mb-1">
        <label for="chapter-select">Select chapter: </label>
        <select id="chapter-select" name="chapter" onchange="validateChapter()">
          <option value="">Select chapter...</option>
          <option value="new">New chapter</option>';

for ($i = 0; $i < count($pages); $i++) {
  $content_for["content"] .= '
          <option value="'.$i.'">'.$i.' '.strip_filename($chapters[$i]).'</option>';
}

$content_for["content"] .= '
        </select>
      </div>
      <div class="col mb-1">
        <label for="page-upload" class="mb-1">Upload new page</label>
        <input id="page-upload" name="page-upload" type="file">
      </div>
      <div class="col mb-1">
        <label for="page-title">Page title (will be shown as alt text)</label>
        <input name="page-title" type="text">
      </div>
      <button class="btn" type="submit">Upload</button>
    </div>
  </form>
</div>';
?>

<?= render_layout("main", $content_for); ?>