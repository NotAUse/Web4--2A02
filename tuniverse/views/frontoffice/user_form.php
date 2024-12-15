<?php
session_start();
require_once '../controllers/UserController.php';

$userController = new UserController();
$id = $_GET['id'] ?? null;
$user = $id ? $userController->getUser($id) : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $id ? 'Edit' : 'Add'; ?> User</title>
</head>
<body>
    <h1><?php echo $id ? 'Edit' : 'Add'; ?> User</h1>
    <form action="../public/index.php?action=<?php echo $id ? 'update' : 'create'; ?>" method="POST">
        <?php if ($id): ?>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
        <?php endif; ?>
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" value="<?php echo $user['username'] ?? ''; ?>" required><br>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?php echo $user['email'] ?? ''; ?>" required><br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br>
        <label for="role">Role:</label>
        <select name="role" id="role" required>
            <option value="user" <?php echo ($user['role'] ?? '') === 'user' ? 'selected' : ''; ?>>User</option>
            <option value="admin" <?php echo ($user['role'] ?? '') === 'admin' ? 'selected' : ''; ?>>Admin</option>
        </select><br>
        <button type="submit"><?php echo $id ? 'Update' : 'Add'; ?> User</button>
    </form>
</body>
</html>
