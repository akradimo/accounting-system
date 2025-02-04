<?php
class FinancialModel {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    // دریافت لیست تراکنش‌های مالی
    public function getTransactions() {
        $this->db->query('SELECT transactions.*, accounts.name AS account_name FROM transactions LEFT JOIN accounts ON transactions.account_id = accounts.id ORDER BY transactions.date DESC');
        return $this->db->resultSet();
    }

    // افزودن تراکنش مالی
    public function addTransaction($data) {
        $this->db->query('INSERT INTO transactions (account_id, type, amount, date, description) VALUES (:account_id, :type, :amount, :date, :description)');

        // Bind values
        $this->db->bind(':account_id', $data['account_id']);
        $this->db->bind(':type', $data['type']);
        $this->db->bind(':amount', $data['amount']);
        $this->db->bind(':date', $data['date']);
        $this->db->bind(':description', $data['description']);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // ویرایش تراکنش مالی
    public function updateTransaction($data) {
        $this->db->query('UPDATE transactions SET account_id = :account_id, type = :type, amount = :amount, date = :date, description = :description WHERE id = :id');

        // Bind values
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':account_id', $data['account_id']);
        $this->db->bind(':type', $data['type']);
        $this->db->bind(':amount', $data['amount']);
        $this->db->bind(':date', $data['date']);
        $this->db->bind(':description', $data['description']);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // حذف تراکنش مالی
    public function deleteTransaction($id) {
        $this->db->query('DELETE FROM transactions WHERE id = :id');
        $this->db->bind(':id', $id);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // دریافت موجودی حساب‌ها
    public function getAccountBalances() {
        $this->db->query('SELECT accounts.name, SUM(CASE WHEN transactions.type = "income" THEN transactions.amount ELSE -transactions.amount END) AS balance FROM accounts LEFT JOIN transactions ON accounts.id = transactions.account_id GROUP BY accounts.id');
        return $this->db->resultSet();
    }
}
?>