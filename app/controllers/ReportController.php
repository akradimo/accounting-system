<?php
class ReportController extends Controller {
    private $reportModel;

    public function __construct() {
        $this->reportModel = $this->model('ReportModel');
    }

    // گزارش فروش ماهانه
    public function monthlySales() {
        if (!isLoggedIn()) {
            redirect('user/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'year' => trim($_POST['year']),
                'month' => trim($_POST['month']),
                'report' => null,
                'year_err' => '',
                'month_err' => ''
            ];

            // Validate year
            if (empty($data['year'])) {
                $data['year_err'] = 'لطفاً سال را وارد کنید';
            }

            // Validate month
            if (empty($data['month'])) {
                $data['month_err'] = 'لطفاً ماه را وارد کنید';
            }

            // اگر خطایی وجود نداشت
            if (empty($data['year_err']) && empty($data['month_err'])) {
                $data['report'] = $this->reportModel->getMonthlySalesReport($data['year'], $data['month']);
            }

            $this->view('reports/monthly_sales', $data);
        } else {
            $data = [
                'year' => '',
                'month' => '',
                'report' => null,
                'year_err' => '',
                'month_err' => ''
            ];
            $this->view('reports/monthly_sales', $data);
        }
    }

    // گزارش خرید ماهانه
    public function monthlyPurchases() {
        if (!isLoggedIn()) {
            redirect('user/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'year' => trim($_POST['year']),
                'month' => trim($_POST['month']),
                'report' => null,
                'year_err' => '',
                'month_err' => ''
            ];

            // Validate year
            if (empty($data['year'])) {
                $data['year_err'] = 'لطفاً سال را وارد کنید';
            }

            // Validate month
            if (empty($data['month'])) {
                $data['month_err'] = 'لطفاً ماه را وارد کنید';
            }

            // اگر خطایی وجود نداشت
            if (empty($data['year_err']) && empty($data['month_err'])) {
                $data['report'] = $this->reportModel->getMonthlyPurchasesReport($data['year'], $data['month']);
            }

            $this->view('reports/monthly_purchases', $data);
        } else {
            $data = [
                'year' => '',
                'month' => '',
                'report' => null,
                'year_err' => '',
                'month_err' => ''
            ];
            $this->view('reports/monthly_purchases', $data);
        }
    }

    // گزارش سود و زیان
    public function profitLoss() {
        if (!isLoggedIn()) {
            redirect('user/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'start_date' => trim($_POST['start_date']),
                'end_date' => trim($_POST['end_date']),
                'report' => null,
                'start_date_err' => '',
                'end_date_err' => ''
            ];

            // Validate start date
            if (empty($data['start_date'])) {
                $data['start_date_err'] = 'لطفاً تاریخ شروع را وارد کنید';
            }

            // Validate end date
            if (empty($data['end_date'])) {
                $data['end_date_err'] = 'لطفاً تاریخ پایان را وارد کنید';
            }

            // اگر خطایی وجود نداشت
            if (empty($data['start_date_err']) && empty($data['end_date_err'])) {
                $data['report'] = $this->reportModel->getProfitLossReport($data['start_date'], $data['end_date']);
            }

            $this->view('reports/profit_loss', $data);
        } else {
            $data = [
                'start_date' => '',
                'end_date' => '',
                'report' => null,
                'start_date_err' => '',
                'end_date_err' => ''
            ];
            $this->view('reports/profit_loss', $data);
        }
    }

    // گزارش خرید
    public function purchase() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'start_date' => trim($_POST['start_date']),
                'end_date' => trim($_POST['end_date']),
                'purchases' => []
            ];

            if (!empty($data['start_date']) && !empty($data['end_date'])) {
                $data['purchases'] = $this->reportModel->getPurchaseReport($data['start_date'], $data['end_date']);
            }

            $this->view('reports/purchase', $data);
        } else {
            $data = [
                'start_date' => '',
                'end_date' => '',
                'purchases' => []
            ];
            $this->view('reports/purchase', $data);
        }
    }

    // گزارش فروش
    public function sale() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'start_date' => trim($_POST['start_date']),
                'end_date' => trim($_POST['end_date']),
                'sales' => []
            ];

            if (!empty($data['start_date']) && !empty($data['end_date'])) {
                $data['sales'] = $this->reportModel->getSaleReport($data['start_date'], $data['end_date']);
            }

            $this->view('reports/sale', $data);
        } else {
            $data = [
                'start_date' => '',
                'end_date' => '',
                'sales' => []
            ];
            $this->view('reports/sale', $data);
        }
    }

    // گزارش امور مالی
    public function financial() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'start_date' => trim($_POST['start_date']),
                'end_date' => trim($_POST['end_date']),
                'financials' => []
            ];

            if (!empty($data['start_date']) && !empty($data['end_date'])) {
                $data['financials'] = $this->reportModel->getFinancialReport($data['start_date'], $data['end_date']);
            }

            $this->view('reports/financial', $data);
        } else {
            $data = [
                'start_date' => '',
                'end_date' => '',
                'financials' => []
            ];
            $this->view('reports/financial', $data);
        }
    }
}
?>