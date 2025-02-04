<?php
class SettingController extends Controller {
    private $settingModel;

    public function __construct() {
        $this->settingModel = $this->model('SettingModel');
    }

    // نمایش تنظیمات سیستم
    public function index() {
        if (!isLoggedIn()) {
            redirect('user/login');
        }

        $settings = $this->settingModel->getSettings();

        $data = [
            'settings' => $settings
        ];

        $this->view('settings/index', $data);
    }

    // ویرایش تنظیمات سیستم
    public function edit() {
        if (!isLoggedIn()) {
            redirect('user/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'company_name' => trim($_POST['company_name']),
                'address' => trim($_POST['address']),
                'phone' => trim($_POST['phone']),
                'email' => trim($_POST['email']),
                'website' => trim($_POST['website']),
                'company_name_err' => '',
                'address_err' => '',
                'phone_err' => '',
                'email_err' => '',
                'website_err' => ''
            ];

            // Validate company name
            if (empty($data['company_name'])) {
                $data['company_name_err'] = 'لطفاً نام شرکت را وارد کنید';
            }

            // Validate address
            if (empty($data['address'])) {
                $data['address_err'] = 'لطفاً آدرس را وارد کنید';
            }

            // Validate phone
            if (empty($data['phone'])) {
                $data['phone_err'] = 'لطفاً شماره تماس را وارد کنید';
            }

            // Validate email
            if (empty($data['email'])) {
                $data['email_err'] = 'لطفاً ایمیل را وارد کنید';
            }

            // Validate website
            if (empty($data['website'])) {
                $data['website_err'] = 'لطفاً وب‌سایت را وارد کنید';
            }

            // اگر خطایی وجود نداشت
            if (empty($data['company_name_err']) && empty($data['address_err']) && empty($data['phone_err']) && empty($data['email_err']) && empty($data['website_err'])) {
                if ($this->settingModel->updateSettings($data)) {
                    flash('settings_message', 'تنظیمات با موفقیت ویرایش شد');
                    redirect('setting/index');
                } else {
                    die('خطا در ویرایش تنظیمات');
                }
            } else {
                // Load view with errors
                $this->view('settings/edit', $data);
            }
        } else {
            $settings = $this->settingModel->getSettings();

            $data = [
                'company_name' => $settings->company_name,
                'address' => $settings->address,
                'phone' => $settings->phone,
                'email' => $settings->email,
                'website' => $settings->website,
                'company_name_err' => '',
                'address_err' => '',
                'phone_err' => '',
                'email_err' => '',
                'website_err' => ''
            ];
            $this->view('settings/edit', $data);
        }
    }
}
?>