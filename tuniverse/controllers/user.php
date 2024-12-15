<?php
require_once '../../config/db.php';

class User {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getAllUsers($role = '') {
        if (!empty($role)) {
            $query = "SELECT * FROM users WHERE role = :role";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':role', $role, PDO::PARAM_STR);
        } else {
            $query = "SELECT * FROM users";
            $stmt = $this->conn->prepare($query);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserById($id) {
        $query = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    

    public function addUser($username, $email, $password, $role) {
        $query = "INSERT INTO users (username, email, password, role) VALUES (:username, :email, :password, :role)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password); // Use password hashing in real-world apps
        $stmt->bindParam(':role', $role);
        $stmt->execute();
        return $this->conn->lastInsertId();
    }

    public function updateUser($id, $username, $email, $password, $role) {
        $query = "UPDATE users SET username = :username, email = :email, password = :password, role = :role WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password); // Use password hashing in real-world apps
        $stmt->bindParam(':role', $role);
        return $stmt->execute();
    }

    public function deleteUser($id) {
        $query = "DELETE FROM users WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
    public function getFilteredUsers($role = '', $searchQuery = '') {
        $query = "SELECT * FROM users WHERE 1";
    
        if (!empty($role)) {
            $query .= " AND role = :role";
        }
    
        if (!empty($searchQuery)) {
            $query .= " AND (id = :searchQuery OR username LIKE :searchQueryLike)";
        }
    
        $stmt = $this->conn->prepare($query);
    
        if (!empty($role)) {
            $stmt->bindParam(':role', $role, PDO::PARAM_STR);
        }
    
        if (!empty($searchQuery)) {
            $stmt->bindParam(':searchQuery', $searchQuery, PDO::PARAM_INT);
            $searchLike = "%$searchQuery%";
            $stmt->bindParam(':searchQueryLike', $searchLike, PDO::PARAM_STR);
        }
    
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}

?>
