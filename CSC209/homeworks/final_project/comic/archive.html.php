<?php
include_once "../assets/php/helpers.php";

$content_for["name"] = "Archive";
$content_for["assets"] = "archive";

$chapters = glob(find_asset("images/pages"));
$pages = [];
foreach($chapters as $chapter) {
  if (is_dir($chapter)) {
    $pages[] = glob($chapter);
  } else if (is_file($chapter)) {
    $pages[] = [$chapter];
  }
}

# deal with the fucked up indentation it's for formatting raw html
$content = '
<h2>Latest Page</h2>
<p>Check out the latest page <a href="./comic.html.php">here!</a></p>
<h2>Archive</h2>
<p>Select a page from the dropdown to start reading.</p>
<select id="archive" onchange="setPage(this.value)">
  <option value>Select page...</option>';
for ($i = 0; $i < count($pages); $i++) {
  foreach ($pages[$i] as $page) {
    $dropdown .= ' 
  <option value="'.$page.'>'.strip_filename($page).'</option>';
  }
}
$dropdown .= '
</select>';

$chapters = '
<h2>Chapters</h2><hr>';
for ($i = 0; $i < count($pages); $i++) {
  $chapters .= '
<div class="storyline-mark">
  <div class="storyline-thumbnail">
    <a href="'.($pages[$i][0]).'">
      <img src="'.($pages[$i][0]).'" alt="'.strip_filename($pages[$i][0]).'">
    </a>
  </div>
  <div class="storyline-header"
    <a href="'.($pages[$i][0]).'">'.strip_filename($chapters($i)).'</a><hr>
  </div>
</div>';
}

$content_for["content"] = $content;
?>

<?= render_layout("main", $content_for);?>

