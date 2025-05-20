<?php

require __DIR__ . '/inc/all.inc.php';

// $budapest = new WorldCityMode();
// $budapest->city = 'Budapest';
// $budapest->country = 'Hungary';
// $budapest->population = 1200000;

// $berlin = new WorldCityMode();
// $berlin->city = 'Berlin';
// $berlin->country = 'Germany';
// $berlin->population = 2000000;

// $nyc = new WorldCityMode();
// $nyc->city = 'New York City';
// $nyc->country = 'USA';
// $nyc->population = 8000000;

// $entries = [
//   $budapest,
//   $berlin,
//   $nyc
// ];


$worldCityRepository = new WorldCityRepository($pdo);
$entries = $worldCityRepository->fetch();

render('index.view', [
  'entries' => $entries,
]);