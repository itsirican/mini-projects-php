<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Post</title>
</head>
<body>
  <pre>
    <?php 
      var_dump($_POST);
    ?>
  </pre>

  <form action="post.php" method="POST">
    <input type="text" name="username" placeholder="username" value="<?php if(!empty($_POST["username"])) echo $_POST["username"]?>">
    <input type="password" name="password" placeholder="password">
    <input type="submit" value="Submit">
  </form>
</body>
</html>