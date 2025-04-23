<!DOCTYPE html>
<html>
<head>
  <title><?= $content_for["name"] ?? "Wildfire" ?></title>
  <link rel='icon' type='image/x-icon' href='<?= find_asset("images") ?>favicon.ico'>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?= import_stylesheets($content_for["assets"] ?? []) ?>
  <?= import_scripts($content_for["assets"] ?? []) ?>
</head>