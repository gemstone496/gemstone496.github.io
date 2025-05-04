<?php
include_once "../assets/php/helpers.php";
include_once "../assets/php/comic.php";

$content_for["assets"] = ["comic"]; # comic pages always have this asset list 

$chapters = glob(find_asset("images/pages").'*');
$pages = fetch_files($chapters);
$ch = $_GET["ch"] ?? count($chapters) -1; // last ch by default
$pg = $_GET["pg"] ?? count($pages[$ch]) -1; // last pg by default
$imgpath = $pages[$ch][$pg];

$page_ctrl = '<div class="tb-pad">
    <a class="turn-page'.($ch == 0 && $pg == 0 ? ' disabled' : '"
      href="./pages.html.php?ch=0&pg=0').'"> |<< </a>
    <a class="turn-page'.($ch == 0 && $pg == 0 ? ' disabled' : '"
      href="./pages.html.php?'.(isset($pages[$ch][$pg-1]) ? 
        'ch='.$ch.'&pg='.($pg-1) : 'ch='.($ch-1))).'">
      <
    </a>
    | <a class="turn-page" href="./archive.html.php">Archive</a> |
    <a class="turn-page'.($ch == count($chapters)-1 && $pg == count($pages[$ch])-1 ? 
                        ' disabled' : '"
      href="./pages.html.php?'.(isset($pages[$ch][$pg+1]) ? 
        'ch='.$ch.'&pg='.($pg+1) : 'ch='.($ch+1).'&pg=0')).'">
      >
    </a>
    <a class="turn-page'.($ch == count($chapters)-1 && $pg == count($pages[$ch])-1 ? 
                        ' disabled' : '"
      href="./pages.html.php?').'"> >>| </a>
  </div>';

$content_for["content"] = '
<div class="col center lr-pad">
  '.$page_ctrl.'
  <div class="row page-img">
    <img id="page-img" src="'.$imgpath.'" alt="'.strip_filename($imgpath).'">
  </div>
  '.$page_ctrl.'
  <div class="page-post">
    '.$content_for["post"].'
  </div>
  <div class="page-comments">
    <h3>Comments</h3>
    '.($content_for["comments"] ?? '<p>Comments coming soon...</p>').'
  </div>
</div>';
?>

<?= render_layout("main", $content_for);?>