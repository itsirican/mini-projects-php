<h1>Admin:Manage Pages</h1>
<table style="min-width: 100%;">
  <thead>
    <tr>
      <th>ID</th>
      <th>Title</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($pages as $page): ?>
      <tr>
        <td><?php echo e($page->id); ?></td>
        <td><?php echo e($page->title); ?></td>
        <td>
          <form action="index.php?<?php echo http_build_query(['route' => 'admin/pages/delete', 'id' => $page->id]) ?>" method="POST">
            <input type="hidden" name="id" value="<?php echo e($page->id); ?>">
            <input type="submit" value="Delete!">
          </form>
          <?php /*
            <a href="index.php?<?php echo http_build_query(['route' => 'admin/pages/delete', 'id' => $page->id]) ?>">
              Delete
            </a>
          */
          ?>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<a href="index.php?route=admin/pages/create">Create page</a>