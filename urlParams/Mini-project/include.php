<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="./simple.css" />
  <title>Document</title>
</head>
<body>
  <?php
  function e($value) {
      return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
  }
  $pages = [
    "citrus_salmon.html" => "Citrus Salmon",
    "mediterranian_pasta.html" => "Mediterranian Pasta",
    "sunset_risotto.html" => "Sunset Risotto",
    "tropical_tacos.html" => "Tropical Tango Tacos"
  ];
  ?>
  <pre>
    <?php
      var_dump($_GET);
    ?>
  </pre>
  <form action="include.php" method="GET">
    <select name="page">
      <option value="">Select a page</option>
      <?php foreach($pages as $key => $value): ?>
        <option value="<?php echo e($key) ?>" <?php if(!empty($_GET["page"]) && $_GET["page"] === e($key)) echo "selected" ?>><?php echo e($value) ?></option>
        <?php endforeach; ?>
      
      <!-- <option value="mediterranian_pasta.php">mediterranian_pasta</option> -->
    </select>
    <input type="submit" value="Submit">
  </form>
  <?php 
    if (!empty($_GET["page"])) {
      $page = $_GET["page"];
      if (!empty($pages[$page])) {
        echo file_get_contents("./pages/".$_GET["page"]);
      }
    }
  ?>
</body>
</html>
