<?php
require_once 'config/db.php';

class Supplier {
    private $db;

    public function __construct() {
        $this->db = (new Database())->conn;
    }

    public function getAllSuppliers() {
        $stmt = $this->db->query("SELECT * FROM suppliers");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSupplierById($id) {
        $stmt = $this->db->prepare("SELECT * FROM suppliers WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function searchSuppliers($keyword) {
        $stmt = $this->db->prepare("SELECT * FROM suppliers WHERE name LIKE ? OR contact_person LIKE ? OR email LIKE ?");
        $keyword = "%$keyword%";
        $stmt->execute([$keyword, $keyword, $keyword]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addSupplier($name, $contact_person, $email, $phone, $address) {
        $stmt = $this->db->prepare("INSERT INTO suppliers (name, contact_person, email, phone, address) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$name, $contact_person, $email, $phone, $address]);
    }

    public function updateSupplier($id, $name, $contact_person, $email, $phone, $address) {
        $stmt = $this->db->prepare("UPDATE suppliers SET name = ?, contact_person = ?, email = ?, phone = ?, address = ? WHERE id = ?");
        return $stmt->execute([$name, $contact_person, $email, $phone, $address, $id]);
    }

    public function deleteSupplier($id) {
        // Check if supplier has products
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM products WHERE supplier_id = ?");
        $stmt->execute([$id]);
        $hasProducts = $stmt->fetchColumn() > 0;
        
        if ($hasProducts) {
            return false; // Cannot delete supplier with products
        }
        
        $stmt = $this->db->prepare("DELETE FROM suppliers WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>