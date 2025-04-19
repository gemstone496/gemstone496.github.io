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
    <nav class="nav-bar">
      <button class="nav">HOME</button>
      <button class="nav">ABOUT</button>
      <button class="nav">ARCHIVE</button>
      <button class="nav">CAST</button>
    </nav>
  </header>
  <div id="content">
    <?= $content_for["content"] ?? "" ?>
  </div>
  <footer>
    <article>
      <nav class="nav-bar">
        <button class="nav">HOME</button>
        <button class="nav">ABOUT</button>
        <button class="nav">ARCHIVE</button>
        <button class="nav">CAST</button>
      </nav>
      <div>&copy;Jade Lilian Palosky 2025</div>
    </article>
  </footer>
</body>
</html>