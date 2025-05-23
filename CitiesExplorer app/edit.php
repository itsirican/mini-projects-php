<?php

require __DIR__ . '/inc/all.inc.php';

$id = (int)($_GET['id'] ?? 0);

$worldCityRepository = new WorldCityRepository($pdo);
$model = $worldCityRepository->fetchById($id);

if (empty($model)) {
  header('location: index.php');
  die();
}

if (!empty($_POST)) {
  $city = (string) ($_POST['city'] ?? '');
  $cityAscii = (string) ($_POST['cityAscii'] ?? '');
  $country = (string) ($_POST['country'] ?? '');
  $iso2 = (string) ($_POST['iso2'] ?? '');
  $population = (int)($_POST['population'] ?? 0);

  if (empty($city) || empty($cityAscii) || empty($country) || empty($iso2) || empty($population)) {
    header('location: index.php');
    die();
  }

  $worldCityRepository->update($id, [
    'city' => $city,
    'cityAscii' => $cityAscii,
    'country' => $country,
    'iso2' => $iso2,
    'population' => $population
  ]);
}

// var_dump($_POST);

render('edit.view', [
  'city' => $model,
]);