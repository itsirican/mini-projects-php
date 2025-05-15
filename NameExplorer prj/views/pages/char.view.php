<ul>
  <?php foreach($names AS $name): ?>
    <li>
      <a href="char.php?<?php echo http_build_query(["name" => $name]) ?>">
        <?php echo e($name) ?>
      </a>
    </li>
  <?php endforeach; ?>
</ul>