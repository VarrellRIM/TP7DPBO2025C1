<?php
require_once 'class/Product.php';
require_once 'class/Category.php';
require_once 'class/Supplier.php';

session_start();

$product = new Product();
$category = new Category();
$supplier = new Supplier();

// Handle Product CRUD operations
if (isset($_POST['add_product'])) {
    $result = $product->addProduct(
        $_POST['name'], 
        $_POST['description'], 
        $_POST['price'], 
        $_POST['stock'], 
        $_POST['category_id'] ?: null, 
        $_POST['supplier_id'] ?: null
    );
    if ($result) {
        $_SESSION['message'] = "Product added successfully";
    } else {
        $_SESSION['error'] = "Failed to add product";
    }
    header('Location: ?page=products');
    exit;
}

if (isset($_POST['update_product'])) {
    $result = $product->updateProduct(
        $_POST['id'], 
        $_POST['name'], 
        $_POST['description'], 
        $_POST['price'], 
        $_POST['stock'], 
        $_POST['category_id'] ?: null, 
        $_POST['supplier_id'] ?: null
    );
    if ($result) {
        $_SESSION['message'] = "Product updated successfully";
    } else {
        $_SESSION['error'] = "Failed to update product";
    }
    header('Location: ?page=products');
    exit;
}

if (isset($_GET['page']) && $_GET['page'] == 'products' && isset($_GET['delete'])) {
    $result = $product->deleteProduct($_GET['delete']);
    if ($result) {
        $_SESSION['message'] = "Product deleted successfully";
    } else {
        $_SESSION['error'] = "Failed to delete product";
    }
    header('Location: ?page=products');
    exit;
}

// Handle Category CRUD operations
if (isset($_POST['add_category'])) {
    $result = $category->addCategory($_POST['name'], $_POST['description']);
    if ($result) {
        $_SESSION['message'] = "Category added successfully";
    } else {
        $_SESSION['error'] = "Failed to add category";
    }
    header('Location: ?page=categories');
    exit;
}

if (isset($_POST['update_category'])) {
    $result = $category->updateCategory($_POST['id'], $_POST['name'], $_POST['description']);
    if ($result) {
        $_SESSION['message'] = "Category updated successfully";
    } else {
        $_SESSION['error'] = "Failed to update category";
    }
    header('Location: ?page=categories');
    exit;
}

if (isset($_GET['page']) && $_GET['page'] == 'categories' && isset($_GET['delete'])) {
    $result = $category->deleteCategory($_GET['delete']);
    if (!$result) {
        $_SESSION['error'] = "Cannot delete category with associated products";
    } else {
        $_SESSION['message'] = "Category deleted successfully";
    }
    header('Location: ?page=categories');
    exit;
}

// Handle Supplier CRUD operations
if (isset($_POST['add_supplier'])) {
    $result = $supplier->addSupplier(
        $_POST['name'], 
        $_POST['contact_person'], 
        $_POST['email'], 
        $_POST['phone'], 
        $_POST['address']
    );
    if ($result) {
        $_SESSION['message'] = "Supplier added successfully";
    } else {
        $_SESSION['error'] = "Failed to add supplier";
    }
    header('Location: ?page=suppliers');
    exit;
}

if (isset($_POST['update_supplier'])) {
    $result = $supplier->updateSupplier(
        $_POST['id'], 
        $_POST['name'], 
        $_POST['contact_person'], 
        $_POST['email'], 
        $_POST['phone'], 
        $_POST['address']
    );
    if ($result) {
        $_SESSION['message'] = "Supplier updated successfully";
    } else {
        $_SESSION['error'] = "Failed to update supplier";
    }
    header('Location: ?page=suppliers');
    exit;
}

if (isset($_GET['page']) && $_GET['page'] == 'suppliers' && isset($_GET['delete'])) {
    $result = $supplier->deleteSupplier($_GET['delete']);
    if (!$result) {
        $_SESSION['error'] = "Cannot delete supplier with associated products";
    } else {
        $_SESSION['message'] = "Supplier deleted successfully";
    }
    header('Location: ?page=suppliers');
    exit;
}

// Remove duplicate DOCTYPE and HTML head section
include 'view/header.php';
?>

<main>
    <?php
    // Display success/error messages
    if (isset($_SESSION['message'])) {
        echo "<div class='alert alert-success'>" . $_SESSION['message'] . "</div>";
        unset($_SESSION['message']);
    }
    if (isset($_SESSION['error'])) {
        echo "<div class='alert alert-danger'>" . $_SESSION['error'] . "</div>";
        unset($_SESSION['error']);
    }
    ?>

    <nav>
        <a href="?page=dashboard">Dashboard</a> |
        <a href="?page=products">Products</a> |
        <a href="?page=categories">Categories</a> |
        <a href="?page=suppliers">Suppliers</a>
    </nav>

    <?php
    $page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
    
    switch ($page) {
        case 'products':
            include 'view/products.php';
            break;
        case 'product_form':
            include 'view/product_form.php';
            break;
        case 'categories':
            include 'view/categories.php';
            break;
        case 'category_form':
            include 'view/category_form.php';
            break;
        case 'suppliers':
            include 'view/suppliers.php';
            break;
        case 'supplier_form':
            include 'view/supplier_form.php';
            break;
        default:
            include 'view/dashboard.php';
            break;
    }
    ?>
</main>
<?php include 'view/footer.php'; ?>
