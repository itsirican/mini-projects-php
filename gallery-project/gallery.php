<?php
include './inc/functions.inc.php';
include './inc/images.inc.php';

?>
<?php include './views/header.php'; ?>

<?php foreach($imageTitles as $url => $title):?>
  <a href="image.php?<?=http_build_query(["url" => $url])?>">
    <h1><?=$title?></h1>
    <img src="./images/<?php echo rawurlencode($url) ?>" alt="<?=$title?>">
  </a>
<?php endforeach; ?>

<?php include './views/footer.php'; ?>
