<h3>Category List</h3>

<div class="search-form">
    <form method="GET" action="?page=categories">
        <input type="hidden" name="page" value="categories">
        <input type="text" name="search" placeholder="Search by category name" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
        <button type="submit">Search</button>
        <a href="?page=categories" class="button">Show All</a>
    </form>
</div>

<a href="?page=category_form" class="button">Add New Category</a>

<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Description</th>
        <th>Actions</th>
    </tr>
    <?php 
    $categories = isset($_GET['search']) ? $category->searchCategories($_GET['search']) : $category->getAllCategories();
    if (count($categories) > 0):
        foreach ($categories as $c): 
    ?>
    <tr>
        <td><?= $c['id'] ?></td>
        <td><?= htmlspecialchars($c['name']) ?></td>
        <td><?= htmlspecialchars($c['description']) ?></td>
        <td>
            <a href="?page=category_form&id=<?= $c['id'] ?>" class="button button-edit">Edit</a>
            <a href="?page=categories&delete=<?= $c['id'] ?>" class="button button-delete" onclick="return confirm('Are you sure you want to delete this category?')">Delete</a>
        </td>
    </tr>
    <?php 
        endforeach; 
    else: 
    ?>
    <tr>
        <td colspan="4">No categories found</td>
    </tr>
    <?php endif; ?>
</table>