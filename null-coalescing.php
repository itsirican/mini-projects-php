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
      $name = @(string)($_GET["name"] ?? "unkown");
      var_dump($name);
    ?>
    <a href="null-coalescing.php?<?php echo http_build_query(["name" => ["abdel", "naciri"]]) ?>">Link</a>
  </pre>
</body>
</html>