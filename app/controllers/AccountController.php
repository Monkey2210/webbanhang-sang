<?php
require_once('app/config/database.php');
require_once('app/models/AccountModel.php');

class AccountController
{
    private $accountModel;
    private $db;
    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $this->db = (new Database())->getConnection();
        $this->accountModel = new AccountModel($this->db);
    }


    function register()
    {
        include_once 'app/views/account/register.php';
    }

    public function login()
    {
        include_once 'app/views/account/login.php';
    }

    function save()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'] ?? '';
            $fullName = $_POST['fullname'] ?? '';
            $password = $_POST['password'] ?? '';
            $confirmPassword = $_POST['confirmpassword'] ?? '';
            $errors = [];
            if (empty($username)) {
                $errors['username'] = "Vui long nhap userName!";
            }
            if (empty($fullName)) {
                $errors['fullname'] = "Vui long nhap fullName!";
            }
            if (empty($password)) {
                $errors['password'] = "Vui long nhap password!";
            }
            if ($password != $confirmPassword) {
                $errors['confirmPass'] = "Mat khau va xac nhan chua dung";
            }
            //kiểm tra username đã được đăng ký chưa?
            $account = $this->accountModel->getAccountByUsername($username);
            if ($account) {
                $errors['account'] = "Tai khoan nay da co nguoi dang ky!";
            }
            if (count($errors) > 0) {
                include_once 'app/views/account/register.php';
            } else {
                $password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
                $result = $this->accountModel->save($username, $fullName, $password);
                if ($result) {
                    header('Location: /webbanhang/account/login');
                }
            }
        }
    }
    function logout()
    {
        unset($_SESSION['username']);
        unset($_SESSION['role']);
        header('Location: /webbanhang/product');
    }
    public function checkLogin()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = trim($_POST['username'] ?? '');
            $password = trim($_POST['password'] ?? '');

            if (empty($username) || empty($password)) {
                echo "Vui lòng nhập đầy đủ thông tin!";
                return;
            }

            $account = $this->accountModel->getAccountByUsername($username);

            echo "<pre>";
            print_r($account);
            echo "</pre>";

            if ($account) {
                $pwd_hashed = $account->password;
                if (password_verify($password, $pwd_hashed)) {
                    if (session_status() == PHP_SESSION_NONE) {
                        session_start();
                    }

                    $_SESSION['username'] = $account->username;
                    $_SESSION['role'] = $account->role ?? 'user'; // Đặt mặc định là 'user' nếu NULL

                    echo "<pre>";
                    print_r($_SESSION);
                    echo "</pre>";

                    header('Location: /webbanhang/product');
                    exit;
                } else {
                    echo "Mật khẩu không đúng!";
                }
            } else {
                echo "Không tìm thấy tài khoản!";
            }
        }
    }






    public function sendresetlink()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST['email'];

            // Kiểm tra xem email có tồn tại trong database không
            $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch();

            if ($user) {
                // Tạo token đặt lại mật khẩu
                $token = bin2hex(random_bytes(50));

                // Lưu token vào database
                $stmt = $this->db->prepare("UPDATE users SET reset_token = ? WHERE email = ?");
                $stmt->execute([$token, $email]);

                // Gửi email chứa link đặt lại mật khẩu
                $resetLink = "http://localhost/webbanhang/account/resetpassword?token=$token";
                $subject = "Reset Your Password";
                $message = "Click here to reset your password: $resetLink";
                $headers = "From: noreply@yourwebsite.com";

                mail($email, $subject, $message, $headers);

                echo "A password reset link has been sent to your email.";
            } else {
                echo "Email not found!";
            }
        }
    }

    public function resetpassword()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST['username'];

            // Gọi từ AccountModel thay vì từ Database
            $user = $this->accountModel->getUserByUsername($username);

            if ($user) {
                $_SESSION['reset_user'] = $username;
                header("Location: /webbanhang/account/newpassword");
                exit();
            } else {
                $errors[] = "Username không tồn tại!";
                include 'app/views/account/forgotpassword.php';
            }
        }
    }


    public function updatepassword()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (!isset($_SESSION['reset_user'])) {
                header("Location: /webbanhang/account/forgotpassword");
                exit();
            }

            $username = $_SESSION['reset_user'];
            $newpassword = $_POST['newpassword'];
            $confirmpassword = $_POST['confirmpassword'];

            if ($newpassword !== $confirmpassword) {
                $errors[] = "Mật khẩu nhập lại không khớp!";
                include 'app/views/account/newpassword.php';
                return;
            }

            // Gọi từ AccountModel thay vì từ Database
            $this->accountModel->updatePassword($username, password_hash($newpassword, PASSWORD_DEFAULT));

            unset($_SESSION['reset_user']);
            header("Location: /webbanhang/account/login");
            exit();
        }
    }


    public function forgotpassword()
    {
        include 'app/views/account/forgotpassword.php';
    }

    public function verify()
    {
        if (!isset($_SESSION['reset_user'])) {
            header("Location: /webbanhang/account/forgotpassword");
            exit();
        }

        // Hiển thị trang xác nhận
        include 'app/views/account/verify.php';
    }
}
