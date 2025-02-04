<?php
class InvoiceModel {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    // افزودن فاکتور
    public function addInvoice($data) {
        $this->db->query('INSERT INTO invoices (invoice_number, person_id, type, total_amount, date, description) VALUES (:invoice_number, :person_id, :type, :total_amount, :date, :description)');

        // Bind values
        $this->db->bind(':invoice_number', $data['invoice_number']);
        $this->db->bind(':person_id', $data['person_id']);
        $this->db->bind(':type', $data['type']);
        $this->db->bind(':total_amount', $data['total_amount']);
        $this->db->bind(':date', $data['date']);
        $this->db->bind(':description', $data['description']);

        // Execute
        if ($this->db->execute()) {
            return $this->db->lastInsertId();
        } else {
            return false;
        }
    }

    // افزودن آیتم‌های فاکتور
    public function addInvoiceItems($invoice_id, $items) {
        foreach ($items as $item) {
            $this->db->query('INSERT INTO invoice_items (invoice_id, product_id, quantity, unit_price, total_price) VALUES (:invoice_id, :product_id, :quantity, :unit_price, :total_price)');

            // Bind values
            $this->db->bind(':invoice_id', $invoice_id);
            $this->db->bind(':product_id', $item['product_id']);
            $this->db->bind(':quantity', $item['quantity']);
            $this->db->bind(':unit_price', $item['unit_price']);
            $this->db->bind(':total_price', $item['total_price']);

            // Execute
            if (!$this->db->execute()) {
                return false;
            }
        }
        return true;
    }

    // دریافت لیست فاکتورها
    public function getInvoices() {
        $this->db->query('SELECT invoices.*, persons.name AS person_name FROM invoices LEFT JOIN persons ON invoices.person_id = persons.id ORDER BY date DESC');
        return $this->db->resultSet();
    }

    // دریافت اطلاعات یک فاکتور
    public function getInvoiceById($id) {
        $this->db->query('SELECT invoices.*, persons.name AS person_name FROM invoices LEFT JOIN persons ON invoices.person_id = persons.id WHERE invoices.id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    // دریافت آیتم‌های یک فاکتور
    public function getInvoiceItems($invoice_id) {
        $this->db->query('SELECT invoice_items.*, products.product_name FROM invoice_items LEFT JOIN products ON invoice_items.product_id = products.id WHERE invoice_items.invoice_id = :invoice_id');
        $this->db->bind(':invoice_id', $invoice_id);
        return $this->db->resultSet();
    }

    // حذف فاکتور
    public function deleteInvoice($id) {
        $this->db->query('DELETE FROM invoices WHERE id = :id');
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