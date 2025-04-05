<?php 
  $TYPE = "This Tutorial";
  $TIME = "<1";
  $HOME_LINK = "tutorial.html.php";
?>
<html>
<body>

<?php
   // variable $user is the value of $_GET['user']
   // and 'anonymous' if it does not exist
   $user = $_GET["user"] ?? "anonymous";

   // variable $color is "red" if $color does not exist or is null
   $color = $color ?? "red";
?>

<?= $user ?><br><?= $color ?>

<?php include "../layouts/footer_std.html.php";?>

</body>
</html>
