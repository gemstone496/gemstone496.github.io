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
$user = $_SESSION["user"];

$chapters = glob(find_asset("images/pages")."*");

$content_for["assets"] = ["admin", "profile"];
$content_for["content"] = generate_profile_header($user).'
<div class="row full-width tb-pad">
  <div class="col center lr-pad tb-pad full-width border white">
    <h2 class="row center mb-3">Upload new page</h2>
    <form id="page-upload-form" class="full-width" method="post" enctype="multipart/form-data"
          onsubmit="verifySubmit(event, \'page-upload-form\')" action="./actions/add_page.php">
      <div id="upload-wrapper" class="col lr-pad">
        <input name="MAX_FILE_SIZE" type="hidden" value="7500000">
        <div id="ch-select-wrapper" class="col flex-left mb-1 lr-pad">
          <label for="ch-select" class="mb-1">
            Select chapter: <span id="ch-select-verifier" class="verifier"></span></label>
          <select id="ch-select" name="chapter" class="mb-1" onchange="newChapter(this, \'new-ch-wrapper\', \'ch-title\')">
            <option value="">Select chapter...</option>
            <option value="new">New chapter</option>';

  for ($i = 0; $i < count($chapters); $i++) {
    $content_for["content"] .= '
            <option value="'.$i.'">'.$i.'. '.strip_filename($chapters[$i]).'</option>';
  }

  $content_for["content"] .= '
          </select>
        </div>
        <div id="new-ch-wrapper" class="col flex-left mb-1 lr-pad hidden">
          <label for="ch-title" class="mb-1">
            Chapter title: <span id="ch-title-verifier" class="verifier"></span>
          </label>
          <input id="ch-title" name="ch-title" type="text" class="mb-1 hidden"
                  placeholder="Enter Chapter Name" oninput="validateInputField(\'ch-title\')">
        </div>
        <div class="col flex-left mb-1 lr-pad">
          <label for="page-title" class="mb-1">
            Page title: <span id="page-title-verifier" class="verifier"></span>
          </label>
          <input id="page-title" name="page-title" type="text" 
                 placeholder="Enter Page Title" oninput="validateInputField(\'page-title\')">
        </div>
        <div class="col flex-left mb-3 lr-pad">
          <label for="page-upload" class="mb-1">
            Upload new page <span id="page-upload-verifier" class="verifier"></span>
          </label>
          <input id="page-upload" name="page-upload" type="file" onchange=validateInputField(\'page-upload\')>
        </div>
        <button class="btn center full-width" type="submit">Upload</button>
      </div>
    </form>
  </div>
  <div class="col center lr-pad full-width">

  </div>
</div>';
?>

<?= render_layout("main", $content_for); ?>