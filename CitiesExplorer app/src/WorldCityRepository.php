<?php
  declare(strict_types=1);
  class WorldCityRepository {
    public function __construct(private PDO $pdo){}

    private function arrayToModel(array $entry): WorldCityModel {
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
    }

    public function fetchById(int $id): ?WorldCityModel {
      $stmt = $this->pdo->prepare('SELECT * FROM `worldcities` WHERE `id` = :id');
      $stmt->bindValue(":id", $id);
      $stmt->execute();
      $entry = $stmt->fetch(PDO::FETCH_ASSOC);
      if (!empty($entry)) {
        return $this->arrayToModel($entry);
      } else {
        return null;
      }
    }

    public function paginate(int $page, int $perPage = 15): array {
      // Page 0 or negative pages don't exist => showing page 1 then 
      $page = max(1, $page);

      $stmt = $this->pdo->prepare('SELECT *
      -- `id`, `city`, `lat`, `lng`, `country`, `iso2`, `iso3`, `capital`, `population`
      FROM `worldcities` ORDER BY `population` DESC LIMIT :limit OFFSET :offset');
      $stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
      $stmt->bindValue(':offset', ($page - 1) * $perPage, PDO::PARAM_INT);
      $stmt->execute();

      $models = [];
      $entries = $stmt->fetchAll(PDO::FETCH_ASSOC);
      foreach($entries as $entry) {
        $models[] = $this->arrayToModel($entry);
      }
      // var_dump($entries);

      return $models;
    }

    public function count() : int {
      $stmt = $this->pdo->prepare('SELECT COUNT(*) AS `count` FROM `worldcities`');
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      return $result['count'];
    }

    public function update(int $id, array $properties) {
      $stmt = $this->pdo->prepare('UPDATE `worldcities` SET `city` = :city, `city_ascii` = :cityAscii, `country` = :country, `iso2` = :iso2, `population` = :population WHERE `id` = :id');
      $stmt->bindValue(':id', $id);
      $stmt->bindValue(':city', $properties['city']);
      $stmt->bindValue(':cityAscii', $properties['cityAscii']);
      $stmt->bindValue(':country', $properties['country']);
      $stmt->bindValue(':iso2', $properties['iso2']);
      $stmt->bindValue(':population', $properties['population']);
      $stmt->execute();
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