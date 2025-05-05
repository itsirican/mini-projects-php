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

  $title = "note title 1 - updated";
  $stmt = $pdo->prepare('UPDATE `notes` SET `title` = :title WHERE `id` = :id');
  $stmt->bindValue("id", 1);
  $stmt->bindValue("title", $title);
  $stmt->execute();

  $stmt2 = $pdo->prepare('DELETE FROM `notes` WHERE `id` = :id');
  $stmt2->bindValue("id", 4);
  $stmt2->execute();
  echo "Note 2 deleted successfully";