<footer>
  <?= $render_args["dark_button"] ? "<button id='dark-button' class='button' onclick='darkToggle()'>Light Mode</button>" : ""; ?>
  <hr>
  <?php if ($render_args["time"] != null) { ?>
    <div>
      <?= ($render_args["type"] ?? "Technical") . $render_args["time"]." hrs"; ?>
    </div><hr>
  <?php } ?>
  <h3><a href=<?= $render_args["home"] ?? "../start_page.html.php"; ?>>← Go back</a></h3>
</footer>