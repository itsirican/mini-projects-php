<?php

  namespace Client;

  use PDO;
  use App\Admin\User as AdminUser;

  class User {
    public function __construct() {
      // $pdo = new PDO();
      $adminUser = new AdminUser();
    }
  }