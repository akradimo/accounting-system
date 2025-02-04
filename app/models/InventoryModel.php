<?php
class InventoryModel {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    // دریافت لیست موجودی انبار
    public function getInventory() {
        $this->db->query('SELECT inventory.*, products.product_name FROM inventory LEFT JOIN products ON inventory.product_id = products.id ORDER BY inventory.date DESC');
        return $this->db->resultSet();
    }

    // افزودن موجودی به انبار
    public function addInventory($data) {
        $this->db->query('INSERT INTO inventory (product_id, quantity, date, description) VALUES (:product_id, :quantity, :date, :description)');

        // Bind values
        $this->db->bind(':product_id', $data['product_id']);
        $this->db->bind(':quantity', $data['quantity']);
        $this->db->bind(':date', $data['date']);
        $this->db->bind(':description', $data['description']);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // ویرایش موجودی انبار
    public function updateInventory($data) {
        $this->db->query('UPDATE inventory SET product_id = :product_id, quantity = :quantity, date = :date, description = :description WHERE id = :id');

        // Bind values
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':product_id', $data['product_id']);
        $this->db->bind(':quantity', $data['quantity']);
        $this->db->bind(':date', $data['date']);
        $this->db->bind(':description', $data['description']);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // حذف موجودی از انبار
    public function deleteInventory($id) {
        $this->db->query('DELETE FROM inventory WHERE id = :id');
        $this->db->bind(':id', $id);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
?>