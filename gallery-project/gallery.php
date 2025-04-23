<?php
include './inc/functions.inc.php';
include './inc/images.inc.php';

?>
<?php include './views/header.php'; ?>

<?php foreach($imageTitles as $src => $title):?>
  <a href="image.php?<?=http_build_query(["image" => $src])?>">
    <h3><?=e($title);?></h3>
    <img src="./images/<?php echo rawurlencode($src) ?>" alt="<?=e($title);?>">
  </a>
<?php endforeach; ?>

<?php include './views/footer.php'; ?>
