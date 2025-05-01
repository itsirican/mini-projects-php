<?php 
  require_once __DIR__."/inc/functions.inc.php";
  $city = null;
  $filename = null;
  if (!empty($_GET["city"])) {
    $city = $_GET["city"];
  }
  // var_dump($city);
  
  if (!empty($city)) {
    $cities = json_decode(file_get_contents(__DIR__."/../data/index.json"), true);
    foreach($cities as $currentCity) {
      if ($currentCity["city"] === $city) {
        $filename = $currentCity["filename"];
        break;
      }
    }
  }
  if (!empty($filename)) {
    // var_dump($filename);
    $results = json_decode(file_get_contents("compress.bzip2://".__DIR__."/../data/".$filename), true)["results"];
      // var_dump($results[0]);
      $stats = [];
      foreach($results as $result) {
        if($result["parameter"] !== "pm25") continue;
        // var_dump($result);
        $month = substr($result["date"]["local"], 0, 7);
        if (!isset($stats[$month])) {
          $stats[$month] = [];
        }
        $stats[$month][] = $result["value"];
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
      <table>
        <?php foreach($stats as $month => $mesuremenets): ?>
          <table>
            <tr>
              <th><?php echo $month ?></th>
              <td><?php echo array_sum($mesuremenets) / count($mesuremenets) ?></td>
            </tr>
          </table>
        <?php endforeach; ?>
      </table>
    <?php endif; ?>
<?php endif; ?>

<?php require_once __DIR__."/views/footer.inc.php" ?>
