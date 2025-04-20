<?php
$id = isset($_GET['id']) ? $_GET['id'] : null;
$supplierData = $id ? $supplier->getSupplierById($id) : null;
$title = $id ? 'Edit Supplier' : 'Add New Supplier';
?>

<h3><?= $title ?></h3>

<form method="POST" action="?page=suppliers">
    <?php if ($id): ?>
        <input type="hidden" name="id" value="<?= $id ?>">
    <?php endif; ?>
    
    <div>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?= $supplierData ? htmlspecialchars($supplierData['name']) : '' ?>" required>
    </div>
    
    <div>
        <label for="contact_person">Contact Person:</label>
        <input type="text" id="contact_person" name="contact_person" value="<?= $supplierData ? htmlspecialchars($supplierData['contact_person']) : '' ?>">
    </div>
    
    <div>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?= $supplierData ? htmlspecialchars($supplierData['email']) : '' ?>">
    </div>
    
    <div>
        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" value="<?= $supplierData ? htmlspecialchars($supplierData['phone']) : '' ?>">
    </div>
    
    <div>
        <label for="address">Address:</label>
        <textarea id="address" name="address"><?= $supplierData ? htmlspecialchars($supplierData['address']) : '' ?></textarea>
    </div>
    
    <button type="submit" name="<?= $id ? 'update_supplier' : 'add_supplier' ?>"><?= $id ? 'Update' : 'Add' ?> Supplier</button>
    <a href="?page=suppliers" class="button">Cancel</a>
</form>