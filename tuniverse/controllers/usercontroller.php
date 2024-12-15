<?php
require_once '../../controllers/User.php';


class UserController {
    private $userModel;
    

    public function __construct() {
        $this->userModel = new User();
    }

    public function getAllUsers() {
        return $this->userModel->getAllUsers();
    }

    public function getUser($id) {
        return $this->userModel->getUserById($id);
    }

    public function addUser($username, $email, $password, $role) {
        return $this->userModel->addUser($username, $email, $password, $role);
    }

    public function updateUser($id, $username, $email, $password, $role) {
        return $this->userModel->updateUser($id, $username, $email, $password, $role);
    }

    public function deleteUser($id) {
        return $this->userModel->deleteUser($id);
    }
}


?>
