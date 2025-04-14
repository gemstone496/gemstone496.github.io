<footer>
  <?= $render_args["dark_button"] ? "<button id='dark-button' class='button' onclick='darkToggle()'>Light Mode</button>" : ""; ?>
  <hr>
  <div>
    <h4>References</h4>
    <ul>
      <li><strong>W3Schools:</strong> <a href="https://www.w3schools.com/html/default.asp">https://www.w3schools.com/html/default.asp</a></li>
      <?php if ($render_args["refs"] !== null) { 
        foreach ($render_args["refs"] as $refname => $ref) { ?>
          <li><strong><?= $refname ?>: </strong><a href=<?=$ref?>><?=$ref?></a></li>
      <?php } 
      } ?>
    </ul>
    <hr><h4>Times</h4>
    <ul>
      <li>Tutorials: <?= $render_args["tut_time"] != null ? ("".$render_args["tut_time"]." hrs") : "N/A"; ?> </li>
      <li>Technical: <?= $render_args["tech_time"] != null ? ("".$render_args["tech_time"]." hrs") : "N/A"; ?> </li>
      <li>Creative: <?= $render_args["cr_time"] != null ? ("".$render_args["cr_time"]." hrs") : "N/A"; ?> </li>
    </ul>
  </div>

  <hr>
  <h3><a href=<?= $render_args["home"] ?? "../../start_page.html"; ?>>← Return to home</a></h3>
</footer>