<?php
class UserModel {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    // ثبت‌نام کاربر
    public function register($data) {
        $this->db->query('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)');

        // Bind values
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // ورود کاربر
    public function login($email, $password) {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        if ($row && password_verify($password, $row->password)) {
            return $row;
        } else {
            return false;
        }
    }

    // بررسی وجود ایمیل
    public function findUserByEmail($email) {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    // دریافت اطلاعات کاربر
    public function getUserById($id) {
        $this->db->query('SELECT * FROM users WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    // ویرایش پروفایل کاربر
    public function updateProfile($data) {
        $this->db->query('UPDATE users SET name = :name, email = :email WHERE id = :id');

        // Bind values
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // تغییر رمز عبور
    public function changePassword($data) {
        $this->db->query('UPDATE users SET password = :password WHERE id = :id');

        // Bind values
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':password', $data['password']);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
?>