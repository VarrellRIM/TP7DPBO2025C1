<?php
$id = isset($_GET['id']) ? $_GET['id'] : null;
$categoryData = $id ? $category->getCategoryById($id) : null;
$title = $id ? 'Edit Category' : 'Add New Category';
?>

<h3><?= $title ?></h3>

<form method="POST" action="?page=categories">
    <?php if ($id): ?>
        <input type="hidden" name="id" value="<?= $id ?>">
    <?php endif; ?>
    
    <div>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?= $categoryData ? htmlspecialchars($categoryData['name']) : '' ?>" required>
    </div>
    
    <div>
        <label for="description">Description:</label>
        <textarea id="description" name="description"><?= $categoryData ? htmlspecialchars($categoryData['description']) : '' ?></textarea>
    </div>
    
    <button type="submit" name="<?= $id ? 'update_category' : 'add_category' ?>"><?= $id ? 'Update' : 'Add' ?> Category</button>
    <a href="?page=categories" class="button">Cancel</a>
</form>