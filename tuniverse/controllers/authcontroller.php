<?php
// controllers/AuthController.php
require_once '../../controllers/User.php';

class AuthController {
    public function login($username, $password) {
        $user = User::authenticate($username, $password);
        
        if ($user) {
            session_start();
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            if ($user['role'] === 'admin') {
                header('Location: ../views/admin_dashboard.php');
            } else {
                header('Location: ../views/signup2.html');
            }
            exit();
        } else {
            echo "Invalid username or password.";
        }
    }

    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header('Location: ../views/login.html');
        exit();
    }
}
?>
