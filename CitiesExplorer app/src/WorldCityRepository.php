<?php
  declare(strict_types=1);
  class WorldCityRepository {
    public function __construct(private PDO $pdo){}

    public function fetchById(int $id): ?WorldCityModel {
      $stmt = $this->pdo->prepare('SELECT * FROM `worldcities` WHERE `id` = :id');
      $stmt->bindValue(":id", $id);
      $stmt->execute();
      $entry = $stmt->fetch(PDO::FETCH_ASSOC);
      if (!empty($entry)) {
        return new WorldCityModel(
          $entry['id'],
          $entry['city'],
          $entry['city_ascii'],
          (float) $entry['lat'],
          (float) $entry['lng'],
          $entry['country'],
          $entry['iso2'],
          $entry['iso3'],
          $entry['admin_name'],
          $entry['capital'],
          $entry['population']
        );
      } else {
        return null;
      }
    }

    public function fetch(): array {
      $stmt = $this->pdo->prepare('SELECT *
      -- `id`, `city`, `lat`, `lng`, `country`, `iso2`, `iso3`, `capital`, `population`
      FROM `worldcities` ORDER BY `population` DESC LIMIT 10');
      $stmt->execute();

      $models = [];
      $entries = $stmt->fetchAll(PDO::FETCH_ASSOC);
      foreach($entries as $entry) {
        $models[] = new WorldCityModel(
          $entry['id'],
          $entry['city'],
          $entry['city_ascii'],
          (float) $entry['lat'],
          (float) $entry['lng'],
          $entry['country'],
          $entry['iso2'],
          $entry['iso3'],
          $entry['admin_name'],
          $entry['capital'],
          $entry['population']
        );
      }
      // var_dump($entries);

      return $models;
    }

    // public function fetch(): array {
    //   var_dump($this->pdo);
    //   $budapest = new WorldCityMode();
    //   $budapest->city = 'Budapest';
    //   $budapest->country = 'Hungary';
    //   $budapest->population = 1200000;

    //   $berlin = new WorldCityMode();
    //   $berlin->city = 'Berlin';
    //   $berlin->country = 'Germany';
    //   $berlin->population = 2000000;

    //   $nyc = new WorldCityMode();
    //   $nyc->city = 'New York City';
    //   $nyc->country = 'USA';
    //   $nyc->population = 8000000;

    //   $entries = [
    //     $budapest,
    //     $berlin,
    //     $nyc
    //   ];
    //   return $entries;
    // }
  }