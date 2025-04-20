<?php
include_once "./assets/php/helpers.php";

$content_for["content"] = "<br><p>Lorem Ipsum Dolor Sit Amet</p><br>";

?>

<?= render_layout("main", $content_for);?>
