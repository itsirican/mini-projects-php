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
    <h1>
      <?php echo e($cityInformation["city"]) ?>
      <?php echo e($cityInformation["flag"]) ?>
    </h1>
    <?php if (!empty($stats)): ?>
      <canvas id="aqi-chart" style="width: 300px; height: 200px;"></canvas>
      <script src="scripts/chart.umd.js"></script>
        <?php 
          $labels = array_keys($stats);
          sort($labels);
          $pm25 = [];
          $pm10 = [];
          foreach ($labels as $label) {
            $mesuremenets = $stats[$label];
            if (count($mesuremenets["pm25"]) !== 0) {
              $pm25[] = array_sum($mesuremenets["pm25"]) / count($mesuremenets["pm25"]);
            } else {
              $pm25[] = 0;
            }
            if (count($mesuremenets["pm10"]) !== 0) {
              $pm10[] = array_sum($mesuremenets["pm10"]) / count($mesuremenets["pm10"]);
            } else {
              $pm10[] = 0;
            }
          }
          $datasets = [];
          if (array_sum($pm25)) {
            $datasets[] = [
              'label' => "AQI, PM2.5 in {$units['pm25']}",
                  'data'=> $pm25,
                  'fill'=> false,
                  'borderColor'=> 'rgb(75, 192, 192)',
                  'tension'=> 0.1
            ];
          }
          if (array_sum($pm10)) {
            $datasets[] = [
              'label' => "AQI, PM10 in {$units['pm10']}",
                  'data'=> $pm10,
                  'fill'=> false,
                  'borderColor'=> 'rgb(255, 75, 192)',
                  'tension'=> 0.1
            ];
          }
          // var_dump($pm25);
          // die();
        ?>
      <script>
        const ctx = document.getElementById("aqi-chart");
        const chart = new Chart(ctx, {
          type: 'line',
          data: {
            labels: <?php echo json_encode($labels); ?>,
            datasets: <?php echo json_encode($datasets); ?>
          }
        });
      </script>
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
                  <?php if(count($mesuremenets["pm25"]) !== 0): ?>
                    <?php echo e(round(array_sum($mesuremenets["pm25"]) / count($mesuremenets["pm25"]), 2)) ?>
                    <?php echo e($units["pm25"]) ?>
                    <?php else: ?>
                      <i>No data available</i>
                  <?php endif; ?>
                </td>
                <td>
                  <?php if(count($mesuremenets["pm10"]) !== 0): ?>
                    <?php echo e(round(array_sum($mesuremenets["pm10"]) / count($mesuremenets["pm10"]), 2)) ?>
                    <?php echo e($units["pm10"]) ?>
                    <?php else: ?>
                      <i>No data available</i>
                  <?php endif; ?>
                </td>
              </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php endif; ?>
<?php endif; ?>

<?php require_once __DIR__."/views/footer.inc.php" ?>
