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
  <header>
    <nav class="menu">
      <a class="nav" href="<?=find_asset("comic/comic.html.php")?>">HOME</a>
      <a class="nav" href="<?=find_asset("about.html.php")?>">ABOUT</a></button>
      <a class="nav" href="<?=find_asset("comic/archive.html.php")?>">ARCHIVE</a>
    </nav>
  </header>
  <div id="content">
    <?= $content_for["content"] ?? "" ?>
  </div>
  <footer>
    <nav class="menu">
      <a class="nav" href="<?=find_asset("comic/comic.html.php")?>">HOME</a>
      <a class="nav" href="<?=find_asset("about.html.php")?>">ABOUT</a></button>
      <a class="nav" href="<?=find_asset("comic/archive.html.php")?>">ARCHIVE</a>
    </nav>
    <div>&copy;Jade Lilian Palosky 2025</div>
  </footer>
</body>
</html>