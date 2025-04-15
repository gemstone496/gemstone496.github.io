<head>
  <title><?= $render_args["type"] ?? "Daughter of the Blaze" ?></title>
  <link rel='icon' type='image/x-icon' href='<?= find_asset("images") ?>favicon.ico'>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?= import_stylesheets($render_args["special_assets"] ?? []) ?>
  <?= import_scripts($render_args["special_assets"] ?? []) ?>
</head>