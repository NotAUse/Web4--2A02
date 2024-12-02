<?php
session_start();
require_once '../controllers/UserController.php';

$userController = new User();

// Check if the user is logged in as an admin
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.html');
    exit();
}

// Handle AJAX search and filter requests
if (isset($_GET['roleFilter']) || isset($_GET['searchQuery'])) {
    $roleFilter = isset($_GET['roleFilter']) ? $_GET['roleFilter'] : '';
    $searchQuery = isset($_GET['searchQuery']) ? $_GET['searchQuery'] : '';
    $users = $userController->getFilteredUsers($roleFilter, $searchQuery);

    header('Content-Type: application/json');
    echo json_encode($users);
    exit();
}

// Default: Fetch all users
$users = $userController->getAllUsers();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .admin-container {
            padding: 20px;
        }
        .filters {
            margin: 20px 0;
            display: flex;
            gap: 15px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        .button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        }
        .delete-button {
            background-color: red;
            padding: 5px 10px;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .logout-button {
            background-color: #f44336;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <h1>Admin Dashboard</h1>

        <!-- Add User Button -->
        <a href="user_form.php" class="button">Add New User</a>

        <!-- Logout Button -->
        <a href="logout.php" class="logout-button">Logout</a>

        <!-- Filters -->
        <div class="filters">
            <div>
                <label for="roleFilter">Filter by Role:</label>
                <select name="role" id="roleFilter">
                    <option value="">All</option>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
            </div>
            <div>
                <label for="searchQuery">Search by ID or Username:</label>
                <input type="text" id="searchQuery" placeholder="Enter ID or Username">
                <button id="searchButton">Search</button>
            </div>
        </div>

        <!-- Users Table -->
        <table id="usersTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo $user['id']; ?></td>
                        <td><?php echo $user['username']; ?></td>
                        <td><?php echo $user['email']; ?></td>
                        <td><?php echo $user['role']; ?></td>
                        <td>
                            <a href="user_form.php?id=<?php echo $user['id']; ?>" class="button">Edit</a>
                            <a href="../public/index.php?action=delete&id=<?php echo $user['id']; ?>" class="delete-button" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script>
        const roleFilter = document.getElementById('roleFilter');
        const searchQuery = document.getElementById('searchQuery');
        const searchButton = document.getElementById('searchButton');

        function fetchFilteredUsers() {
            const role = roleFilter.value;
            const query = searchQuery.value;
            const xhr = new XMLHttpRequest();
            xhr.open('GET', `admin_dashboard.php?roleFilter=${role}&searchQuery=${query}`, true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    try {
                        const users = JSON.parse(xhr.responseText);
                        const tableBody = document.querySelector('#usersTable tbody');
                        tableBody.innerHTML = '';

                        if (users.length > 0) {
                            users.forEach(user => {
                                const row = document.createElement('tr');
                                row.innerHTML = `
                                    <td>${user.id}</td>
                                    <td>${user.username}</td>
                                    <td>${user.email}</td>
                                    <td>${user.role}</td>
                                    <td>
                                        <a href="user_form.php?id=${user.id}" class="button">Edit</a>
                                        <a href="../public/index.php?action=delete&id=${user.id}" class="delete-button" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                                    </td>
                                `;
                                tableBody.appendChild(row);
                            });
                        } else {
                            tableBody.innerHTML = '<tr><td colspan="5">No users found for the search criteria.</td></tr>';
                        }
                    } catch (error) {
                        console.error('Error parsing response:', error);
                    }
                }
            };
            xhr.send();
        }

        roleFilter.addEventListener('change', fetchFilteredUsers);
        searchButton.addEventListener('click', fetchFilteredUsers);
    </script>
</body>
</html>
<?php

require_once 'database.php';

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.html');  // Redirect to login page if not logged in
    exit();
}

try {
    // Fetch all users from the database
    $pdo = require 'database.php';
    $query = "SELECT id, name, email, password_hash, created_at FROM user";
    $stmt = $pdo->query($query);
    $users = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }
        .container {
            width: 90%;
            margin: auto;
            overflow: hidden;
        }
        header {
            background: #333;
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }
        header h1 {
            margin: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background: #fff;
        }
        table th, table td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }
        table th {
            background: #333;
            color: #fff;
        }
        .logout-btn {
            background-color: #f44336;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            float: right;
        }
        .logout-btn:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>
    <header>
        <h1>clients dashboard</h1>
        
    </header>
    <div class="container">
        <h2> normal Users Table</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>password</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($users)): ?>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($user['id']); ?></td>
                            <td><?php echo htmlspecialchars($user['name']); ?></td>
                            <td><?php echo htmlspecialchars($user['email']); ?></td>
                            <td><?php echo htmlspecialchars($user['password_hash']); ?></td>
                            <td><?php echo htmlspecialchars($user['created_at']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" style="text-align: center;">No users found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
