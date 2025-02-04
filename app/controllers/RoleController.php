<?php
class RoleController extends Controller {
    private $roleModel;

    public function __construct() {
        $this->roleModel = $this->model('RoleModel');
    }

    // نمایش لیست نقش‌ها
    public function index() {
        if (!isLoggedIn() || !$this->checkPermission('view_roles')) {
            redirect('user/login');
        }

        $roles = $this->roleModel->getRoles();
        $data = [
            'roles' => $roles
        ];
        $this->view('roles/index', $data);
    }

    // افزودن نقش جدید
    public function add() {
        if (!isLoggedIn() || !$this->checkPermission('add_roles')) {
            redirect('user/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'name' => trim($_POST['name']),
                'permissions' => $_POST['permissions'],
                'name_err' => '',
                'permissions_err' => ''
            ];

            // Validate name
            if (empty($data['name'])) {
                $data['name_err'] = 'لطفاً نام نقش را وارد کنید';
            }

            // Validate permissions
            if (empty($data['permissions'])) {
                $data['permissions_err'] = 'لطفاً دسترسی‌ها را انتخاب کنید';
            }

            // اگر خطایی وجود نداشت
            if (empty($data['name_err']) && empty($data['permissions_err'])) {
                if ($this->roleModel->addRole($data)) {
                    flash('role_message', 'نقش با موفقیت افزوده شد');
                    redirect('role/index');
                } else {
                    die('خطا در افزودن نقش');
                }
            } else {
                // Load view with errors
                $this->view('roles/add', $data);
            }
        } else {
            $data = [
                'name' => '',
                'permissions' => [],
                'name_err' => '',
                'permissions_err' => ''
            ];
            $this->view('roles/add', $data);
        }
    }

    // ویرایش نقش
    public function edit($id) {
        if (!isLoggedIn() || !$this->checkPermission('edit_roles')) {
            redirect('user/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $id,
                'name' => trim($_POST['name']),
                'permissions' => $_POST['permissions'],
                'name_err' => '',
                'permissions_err' => ''
            ];

            // Validate name
            if (empty($data['name'])) {
                $data['name_err'] = 'لطفاً نام نقش را وارد کنید';
            }

            // Validate permissions
            if (empty($data['permissions'])) {
                $data['permissions_err'] = 'لطفاً دسترسی‌ها را انتخاب کنید';
            }

            // اگر خطایی وجود نداشت
            if (empty($data['name_err']) && empty($data['permissions_err'])) {
                if ($this->roleModel->updateRole($data)) {
                    flash('role_message', 'نقش با موفقیت ویرایش شد');
                    redirect('role/index');
                } else {
                    die('خطا در ویرایش نقش');
                }
            } else {
                // Load view with errors
                $this->view('roles/edit', $data);
            }
        } else {
            $role = $this->roleModel->getRoleById($id);

            $data = [
                'id' => $id,
                'name' => $role->name,
                'permissions' => json_decode($role->permissions, true),
                'name_err' => '',
                'permissions_err' => ''
            ];
            $this->view('roles/edit', $data);
        }
    }

    // حذف نقش
    public function delete($id) {
        if (!isLoggedIn() || !$this->checkPermission('delete_roles')) {
            redirect('user/login');
        }

        if ($this->roleModel->deleteRole($id)) {
            flash('role_message', 'نقش با موفقیت حذف شد');
            redirect('role/index');
        } else {
            die('خطا در حذف نقش');
        }
    }

    // بررسی دسترسی کاربر
    private function checkPermission($permission) {
        $userPermissions = $this->roleModel->getUserPermissions($_SESSION['user_id']);
        return in_array($permission, $userPermissions);
    }
}
?>