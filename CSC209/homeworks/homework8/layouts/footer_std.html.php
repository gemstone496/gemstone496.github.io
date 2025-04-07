<footer>
  <?= $DARK_BUTTON ? "<button id='dark-button' class='button' onclick='darkToggle()'>Light Mode</button>" : ""; ?>
  <hr>
  <div><?= $TYPE ?? "Technical"; ?>: <?= ($TIME != null) ? ($TIME . " hrs") : "N/A"; ?> </div>
  <hr>
  <h3><a href=<?= $HOME_LINK ?? "../start_page.html.php"; ?>>← Go back</a></h3>
</footer>