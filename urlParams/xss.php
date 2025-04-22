<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>XSS</title>
</head>
<body>
  <pre>
    <?php 
      // var_dump($_POST);
      function e($value) {
        return htmlspecialchars($value, ENT_QUOTES, "UTF-8");
      }
      ?>
  </pre>
  <h1><?php if(!empty($_POST["username"])) echo e($_POST["username"]); ?></h1>
  <form action="xss.php" method="POST">
    <input type="text" name="username" value="<?php if(!empty($_POST["username"])) echo e($_POST["username"]); ?>">
    <input type="submit" value="Submit">
  </form>
  <h1><?php if(!empty($_GET["book"])) echo $_GET["book"]; ?></h1>
</body>
</html>