<h3>Supplier List</h3>

<div class="search-form">
    <form method="GET" action="?page=suppliers">
        <input type="hidden" name="page" value="suppliers">
        <input type="text" name="search" placeholder="Search by supplier name or contact" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
        <button type="submit">Search</button>
        <a href="?page=suppliers" class="button">Show All</a>
    </form>
</div>

<a href="?page=supplier_form" class="button">Add New Supplier</a>

<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Contact Person</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Address</th>
        <th>Actions</th>
    </tr>
    <?php 
    $suppliers = isset($_GET['search']) ? $supplier->searchSuppliers($_GET['search']) : $supplier->getAllSuppliers();
    if (count($suppliers) > 0):
        foreach ($suppliers as $s): 
    ?>
    <tr>
        <td><?= $s['id'] ?></td>
        <td><?= htmlspecialchars($s['name']) ?></td>
        <td><?= htmlspecialchars($s['contact_person']) ?></td>
        <td><?= htmlspecialchars($s['email']) ?></td>
        <td><?= htmlspecialchars($s['phone']) ?></td>
        <td><?= htmlspecialchars($s['address']) ?></td>
        <td>
            <a href="?page=supplier_form&id=<?= $s['id'] ?>" class="button button-edit">Edit</a>
            <a href="?page=suppliers&delete=<?= $s['id'] ?>" class="button button-delete" onclick="return confirm('Are you sure you want to delete this supplier?')">Delete</a>
        </td>
    </tr>
    <?php 
        endforeach; 
    else: 
    ?>
    <tr>
        <td colspan="7">No suppliers found</td>
    </tr>
    <?php endif; ?>
</table>