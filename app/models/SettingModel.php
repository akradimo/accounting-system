<?php
class SettingModel {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    // دریافت تنظیمات سیستم
    public function getSettings() {
        $this->db->query('SELECT * FROM settings LIMIT 1');
        return $this->db->single();
    }

    // ویرایش تنظیمات سیستم
    public function updateSettings($data) {
        $this->db->query('UPDATE settings SET company_name = :company_name, address = :address, phone = :phone, email = :email, website = :website WHERE id = 1');

        // Bind values
        $this->db->bind(':company_name', $data['company_name']);
        $this->db->bind(':address', $data['address']);
        $this->db->bind(':phone', $data['phone']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':website', $data['website']);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
?>