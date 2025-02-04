<?php
class FinancialController extends Controller {
    private $financialModel;
    private $accountModel;

    public function __construct() {
        $this->financialModel = $this->model('FinancialModel');
        $this->accountModel = $this->model('AccountModel');
    }

    // نمایش لیست تراکنش‌های مالی
    public function index() {
        if (!isLoggedIn()) {
            redirect('user/login');
        }

        $transactions = $this->financialModel->getTransactions();
        $data = [
            'transactions' => $transactions
        ];
        $this->view('financial/index', $data);
    }

    // افزودن تراکنش مالی
    public function add() {
        if (!isLoggedIn()) {
            redirect('user/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'account_id' => trim($_POST['account_id']),
                'type' => trim($_POST['type']),
                'amount' => trim($_POST['amount']),
                'date' => trim($_POST['date']),
                'description' => trim($_POST['description']),
                'account_id_err' => '',
                'type_err' => '',
                'amount_err' => '',
                'date_err' => ''
            ];

            // Validate account_id
            if (empty($data['account_id'])) {
                $data['account_id_err'] = 'لطفاً حساب را انتخاب کنید';
            }

            // Validate type
            if (empty($data['type'])) {
                $data['type_err'] = 'لطفاً نوع تراکنش را انتخاب کنید';
            }

            // Validate amount
            if (empty($data['amount'])) {
                $data['amount_err'] = 'لطفاً مبلغ را وارد کنید';
            }

            // Validate date
            if (empty($data['date'])) {
                $data['date_err'] = 'لطفاً تاریخ را وارد کنید';
            }

            // اگر خطایی وجود نداشت
            if (empty($data['account_id_err']) && empty($data['type_err']) && empty($data['amount_err']) && empty($data['date_err'])) {
                if ($this->financialModel->addTransaction($data)) {
                    flash('financial_message', 'تراکنش با موفقیت افزوده شد');
                    redirect('financial/index');
                } else {
                    die('خطا در افزودن تراکنش');
                }
            } else {
                // Load view with errors
                $accounts = $this->accountModel->getAccounts();
                $data['accounts'] = $accounts;
                $this->view('financial/add', $data);
            }
        } else {
            $accounts = $this->accountModel->getAccounts();
            $data = [
                'account_id' => '',
                'type' => '',
                'amount' => '',
                'date' => '',
                'description' => '',
                'account_id_err' => '',
                'type_err' => '',
                'amount_err' => '',
                'date_err' => '',
                'accounts' => $accounts
            ];
            $this->view('financial/add', $data);
        }
    }

    // ویرایش تراکنش مالی
    public function edit($id) {
        if (!isLoggedIn()) {
            redirect('user/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $id,
                'account_id' => trim($_POST['account_id']),
                'type' => trim($_POST['type']),
                'amount' => trim($_POST['amount']),
                'date' => trim($_POST['date']),
                'description' => trim($_POST['description']),
                'account_id_err' => '',
                'type_err' => '',
                'amount_err' => '',
                'date_err' => ''
            ];

            // Validate account_id
            if (empty($data['account_id'])) {
                $data['account_id_err'] = 'لطفاً حساب را انتخاب کنید';
            }

            // Validate type
            if (empty($data['type'])) {
                $data['type_err'] = 'لطفاً نوع تراکنش را انتخاب کنید';
            }

            // Validate amount
            if (empty($data['amount'])) {
                $data['amount_err'] = 'لطفاً مبلغ را وارد کنید';
            }

            // Validate date
            if (empty($data['date'])) {
                $data['date_err'] = 'لطفاً تاریخ را وارد کنید';
            }

            // اگر خطایی وجود نداشت
            if (empty($data['account_id_err']) && empty($data['type_err']) && empty($data['amount_err']) && empty($data['date_err'])) {
                if ($this->financialModel->updateTransaction($data)) {
                    flash('financial_message', 'تراکنش با موفقیت ویرایش شد');
                    redirect('financial/index');
                } else {
                    die('خطا در ویرایش تراکنش');
                }
            } else {
                // Load view with errors
                $accounts = $this->accountModel->getAccounts();
                $data['accounts'] = $accounts;
                $this->view('financial/edit', $data);
            }
        } else {
            $transaction = $this->financialModel->getTransactionById($id);
            $accounts = $this->accountModel->getAccounts();

            $data = [
                'id' => $id,
                'account_id' => $transaction->account_id,
                'type' => $transaction->type,
                'amount' => $transaction->amount,
                'date' => $transaction->date,
                'description' => $transaction->description,
                'account_id_err' => '',
                'type_err' => '',
                'amount_err' => '',
                'date_err' => '',
                'accounts' => $accounts
            ];
            $this->view('financial/edit', $data);
        }
    }

    // حذف تراکنش مالی
    public function delete($id) {
        if (!isLoggedIn()) {
            redirect('user/login');
        }

        if ($this->financialModel->deleteTransaction($id)) {
            flash('financial_message', 'تراکنش با موفقیت حذف شد');
            redirect('financial/index');
        } else {
            die('خطا در حذف تراکنش');
        }
    }

    // نمایش موجودی حساب‌ها
    public function balances() {
        if (!isLoggedIn()) {
            redirect('user/login');
        }

        $balances = $this->financialModel->getAccountBalances();
        $data = [
            'balances' => $balances
        ];
        $this->view('financial/balances', $data);
    }
}
?>