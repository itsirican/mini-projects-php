<?php

  use App\Weather\FakeWeatherFetcher;
  use App\Weather\RandomWeatherFetcher;

  require __DIR__."/inc/all.inc.php";

  // $fetcher = new FakeWeatherFetcher();
  $fetcher = new RandomWeatherFetcher();
  $info = $fetcher->fetch('New York');

  // var_dump($info);

  require __DIR__."/views/view.index.php";