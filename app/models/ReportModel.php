<?php
class ReportModel {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    // گزارش فروش ماهانه
    public function getMonthlySalesReport($year, $month) {
        $this->db->query('SELECT SUM(amount) AS total_sales FROM transactions WHERE type = "income" AND YEAR(date) = :year AND MONTH(date) = :month');
        $this->db->bind(':year', $year);
        $this->db->bind(':month', $month);
        return $this->db->single();
    }

    // گزارش خرید ماهانه
    public function getMonthlyPurchasesReport($year, $month) {
        $this->db->query('SELECT SUM(amount) AS total_purchases FROM transactions WHERE type = "expense" AND YEAR(date) = :year AND MONTH(date) = :month');
        $this->db->bind(':year', $year);
        $this->db->bind(':month', $month);
        return $this->db->single();
    }

    // گزارش سود و زیان
    public function getProfitLossReport($start_date, $end_date) {
        $this->db->query('SELECT   
            SUM(CASE WHEN type = "income" THEN amount ELSE 0 END) AS total_income,  
            SUM(CASE WHEN type = "expense" THEN amount ELSE 0 END) AS total_expense  
            FROM transactions   
            WHERE date BETWEEN :start_date AND :end_date');
        $this->db->bind(':start_date', $start_date);
        $this->db->bind(':end_date', $end_date);
        return $this->db->single();
    }

    // گزارش خرید
    public function getPurchaseReport($start_date, $end_date) {
        $this->db->query('SELECT invoices.*, persons.name AS person_name FROM invoices LEFT JOIN persons ON invoices.person_id = persons.id WHERE invoices.type = "خرید" AND invoices.date BETWEEN :start_date AND :end_date ORDER BY invoices.date DESC');
        $this->db->bind(':start_date', $start_date);
        $this->db->bind(':end_date', $end_date);
        return $this->db->resultSet();
    }

    // گزارش فروش
    public function getSaleReport($start_date, $end_date) {
        $this->db->query('SELECT invoices.*, persons.name AS person_name FROM invoices LEFT JOIN persons ON invoices.person_id = persons.id WHERE invoices.type = "فروش" AND invoices.date BETWEEN :start_date AND :end_date ORDER BY invoices.date DESC');
        $this->db->bind(':start_date', $start_date);
        $this->db->bind(':end_date', $end_date);
        return $this->db->resultSet();
    }

    // گزارش امور مالی
    public function getFinancialReport($start_date, $end_date) {
        $this->db->query('SELECT type, SUM(total_amount) AS total FROM invoices WHERE date BETWEEN :start_date AND :end_date GROUP BY type');
        $this->db->bind(':start_date', $start_date);
        $this->db->bind(':end_date', $end_date);
        return $this->db->resultSet();
    }
}
?>