<h1>Create new page</h1>

<?php if (!empty($errors)): ?>
  <ul>
    <?php foreach($errors AS $error): ?>
      <li><?php echo e($error); ?></li>
    <?php endforeach; ?>
  </ul>
<?php endif; ?>

<form method="POST" action="index.php?route=admin/pages/create">
  <input type="text" name="_csrf" value="<?php echo e(csrf_token()); ?>">
  <label for="title">Title:</label>
  <input type="text" id="title" name="title" 
    value="<?php if (!empty($_POST['title'])) echo e($_POST['title']); ?>">
  <label for="slug">Slug:</label>
  <input type="text" id="slug" name="slug" 
    value="<?php if (!empty($_POST['slug'])) echo e($_POST['slug']);  ?>">
  <label for="content">Content:</label>
  <textarea id="content" name="content"><?php if(!empty($_POST['content'])) echo e($_POST['content']); ?></textarea>
  <input type="submit" value="Submit!">
</form>