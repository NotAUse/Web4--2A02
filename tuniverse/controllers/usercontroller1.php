<?php
// controllers/UserController.php
require_once '../../controllers/User.php';

class UserController {
    public function getAllUsers() {
        return User::getAllUsers();
    }

    public function getUser($id) {
        return User::getUserById($id);
    }

    public function addUser($username, $email, $role) {
        return User::addUser($username, $email, $role);
    }

    public function updateUser($id, $username, $email, $role) {
        return User::updateUser($id, $username, $email, $role);
    }

    public function deleteUser($id) {
        return User::deleteUser($id);
    }
}
?>
