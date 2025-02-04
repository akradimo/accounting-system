<?php
class PersonModel {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    // افزودن شخص
    public function addPerson($data) {
        $this->db->query('INSERT INTO persons (name, phone, email, address, type) VALUES (:name, :phone, :email, :address, :type)');

        // Bind values
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':phone', $data['phone']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':address', $data['address']);
        $this->db->bind(':type', $data['type']);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // دریافت لیست اشخاص
    public function getPersons() {
        $this->db->query('SELECT * FROM persons ORDER BY created_at DESC');
        return $this->db->resultSet();
    }

    // دریافت اطلاعات یک شخص
    public function getPersonById($id) {
        $this->db->query('SELECT * FROM persons WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    // ویرایش شخص
    public function updatePerson($data) {
        $this->db->query('UPDATE persons SET name = :name, phone = :phone, email = :email, address = :address, type = :type WHERE id = :id');

        // Bind values
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':phone', $data['phone']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':address', $data['address']);
        $this->db->bind(':type', $data['type']);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // حذف شخص
    public function deletePerson($id) {
        $this->db->query('DELETE FROM persons WHERE id = :id');
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