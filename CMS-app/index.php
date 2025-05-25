<?php

require __DIR__ . '/inc/all.inc.php';

$page = @(string) ($_GET['page'] ?? 'index');

// var_dump($page);

if ($page === 'index') {
  echo 'hello from index page <br />';
} else {
  $notFoundController = new App\Frontend\Controller\NotFoundController();
  $notFoundController->error404();
}