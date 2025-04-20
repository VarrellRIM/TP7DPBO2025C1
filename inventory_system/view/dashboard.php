<?php
// Get counts for dashboard
$productCount = count($product->getAllProducts());
$categoryCount = count($category->getAllCategories());
$supplierCount = count($supplier->getAllSuppliers());

// Get low stock products (less than 10 items)
$lowStockCount = $product->getLowStockCount(10);
?>

<h3>Dashboard</h3>

<div class="dashboard">
    <div class="card">
        <h3>Total Products</h3>
        <p><?= $productCount ?></p>
    </div>
    
    <div class="card">
        <h3>Total Categories</h3>
        <p><?= $categoryCount ?></p>
    </div>
    
    <div class="card">
        <h3>Total Suppliers</h3>
        <p><?= $supplierCount ?></p>
    </div>
    
    <div class="card">
        <h3>Low Stock Items</h3>
        <p><?= $lowStockCount ?></p>
    </div>
</div>

<h3>Quick Links</h3>
<div>
    <a href="?page=product_form" class="button">Add New Product</a>
    <a href="?page=category_form" class="button">Add New Category</a>
    <a href="?page=supplier_form" class="button">Add New Supplier</a>
</div>
