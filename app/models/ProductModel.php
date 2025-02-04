<?php
class ProductModel {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    // افزودن کالا
    public function addProduct($data) {
        $this->db->query('INSERT INTO products (group_name, subgroup_name, product_name, serial, barcode, barcode2, unit, initial_stock, purchase_price, store_purchase_price, purchase_discount, sale_price, store_sale_price, sale_discount, tax_percentage, description, date) VALUES (:group_name, :subgroup_name, :product_name, :serial, :barcode, :barcode2, :unit, :initial_stock, :purchase_price, :store_purchase_price, :purchase_discount, :sale_price, :store_sale_price, :sale_discount, :tax_percentage, :description, :date)');

        // Bind values
        $this->db->bind(':group_name', $data['group_name']);
        $this->db->bind(':subgroup_name', $data['subgroup_name']);
        $this->db->bind(':product_name', $data['product_name']);
        $this->db->bind(':serial', $data['serial']);
        $this->db->bind(':barcode', $data['barcode']);
        $this->db->bind(':barcode2', $data['barcode2']);
        $this->db->bind(':unit', $data['unit']);
        $this->db->bind(':initial_stock', $data['initial_stock']);
        $this->db->bind(':purchase_price', $data['purchase_price']);
        $this->db->bind(':store_purchase_price', $data['store_purchase_price']);
        $this->db->bind(':purchase_discount', $data['purchase_discount']);
        $this->db->bind(':sale_price', $data['sale_price']);
        $this->db->bind(':store_sale_price', $data['store_sale_price']);
        $this->db->bind(':sale_discount', $data['sale_discount']);
        $this->db->bind(':tax_percentage', $data['tax_percentage']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':date', $data['date']);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // دریافت لیست کالاها
    public function getProducts() {
        $this->db->query('SELECT * FROM products ORDER BY date DESC');
        return $this->db->resultSet();
    }

    // دریافت اطلاعات یک کالا
    public function getProductById($id) {
        $this->db->query('SELECT * FROM products WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    // ویرایش کالا
    public function updateProduct($data) {
        $this->db->query('UPDATE products SET group_name = :group_name, subgroup_name = :subgroup_name, product_name = :product_name, serial = :serial, barcode = :barcode, barcode2 = :barcode2, unit = :unit, initial_stock = :initial_stock, purchase_price = :purchase_price, store_purchase_price = :store_purchase_price, purchase_discount = :purchase_discount, sale_price = :sale_price, store_sale_price = :store_sale_price, sale_discount = :sale_discount, tax_percentage = :tax_percentage, description = :description, date = :date WHERE id = :id');

        // Bind values
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':group_name', $data['group_name']);
        $this->db->bind(':subgroup_name', $data['subgroup_name']);
        $this->db->bind(':product_name', $data['product_name']);
        $this->db->bind(':serial', $data['serial']);
        $this->db->bind(':barcode', $data['barcode']);
        $this->db->bind(':barcode2', $data['barcode2']);
        $this->db->bind(':unit', $data['unit']);
        $this->db->bind(':initial_stock', $data['initial_stock']);
        $this->db->bind(':purchase_price', $data['purchase_price']);
        $this->db->bind(':store_purchase_price', $data['store_purchase_price']);
        $this->db->bind(':purchase_discount', $data['purchase_discount']);
        $this->db->bind(':sale_price', $data['sale_price']);
        $this->db->bind(':store_sale_price', $data['store_sale_price']);
        $this->db->bind(':sale_discount', $data['sale_discount']);
        $this->db->bind(':tax_percentage', $data['tax_percentage']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':date', $data['date']);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // حذف کالا
    public function deleteProduct($id) {
        $this->db->query('DELETE FROM products WHERE id = :id');
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