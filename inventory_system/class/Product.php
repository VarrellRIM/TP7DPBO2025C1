<?php
require_once 'config/db.php';

class Product {
    private $db;

    public function __construct() {
        $this->db = (new Database())->conn;
    }

    public function getAllProducts() {
        $stmt = $this->db->query("SELECT p.*, c.name as category_name, s.name as supplier_name 
                                 FROM products p 
                                 LEFT JOIN categories c ON p.category_id = c.id 
                                 LEFT JOIN suppliers s ON p.supplier_id = s.id");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductById($id) {
        $stmt = $this->db->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function searchProducts($keyword) {
        $stmt = $this->db->prepare("SELECT p.*, c.name as category_name, s.name as supplier_name 
                                   FROM products p 
                                   LEFT JOIN categories c ON p.category_id = c.id 
                                   LEFT JOIN suppliers s ON p.supplier_id = s.id 
                                   WHERE p.name LIKE ? OR p.description LIKE ? OR c.name LIKE ? OR s.name LIKE ?");
        $keyword = "%$keyword%";
        $stmt->execute([$keyword, $keyword, $keyword, $keyword]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addProduct($name, $description, $price, $stock, $category_id, $supplier_id) {
        try {
            $stmt = $this->db->prepare("INSERT INTO products (name, description, price, stock, category_id, supplier_id) 
                                      VALUES (?, ?, ?, ?, ?, ?)");
            return $stmt->execute([$name, $description, $price, $stock, $category_id, $supplier_id]);
        } catch (PDOException $e) {
            error_log("Add product error: " . $e->getMessage());
            return false;
        }
    }

    public function updateProduct($id, $name, $description, $price, $stock, $category_id, $supplier_id) {
        try {
            $stmt = $this->db->prepare("UPDATE products 
                                      SET name = ?, description = ?, price = ?, stock = ?, category_id = ?, supplier_id = ? 
                                      WHERE id = ?");
            return $stmt->execute([$name, $description, $price, $stock, $category_id, $supplier_id, $id]);
        } catch (PDOException $e) {
            error_log("Update product error: " . $e->getMessage());
            return false;
        }
    }

    public function deleteProduct($id) {
        try {
            $stmt = $this->db->prepare("DELETE FROM products WHERE id = ?");
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            error_log("Delete product error: " . $e->getMessage());
            return false;
        }
    }

    public function updateStock($id, $stock) {
        try {
            $stmt = $this->db->prepare("UPDATE products SET stock = ? WHERE id = ?");
            return $stmt->execute([$stock, $id]);
        } catch (PDOException $e) {
            error_log("Update stock error: " . $e->getMessage());
            return false;
        }
    }
    
    public function getLowStockCount($threshold = 10) {
        try {
            $stmt = $this->db->prepare("SELECT COUNT(*) FROM products WHERE stock < ?");
            $stmt->execute([$threshold]);
            return $stmt->fetchColumn();
        } catch (PDOException $e) {
            error_log("Get low stock count error: " . $e->getMessage());
            return 0;
        }
    }
}
?>
