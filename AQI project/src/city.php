<?php 
  require_once __DIR__."/inc/functions.inc.php";
  $city = null;
  $filename = null;
  $cityInformation = [];
  if (!empty($_GET["city"])) {
    $city = $_GET["city"];
  }
  // var_dump($city);
  
  if (!empty($city)) {
    $cities = json_decode(file_get_contents(__DIR__."/../data/index.json"), true);
    foreach($cities as $currentCity) {
      if ($currentCity["city"] === $city) {
        $filename = $currentCity["filename"];
        $cityInformation = $currentCity;
        break;
      }
    }
  }
  if (!empty($filename)) {
    // var_dump($filename);
    $results = json_decode(file_get_contents("compress.bzip2://".__DIR__."/../data/".$filename), true)["results"];
    $units = [
      "pm25" => null,
      "pm10" => null
    ];

    foreach ($results as $result) {
      if (!empty($units["pm25"]) && !empty($units["pm10"])) break;
      if ($result["parameter"] === "pm25") {
        $units["pm25"] = $result["unit"];
      }
      if ($result["parameter"] === "pm10") {
        $units["pm10"] = $result["unit"];
      }
    }

    // var_dump($units);
    // die();

    // var_dump($results[0]);
    $stats = [];
    foreach($results as $result) {
      if($result["parameter"] !== "pm25" && $result["parameter"] !== "pm10") continue;
      if($result["value"] < 0) continue;
      // var_dump($result);
      $month = substr($result["date"]["local"], 0, 7);
      if (!isset($stats[$month])) {
        $stats[$month] = [
          "pm25" => [],
          "pm10" => []
        ];
      }
      $stats[$month][$result["parameter"]][] = $result["value"];
      // var_dump($stats);
      // var_dump($month);
      // break;
    }
    // var_dump($stats);
  }
?>

<?php require_once __DIR__."/views/header.inc.php" ?>

<?php if(empty($city)): ?>
  <p>The city could not be loaded.</p>
  <?php else: ?>
    <?php if (!empty($stats)): ?>
      <h1>
        <?php echo e($cityInformation["city"]) ?>
        <?php echo e($cityInformation["flag"]) ?>
      </h1>
      <table>
        <thead>
          <th>Month</th>
          <th>PM 2.5 concetration</th>
          <th>PM 10 concetration</th>
        </thead>
        <tbody>
          <?php foreach($stats as $month => $mesuremenets): ?>
              <tr>
                <th><?php echo e($month) ?></th>
                <td>
                  <?php echo e(round(array_sum($mesuremenets["pm25"]) / count($mesuremenets["pm25"]), 2)) ?>
                  <?php echo e($units["pm25"]) ?>
                </td>
                <td>
                  <?php echo e(round(array_sum($mesuremenets["pm10"]) / count($mesuremenets["pm10"]), 2)) ?>
                  <?php echo e($units["pm10"]) ?>
                </td>
              </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php endif; ?>
<?php endif; ?>

<?php require_once __DIR__."/views/footer.inc.php" ?>
