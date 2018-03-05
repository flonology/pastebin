<?php
  use Pastebin\UrlBuilder;
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Pastebin">
  <title>Pastebin</title>

  <link rel="stylesheet" href="style.css?201705251846">
</head>
<body>
<div class="header">
  <h1><a href="<?php View::put(UrlBuilder::url('add')); ?>">Pastebin</a></h1>
</div>

<div class="content">
  <?php
    if ($app->action() == 'password') include 'password.html.php';
    elseif ($app->action() == 'show') include 'show.html.php';
    elseif ($app->action() == 'list') include 'list.html.php';
    else include 'add.html.php';
  ?>
</div>

</body>
</html>
