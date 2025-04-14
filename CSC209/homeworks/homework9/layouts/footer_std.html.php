<footer>
  <?= $render_args["dark_button"] ? "<button id='dark-button' class='button' onclick='darkToggle()'>Light Mode</button>" : ""; ?>
  <hr>
  <div>
    <?= $render_args["type"] ?? "Technical"; ?>: 
      <?= ($render_args["time"] != null) ? ($render_args["time"]. " hrs") : "N/A"; ?> 
  </div>
  <hr>
  <h3><a href=<?= $render_args["home"] ?? "../start_page.html.php"; ?>>← Go back</a></h3>
</footer>