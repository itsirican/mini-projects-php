<?php

  namespace App\Weather;

  class WeatherInfo {
    public function __construct(
      public string $city,
      public int $temperatureK,
      public string $weatherType
    ) {
      $this->city = $city;
      $this->temperatureK = $temperatureK;
      $this->weatherType = $weatherType;
    }
  }