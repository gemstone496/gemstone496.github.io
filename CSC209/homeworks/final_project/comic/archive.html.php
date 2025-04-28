<?php
include_once "../assets/php/helpers.php";
include_once "../assets/php/comic.php";

$content_for["assets"] = ["archive"];

$chapters = glob(find_asset("images/pages")."*");
$pages = fetch_files($chapters);

# deal with the fucked up indentation it's for formatting raw html
$content_for["content"] = '
<h2>Latest Page</h2>
<p>Check out the latest page <a href="./pages.html.php">here</a>!</p>
<h2>Archive</h2>
<p><label for=archive-select>Select a page from the dropdown to start reading.</label></p>
<select id="archive-select" class="mb-3" onchange="setPage(this.value)">
  <option value="">Select page...</option>';

for ($i = 0; $i < count($pages); $i++) {
  for ($j = 0; $j < count($pages[$i]); $j++) {
    $content_for["content"] .= ' 
  <option value="'.$i.'_'.$j.'">'.$i.'.'.($j+1).' '.strip_filename($pages[$i][$j]).'</option>';
  }
}

$content_for["content"] .= '
</select>
<h2>Chapters</h2><hr>
<div class="lr-pad marks">';

for ($i = 0; $i < count($pages); $i++) {
  $content_for["content"] .= '
  <div class="storyline-mark row">
    <div class="storyline-thumbnail">
      <a href="./pages.html.php?ch='.$i.'&pg=0">
        <img src="'.($pages[$i][0]).'" alt="'.strip_filename($pages[$i][0]).'">
      </a>
    </div>
    <div class="storyline-header">
      <a href="./pages.html.php?ch='.$i.'&pg=0">'.strip_filename($chapters[$i]).'</a>
    </div>
  </div>';
}

$content_for['content'] .= '
</div>';

?>

<?= render_layout("main", $content_for);?>

