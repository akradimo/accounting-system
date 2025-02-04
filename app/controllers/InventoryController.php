<?php
class InventoryController extends Controller {
    private $inventoryModel;
    private $productModel;

    public function __construct() {
        $this->inventoryModel = $this->model('InventoryModel');
        $this->productModel = $this->model('ProductModel');
    }

    // نمایش لیست موجودی انبار
    public function index() {
        if (!isLoggedIn()) {
            redirect('user/login');
        }

        $inventory = $this->inventoryModel->getInventory();
        $data = [
            'inventory' => $inventory
        ];
        $this->view('inventory/index', $data);
    }

    // افزودن موجودی به انبار
    public function add() {
        if (!isLoggedIn()) {
            redirect('user/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'product_id' => trim($_POST['product_id']),
                'quantity' => trim($_POST['quantity']),
                'date' => trim($_POST['date']),
                'description' => trim($_POST['description']),
                'product_id_err' => '',
                'quantity_err' => '',
                'date_err' => ''
            ];

            // Validate product_id
            if (empty($data['product_id'])) {
                $data['product_id_err'] = 'لطفاً محصول را انتخاب کنید';
            }

            // Validate quantity
            if (empty($data['quantity'])) {
                $data['quantity_err'] = 'لطفاً تعداد را وارد کنید';
            }

            // Validate date
            if (empty($data['date'])) {
                $data['date_err'] = 'لطفاً تاریخ را وارد کنید';
            }

            // اگر خطایی وجود نداشت
            if (empty($data['product_id_err']) && empty($data['quantity_err']) && empty($data['date_err'])) {
                if ($this->inventoryModel->addInventory($data)) {
                    flash('inventory_message', 'موجودی با موفقیت افزوده شد');
                    redirect('inventory/index');
                } else {
                    die('خطا در افزودن موجودی');
                }
            } else {
                // Load view with errors
                $products = $this->productModel->getProducts();
                $data['products'] = $products;
                $this->view('inventory/add', $data);
            }
        } else {
            $products = $this->productModel->getProducts();
            $data = [
                'product_id' => '',
                'quantity' => '',
                'date' => '',
                'description' => '',
                'product_id_err' => '',
                'quantity_err' => '',
                'date_err' => '',
                'products' => $products
            ];
            $this->view('inventory/add', $data);
        }
    }

    // ویرایش موجودی انبار
    public function edit($id) {
        if (!isLoggedIn()) {
            redirect('user/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $id,
                'product_id' => trim($_POST['product_id']),
                'quantity' => trim($_POST['quantity']),
                'date' => trim($_POST['date']),
                'description' => trim($_POST['description']),
                'product_id_err' => '',
                'quantity_err' => '',
                'date_err' => ''
            ];

            // Validate product_id
            if (empty($data['product_id'])) {
                $data['product_id_err'] = 'لطفاً محصول را انتخاب کنید';
            }

            // Validate quantity
            if (empty($data['quantity'])) {
                $data['quantity_err'] = 'لطفاً تعداد را وارد کنید';
            }

            // Validate date
            if (empty($data['date'])) {
                $data['date_err'] = 'لطفاً تاریخ را وارد کنید';
            }

            // اگر خطایی وجود نداشت
            if (empty($data['product_id_err']) && empty($data['quantity_err']) && empty($data['date_err'])) {
                if ($this->inventoryModel->updateInventory($data)) {
                    flash('inventory_message', 'موجودی با موفقیت ویرایش شد');
                    redirect('inventory/index');
                } else {
                    die('خطا در ویرایش موجودی');
                }
            } else {
                // Load view with errors
                $products = $this->productModel->getProducts();
                $data['products'] = $products;
                $this->view('inventory/edit', $data);
            }
        } else {
            $inventory = $this->inventoryModel->getInventoryById($id);
            $products = $this->productModel->getProducts();

            $data = [
                'id' => $id,
                'product_id' => $inventory->product_id,
                'quantity' => $inventory->quantity,
                'date' => $inventory->date,
                'description' => $inventory->description,
                'product_id_err' => '',
                'quantity_err' => '',
                'date_err' => '',
                'products' => $products
            ];
            $this->view('inventory/edit', $data);
        }
    }

    // حذف موجودی از انبار
    public function delete($id) {
        if (!isLoggedIn()) {
            redirect('user/login');
        }

        if ($this->inventoryModel->deleteInventory($id)) {
            flash('inventory_message', 'موجودی با موفقیت حذف شد');
            redirect('inventory/index');
        } else {
            die('خطا در حذف موجودی');
        }
    }
}
?>