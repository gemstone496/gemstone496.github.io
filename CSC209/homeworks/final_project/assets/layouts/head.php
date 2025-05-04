<!DOCTYPE html>
<html>
<head>
  <title>wildfire</title>
  <link rel='icon' type='image/x-icon' href='<?= find_asset("images") ?>favicon.ico'>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?= import_stylesheets($content["assets"] ?? []) ?>
  <?= import_scripts($content["assets"] ?? []) ?>
</head>
<body <?= array_search("tracer", $content["assets"] ?? []) ? 'onload="tracerLoad()"' : "" ?>>
  <?= $content["content"] ?? "" ?>
</body>
</html>