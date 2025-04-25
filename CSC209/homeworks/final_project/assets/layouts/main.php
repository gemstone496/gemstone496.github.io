<?php 
session_start();
$user = $_SESSION["user"] ?? "";
?>
<!DOCTYPE html>
<html>
<head>
  <title><?= $content_for["name"] ?? "Wildfire" ?></title>
  <link rel='icon' type='image/x-icon' href='<?= find_asset("images") ?>favicon.ico'>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?= import_stylesheets($content_for["assets"] ?? []) ?>
  <?= import_scripts($content_for["assets"] ?? []) ?>
</head>
<body>
  <header class="vflex-center">
    <h1 class="logo">wildfire</h1>
    <nav class="menu">
      <a class="nav hidden" onclick="openMenu(this)">MENU</a>
      <a class="nav responsive" href="<?=find_asset("comic/pages.html.php")?>">HOME</a>
      <a class="nav responsive" href="<?=find_asset("about.html.php")?>">ABOUT</a>
      <a class="nav responsive" href="<?=find_asset("comic/archive.html.php")?>">ARCHIVE</a>
      <div class="hz-spacer"></div><a class="responsive" href="<?=find_asset($user ? "login/profile.html.php" : "login/login.html.php")?>">
        <img class="pfp" 
          src="<?=$user && fetch_pfp($user) ? '' : find_asset("images/pfp_default.png");?>">
      </a><div class="hz-spacer"></div>
    </nav>
  </header><hr>
  <div id="content">
    <?= $content_for["content"] ?? "" ?>
  </div>
  <hr><footer class="vflex-center">
    <nav class="menu">
      <a class="nav" href="<?=find_asset("comic/pages.html.php")?>">HOME</a>
      <a class="nav" href="<?=find_asset("about.html.php")?>">ABOUT</a>
      <a class="nav" href="<?=find_asset("comic/archive.html.php")?>">ARCHIVE</a>
    </nav>
  </footer>
  <div id="copyright">&copy;2025 Jade Onyx Violet Lilian</div>
</body>
</html>