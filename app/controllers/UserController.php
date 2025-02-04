<?php
class UserController extends Controller {
    private $userModel;

    public function __construct() {
        $this->userModel = $this->model('UserModel');
    }

    // ثبت‌نام کاربر
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];

            // Validate name
            if (empty($data['name'])) {
                $data['name_err'] = 'لطفاً نام خود را وارد کنید';
            }

            // Validate email
            if (empty($data['email'])) {
                $data['email_err'] = 'لطفاً ایمیل خود را وارد کنید';
            } elseif ($this->userModel->findUserByEmail($data['email'])) {
                $data['email_err'] = 'این ایمیل قبلاً ثبت‌شده است';
            }

            // Validate password
            if (empty($data['password'])) {
                $data['password_err'] = 'لطفاً رمز عبور را وارد کنید';
            } elseif (strlen($data['password']) < 6) {
                $data['password_err'] = 'رمز عبور باید حداقل ۶ کاراکتر باشد';
            }

            // Validate confirm password
            if (empty($data['confirm_password'])) {
                $data['confirm_password_err'] = 'لطفاً تکرار رمز عبور را وارد کنید';
            } elseif ($data['password'] != $data['confirm_password']) {
                $data['confirm_password_err'] = 'رمز عبور و تکرار آن مطابقت ندارند';
            }

            // اگر خطایی وجود نداشت
            if (empty($data['name_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {
                // Hash password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                // Register user
                if ($this->userModel->register($data)) {
                    redirect('user/login');
                } else {
                    die('خطا در ثبت‌نام');
                }
            } else {
                // Load view with errors
                $this->view('users/register', $data);
            }
        } else {
            $data = [
                'name' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];
            $this->view('users/register', $data);
        }
    }

    // ورود کاربر
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'email_err' => '',
                'password_err' => ''
            ];

            // Validate email
            if (empty($data['email'])) {
                $data['email_err'] = 'لطفاً ایمیل خود را وارد کنید';
            }

            // Validate password
            if (empty($data['password'])) {
                $data['password_err'] = 'لطفاً رمز عبور را وارد کنید';
            }

            // اگر خطایی وجود نداشت
            if (empty($data['email_err']) && empty($data['password_err'])) {
                // Check and set logged in user
                $loggedInUser = $this->userModel->login($data['email'], $data['password']);

                if ($loggedInUser) {
                    // Create session
                    $this->createUserSession($loggedInUser);
                } else {
                    $data['password_err'] = 'ایمیل یا رمز عبور اشتباه است';
                    $this->view('users/login', $data);
                }
            } else {
                // Load view with errors
                $this->view('users/login', $data);
            }
        } else {
            $data = [
                'email' => '',
                'password' => '',
                'email_err' => '',
                'password_err' => ''
            ];
            $this->view('users/login', $data);
        }
    }

    // ایجاد session برای کاربر
    public function createUserSession($user) {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_name'] = $user->name;
        redirect('dashboard');
    }

    // خروج کاربر
    public function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        session_destroy();
        redirect('user/login');
    }

    // ویرایش پروفایل
    public function profile() {
        if (!isLoggedIn()) {
            redirect('user/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $_SESSION['user_id'],
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'name_err' => '',
                'email_err' => ''
            ];

            // Validate name
            if (empty($data['name'])) {
                $data['name_err'] = 'لطفاً نام خود را وارد کنید';
            }

            // Validate email
            if (empty($data['email'])) {
                $data['email_err'] = 'لطفاً ایمیل خود را وارد کنید';
            }

            // اگر خطایی وجود نداشت
            if (empty($data['name_err']) && empty($data['email_err'])) {
                if ($this->userModel->updateProfile($data)) {
                    flash('profile_message', 'پروفایل با موفقیت ویرایش شد');
                    redirect('user/profile');
                } else {
                    die('خطا در ویرایش پروفایل');
                }
            } else {
                // Load view with errors
                $this->view('users/profile', $data);
            }
        } else {
            $user = $this->userModel->getUserById($_SESSION['user_id']);

            $data = [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'name_err' => '',
                'email_err' => ''
            ];
            $this->view('users/profile', $data);
        }
    }

    // تغییر رمز عبور
    public function changePassword() {
        if (!isLoggedIn()) {
            redirect('user/login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $_SESSION['user_id'],
                'current_password' => trim($_POST['current_password']),
                'new_password' => trim($_POST['new_password']),
                'confirm_new_password' => trim($_POST['confirm_new_password']),
                'current_password_err' => '',
                'new_password_err' => '',
                'confirm_new_password_err' => ''
            ];

            // Validate current password
            if (empty($data['current_password'])) {
                $data['current_password_err'] = 'لطفاً رمز عبور فعلی را وارد کنید';
            } else {
                $user = $this->userModel->getUserById($data['id']);
                if (!password_verify($data['current_password'], $user->password)) {
                    $data['current_password_err'] = 'رمز عبور فعلی اشتباه است';
                }
            }

            // Validate new password
            if (empty($data['new_password'])) {
                $data['new_password_err'] = 'لطفاً رمز عبور جدید را وارد کنید';
            } elseif (strlen($data['new_password']) < 6) {
                $data['new_password_err'] = 'رمز عبور جدید باید حداقل ۶ کاراکتر باشد';
            }

            // Validate confirm new password
            if (empty($data['confirm_new_password'])) {
                $data['confirm_new_password_err'] = 'لطفاً تکرار رمز عبور جدید را وارد کنید';
            } elseif ($data['new_password'] != $data['confirm_new_password']) {
                $data['confirm_new_password_err'] = 'رمز عبور جدید و تکرار آن مطابقت ندارند';
            }

            // اگر خطایی وجود نداشت
            if (empty($data['current_password_err']) && empty($data['new_password_err']) && empty($data['confirm_new_password_err'])) {
                // Hash new password
                $data['new_password'] = password_hash($data['new_password'], PASSWORD_DEFAULT);

                if ($this->userModel->changePassword($data)) {
                    flash('password_message', 'رمز عبور با موفقیت تغییر کرد');
                    redirect('user/changePassword');
                } else {
                    die('خطا در تغییر رمز عبور');
                }
            } else {
                // Load view with errors
                $this->view('users/changePassword', $data);
            }
        } else {
            $data = [
                'current_password' => '',
                'new_password' => '',
                'confirm_new_password' => '',
                'current_password_err' => '',
                'new_password_err' => '',
                'confirm_new_password_err' => ''
            ];
            $this->view('users/changePassword', $data);
        }
    }
}
?>