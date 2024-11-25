<?php
session_start();

// Validate if the user is logged in and has a role
if (!isset($_SESSION['username']) || !isset($_SESSION['role'])) {
    header('Location: ../views/login.html'); // Ensure this is the correct relative path
    exit();
}

// Include necessary controllers
require_once '../controllers/UserController.php';

$userController = new UserController();

$action = $_GET['action'] ?? null;

if ($action === 'create' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password']; // Hash in real apps
    $role = $_POST['role'];
    $userController->addUser($username, $email, $password, $role);
    header('Location: ../views/admin_dashboard.php');
    exit();
}

if ($action === 'update' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password']; // Hash in real apps
    $role = $_POST['role'];
    $userController->updateUser($id, $username, $email, $password, $role);
    header('Location: ../views/admin_dashboard.php');
    exit();
}

if ($action === 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $userController->deleteUser($id);
    header('Location: ../views/admin_dashboard.php');
    exit();
}
?>
