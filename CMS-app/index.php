<?php

require __DIR__ . '/inc/all.inc.php';


// var_dump($page);

$route = @(string) ($_GET['route'] ?? 'pages');

if ($route === 'pages') {
  $page = @(string) ($_GET['page'] ?? 'index');
  // echo 'hello from index page <br />';
  $pagesRepository = new App\Repository\PagesRepository($pdo);
  // $res = $pagesRepository->fetchBySlug('index');
  // var_dump($res);

  $pagesController = new App\Frontend\Controller\PagesController($pagesRepository);
  $pagesController->showPage($page);
} else {
  $pagesRepository = new App\Repository\PagesRepository($pdo);
  $notFoundController = new App\Frontend\Controller\NotFoundController($pagesRepository);
  $notFoundController->error404();
}