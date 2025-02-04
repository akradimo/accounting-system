<?php
class LogController extends Controller {
    private $logModel;

    public function __construct() {
        $this->logModel = $this->model('LogModel');
    }

    // نمایش لیست لاگ‌ها
    public function index() {
        if (!isLoggedIn() || !$this->checkPermission('view_logs')) {
            redirect('user/login');
        }

        $logs = $this->logModel->getLogs();
        $data = [
            'logs' => $logs
        ];
        $this->view('logs/index', $data);
    }

    // مشاهده جزئیات لاگ
    public function view($id) {
        if (!isLoggedIn() || !$this->checkPermission('view_logs')) {
            redirect('user/login');
        }

        $log = $this->logModel->getLogById($id);

        $data = [
            'log' => $log
        ];
        $this->view('logs/view', $data);
    }

    // بررسی دسترسی کاربر
    private function checkPermission($permission) {
        $userPermissions = $this->roleModel->getUserPermissions($_SESSION['user_id']);
        return in_array($permission, $userPermissions);
    }
}
?>