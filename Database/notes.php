<?php
  $pdo = new PDO("mysql:host=localhost;dbname=note_app", "root", "", [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
  ]);
  /* $title = "note 4";
  $content = "note 4 content";
  $stmt = $pdo->prepare('INSERT INTO notes (`title`, `content`) values (:title, :content)');
  $stmt->bindValue("title", $title);
  $stmt->bindValue("content", $content);
  $stmt->execute();
  echo "$title added successfuly!"; */

  