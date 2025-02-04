<?php
class LogModel {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    // افزودن لاگ
    public function addLog($user_id, $action, $description) {
        $this->db->query('INSERT INTO logs (user_id, action, description) VALUES (:user_id, :action, :description)');

        // Bind values
        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':action', $action);
        $this->db->bind(':description', $description);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // دریافت لیست لاگ‌ها
    public function getLogs() {
        $this->db->query('SELECT logs.*, users.name AS user_name FROM logs LEFT JOIN users ON logs.user_id = users.id ORDER BY logs.created_at DESC');
        return $this->db->resultSet();
    }

    // دریافت لاگ بر اساس ID
    public function getLogById($id) {
        $this->db->query('SELECT logs.*, users.name AS user_name FROM logs LEFT JOIN users ON logs.user_id = users.id WHERE logs.id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }
}
?>