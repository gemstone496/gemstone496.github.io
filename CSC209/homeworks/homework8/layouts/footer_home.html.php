<footer><hr>
  <div>
    <h4>References</h4>
    <ul>
      <li><strong>W3Schools:</strong> <a href="https://www.w3schools.com/html/default.asp">https://www.w3schools.com/html/default.asp</a></li>
      <?php if ($REFS != null) { 
        foreach ($REFS as $ref) { ?>
          <li><a href=<?=$ref?>><?=$ref?></a></li>
      <?php } 
      } ?>
    </ul>
    <hr><h4>Times</h4>
    <ul>
      <li>Tutorials: <?= $TUTTIME != null ? ("".$TUTTIME." hrs") : "N/A"; ?> </li>
      <li>Technical: <?= $TECHTIME != null ? ("".$TECHTIME." hrs") : "N/A"; ?> </li>
      <li>Creative: <?= $CRTIME != null ? ("".$CRTIME." hrs") : "N/A"; ?> </li>
    </ul>
  </div>

  <hr>
  <h3><a href=<?= $HOME_LINK ?? "../../start_page.html"; ?>>← Return to home</a></h3>
</footer>