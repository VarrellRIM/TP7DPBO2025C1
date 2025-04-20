<h3>Product List</h3>

<div class="search-form">
    <form method="GET" action="?page=products">
        <input type="hidden" name="page" value="products">
        <input type="text" name="search" placeholder="Search products" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
        <button type="submit">Search</button>
        <a href="?page=products" class="button">Show All</a>
    </form>
</div>

<a href="?page=product_form" class="button">Add New Product</a>

<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Description</th>
        <th>Price</th>
        <th>Stock</th>
        <th>Category</th>
        <th>Supplier</th>
        <th>Actions</th>
    </tr>
    <?php 
    $products = isset($_GET['search']) ? $product->searchProducts($_GET['search']) : $product->getAllProducts();
    if (count($products) > 0):
        foreach ($products as $p): 
    ?>
    <tr>
        <td><?= $p['id'] ?></td>
        <td><?= htmlspecialchars($p['name']) ?></td>
        <td><?= htmlspecialchars($p['description']) ?></td>
        <td>$<?= number_format($p['price'], 2) ?></td>
        <td><?= $p['stock'] ?></td>
        <td><?= htmlspecialchars($p['category_name'] ?? 'None') ?></td>
        <td><?= htmlspecialchars($p['supplier_name'] ?? 'None') ?></td>
        <td>
            <a href="?page=product_form&id=<?= $p['id'] ?>" class="button button-edit">Edit</a>
            <a href="?page=products&delete=<?= $p['id'] ?>" class="button button-delete" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
        </td>
    </tr>
    <?php 
        endforeach; 
    else: 
    ?>
    <tr>
        <td colspan="8">No products found</td>
    </tr>
    <?php endif; ?>
</table>
