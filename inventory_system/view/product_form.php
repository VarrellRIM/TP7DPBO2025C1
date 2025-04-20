<?php
$id = isset($_GET['id']) ? $_GET['id'] : null;
$productData = $id ? $product->getProductById($id) : null;
$title = $id ? 'Edit Product' : 'Add New Product';
?>

<h3><?= $title ?></h3>

<form method="POST" action="?page=products">
    <?php if ($id): ?>
        <input type="hidden" name="id" value="<?= $id ?>">
    <?php endif; ?>
    
    <div>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?= $productData ? htmlspecialchars($productData['name']) : '' ?>" required>
    </div>
    
    <div>
        <label for="description">Description:</label>
        <textarea id="description" name="description"><?= $productData ? htmlspecialchars($productData['description']) : '' ?></textarea>
    </div>
    
    <div>
        <label for="price">Price:</label>
        <input type="number" id="price" name="price" step="0.01" min="0" value="<?= $productData ? $productData['price'] : '' ?>" required>
    </div>
    
    <div>
        <label for="stock">Stock:</label>
        <input type="number" id="stock" name="stock" min="0" value="<?= $productData ? $productData['stock'] : '' ?>" required>
    </div>
    
    <div>
        <label for="category_id">Category:</label>
        <select id="category_id" name="category_id">
            <option value="">-- Select Category --</option>
            <?php foreach ($category->getAllCategories() as $c): ?>
                <option value="<?= $c['id'] ?>" <?= ($productData && $productData['category_id'] == $c['id']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($c['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    
    <div>
        <label for="supplier_id">Supplier:</label>
        <select id="supplier_id" name="supplier_id">
            <option value="">-- Select Supplier --</option>
            <?php foreach ($supplier->getAllSuppliers() as $s): ?>
                <option value="<?= $s['id'] ?>" <?= ($productData && $productData['supplier_id'] == $s['id']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($s['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    
    <button type="submit" name="<?= $id ? 'update_product' : 'add_product' ?>"><?= $id ? 'Update' : 'Add' ?> Product</button>
    <a href="?page=products" class="button">Cancel</a>
</form>