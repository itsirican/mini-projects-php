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
      var_dump($results[0]);
    
  }
?>

<?php require_once __DIR__."/views/header.inc.php" ?>

<?php if(empty($city)): ?>
  <p>The city could not be loaded.</p>
  <?php else: ?>
    
<?php endif; ?>

<?php require_once __DIR__."/views/footer.inc.php" ?>
