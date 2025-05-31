<h1>Admin:Manage Pages</h1>
<table style="min-width: 100%;">
  <thead>
    <tr>
      <th>ID</th>
      <th>Title</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($pages as $page): ?>
      <tr>
        <td><?php echo e($page->id); ?></td>
        <td><?php echo e($page->title); ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<a href="index.php?route=admin/pages/create">Create page</a>