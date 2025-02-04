<?php
class InvoiceController extends Controller {
    private $invoiceModel;
    private $personModel;
    private $productModel;

    public function __construct() {
        $this->invoiceModel = $this->model('InvoiceModel');
        $this->personModel = $this->model('PersonModel');
        $this->productModel = $this->model('ProductModel');
    }

    // نمایش لیست فاکتورها
    public function index() {
        $invoices = $this->invoiceModel->getInvoices();
        $data = [
            'invoices' => $invoices
        ];
        $this->view('invoices/index', $data);
    }

    // افزودن فاکتور
    public function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'invoice_number' => trim($_POST['invoice_number']),
                'person_id' => trim($_POST['person_id']),
                'type' => trim($_POST['type']),
                'total_amount' => trim($_POST['total_amount']),
                'date' => trim($_POST['date']),
                'description' => trim($_POST['description']),
                'items' => $_POST['items']
            ];

            // Add invoice
            $invoice_id = $this->invoiceModel->addInvoice($data);
            if ($invoice_id) {
                // Add invoice items
                if ($this->invoiceModel->addInvoiceItems($invoice_id, $data['items'])) {
                    redirect('invoice/index');
                } else {
                    die('خطا در افزودن آیتم‌های فاکتور');
                }
            } else {
                die('خطا در افزودن فاکتور');
            }
        } else {
            $persons = $this->personModel->getPersons();
            $products = $this->productModel->getProducts();
            $data = [
                'invoice_number' => '',
                'person_id' => '',
                'type' => '',
                'total_amount' => '',
                'date' => '',
                'description' => '',
                'persons' => $persons,
                'products' => $products
            ];
            $this->view('invoices/add', $data);
        }
    }

    // مشاهده جزئیات فاکتور
    public function view($id) {
        $invoice = $this->invoiceModel->getInvoiceById($id);
        $items = $this->invoiceModel->getInvoiceItems($id);

        $data = [
            'invoice' => $invoice,
            'items' => $items
        ];
        $this->view('invoices/view', $data);
    }

    // حذف فاکتور
    public function delete($id) {
        if ($this->invoiceModel->deleteInvoice($id)) {
            redirect('invoice/index');
        } else {
            die('خطا در حذف فاکتور');
        }
    }
}
?>