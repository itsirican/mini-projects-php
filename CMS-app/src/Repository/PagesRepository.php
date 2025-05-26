<?php

  namespace App\Repository;

  use App\Model\PageModel;
  use PDO;

  class PagesRepository {
    public function __construct(private PDO $pdo) {}

    public function fetchForNavigation() {
      $stmt = $this->pdo->prepare('SELECT * FROM `pages` ORDER BY `id` ASC');
      $stmt->execute();
      $entries = $stmt->fetchAll(PDO::FETCH_CLASS, PageModel::class);
      return $entries;
    }
    
    public function fetchBySlug($slug): ?PageModel {
      $stmt =$this->pdo->prepare('SELECT * FROM `pages` WHERE `slug` = :slug');
      $stmt->bindValue(":slug", $slug);
      $stmt->execute();
      $stmt->setFetchMode(PDO::FETCH_CLASS, PageModel::class);
      $entry = $stmt->fetch();
      if (!empty($entry)) {
        return $entry;
      } else {
        return null;
      }
    }

  }