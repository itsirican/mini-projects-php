<?php

  use App\Weather\FakeWeatherFetcher;

  require __DIR__."/inc/all.inc.php";

  $fetcher = new FakeWeatherFetcher();
  $info = $fetcher->fetch('New York');

  // var_dump($info);

  require __DIR__."/views/view.index.php";