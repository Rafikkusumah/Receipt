<?php
// session_start();
class AuthController extends Controller {
    public function login() {
        $this->view('auth/login');
    }
    public function authenticate() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $userModel = $this->model('User');
            $user = $userModel->authenticate($_POST['username'], $_POST['password']);
            if ($user) {
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_username'] = $user['username'];
                header('Location: index.php?url=home/index');
                exit;
            } else {
                $_SESSION['error'] = 'Invalid credentials';
                header('Location: index.php?url=auth/login');
                exit;
            }
        }
        header('Location: index.php?url=auth/login');
    }
    public function logout() {
        session_destroy();
        header('Location: index.php?url=home/index');
        exit;
    }
}