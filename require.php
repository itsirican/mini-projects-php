<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <pre>
    <?php
      // require_once(__DIR__."/inc/all.inc.php");
      // require_once(__DIR__."/inc/functions.inc.php");
      file_get_contents(__DIR__."/inc/functions.inc.php");
      $text = 'PHP is amazing';
    ?>
  </pre>
  <!-- <h1>Hello Php</h1> -->
  <!-- <h1><?= e($text)?></h1> -->
</body>
</html>