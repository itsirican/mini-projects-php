<?php
  function e($value) {
    return htmlspecialchars($value, ENT_QUOTES, "UTF-8");
  }
  $pdo = new PDO("mysql:host=localhost;dbname=back_end", "root", "",
[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
  // echo "Connection successfully \n";
  // var_dump($pdo);
  // $stmt = $pdo->prepare('SELECT `email`, `password` FROM `users` WHERE id = 20 ORDER BY `email` ASC');
  // $stmt->execute();
  // $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
  // var_dump($users);

  $stmt = $pdo->prepare('SELECT * FROM users WHERE id = :id');
  $stmt->bindValue('id', (int) $_GET["id"]);
  $stmt->execute();
  $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
  var_dump($users);
?>
  <ul>
    <?php foreach($users as $user): ?>
      <li><?php echo e($user["email"]) ?></li>
    <?php endforeach; ?>
  </ul>


  