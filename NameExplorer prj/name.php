<?php
  require __DIR__."/inc/all.inc.php";
  $name = (string) ($_GET['name'] ?? '');
  if (empty($name)) {
    header("Location: index.php");
    die();
  }
  $entries = fetch_name_entries($name);
?>
<?php require __DIR__."/views/header.php"; ?>
  <?php if(empty($entries)): ?>
    <p>We could not find any entries in our system :/</p>
    <?php else: ?>
      <table>
        <h1>Statistics for the name: <?php echo e($name); ?></h1>
        <thead>
          <tr>
            <th>Year</th>
            <th>Number of babies born</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($entries AS $entry): ?>
            <tr>
              <td><?php echo e($entry['year']); ?></td>
              <td><?php echo e($entry['count']); ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
  <?php endif; ?>    
<?php require __DIR__."/views/footer.php"; ?>

