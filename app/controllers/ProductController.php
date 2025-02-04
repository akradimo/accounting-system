<?php
class ProductController extends Controller {
    private $productModel;

    public function __construct() {
        $this->productModel = $this->model('ProductModel');
    }

    // نمایش لیست کالاها
    public function index() {
        $products = $this->productModel->getProducts();
        $data = [
            'products' => $products
        ];
        $this->view('products/index', $data);
    }

    // افزودن کالا
    public function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'group_name' => trim($_POST['group_name']),
                'subgroup_name' => trim($_POST['subgroup_name']),
                'product_name' => trim($_POST['product_name']),
                'serial' => trim($_POST['serial']),
                'barcode' => trim($_POST['barcode']),
                'barcode2' => trim($_POST['barcode2']),
                'unit' => trim($_POST['unit']),
                'initial_stock' => trim($_POST['initial_stock']),
                'purchase_price' => trim($_POST['purchase_price']),
                'store_purchase_price' => trim($_POST['store_purchase_price']),
                'purchase_discount' => trim($_POST['purchase_discount']),
                'sale_price' => trim($_POST['sale_price']),
                'store_sale_price' => trim($_POST['store_sale_price']),
                'sale_discount' => trim($_POST['sale_discount']),
                'tax_percentage' => trim($_POST['tax_percentage']),
                'description' => trim($_POST['description']),
                'date' => trim($_POST['date'])
            ];

            if ($this->productModel->addProduct($data)) {
                redirect('product/index');
            } else {
                die('خطا در افزودن کالا');
            }
        } else {
            $data = [
                'group_name' => '',
                'subgroup_name' => '',
                'product_name' => '',
                'serial' => '',
                'barcode' => '',
                'barcode2' => '',
                'unit' => '',
                'initial_stock' => '',
                'purchase_price' => '',
                'store_purchase_price' => '',
                'purchase_discount' => '',
                'sale_price' => '',
                'store_sale_price' => '',
                'sale_discount' => '',
                'tax_percentage' => '',
                'description' => '',
                'date' => ''
            ];
            $this->view('products/add', $data);
        }
    }

    // ویرایش کالا
    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $id,
                'group_name' => trim($_POST['group_name']),
                'subgroup_name' => trim($_POST['subgroup_name']),
                'product_name' => trim($_POST['product_name']),
                'serial' => trim($_POST['serial']),
                'barcode' => trim($_POST['barcode']),
                'barcode2' => trim($_POST['barcode2']),
                'unit' => trim($_POST['unit']),
                'initial_stock' => trim($_POST['initial_stock']),
                'purchase_price' => trim($_POST['purchase_price']),
                'store_purchase_price' => trim($_POST['store_purchase_price']),
                'purchase_discount' => trim($_POST['purchase_discount']),
                'sale_price' => trim($_POST['sale_price']),
                'store_sale_price' => trim($_POST['store_sale_price']),
                'sale_discount' => trim($_POST['sale_discount']),
                'tax_percentage' => trim($_POST['tax_percentage']),
                'description' => trim($_POST['description']),
                'date' => trim($_POST['date'])
            ];

            if ($this->productModel->updateProduct($data)) {
                redirect('product/index');
            } else {
                die('خطا در ویرایش کالا');
            }
        } else {
            $product = $this->productModel->getProductById($id);

            $data = [
                'id' => $id,
                'group_name' => $product->group_name,
                'subgroup_name' => $product->subgroup_name,
                'product_name' => $product->product_name,
                'serial' => $product->serial,
                'barcode' => $product->barcode,
                'barcode2' => $product->barcode2,
                'unit' => $product->unit,
                'initial_stock' => $product->initial_stock,
                'purchase_price' => $product->purchase_price,
                'store_purchase_price' => $product->store_purchase_price,
                'purchase_discount' => $product->purchase_discount,
                'sale_price' => $product->sale_price,
                'store_sale_price' => $product->store_sale_price,
                'sale_discount' => $product->sale_discount,
                'tax_percentage' => $product->tax_percentage,
                'description' => $product->description,
                'date' => $product->date
            ];
            $this->view('products/edit', $data);
        }
    }

    // حذف کالا
    public function delete($id) {
        if ($this->productModel->deleteProduct($id)) {
            redirect('product/index');
        } else {
            die('خطا در حذف کالا');
        }
    }
}
?>