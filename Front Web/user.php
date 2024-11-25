<?php
// models/User.php
class User {
    private static $users = [];  // Simulated "database" in memory

    public static function addUser($fullName, $email, $password, $hometown, $mainInterest, $profilePicture) {
        $user = [
            'fullName' => $fullName,
            'email' => $email,
            'password' => $password,  // For simplicity; in a real app, hash passwords
            'hometown' => $hometown,
            'mainInterest' => $mainInterest,
            'profilePicture' => $profilePicture
        ];
        self::$users[] = $user;
        return $user;
    }

    public static function getAllUsers() {
        return self::$users;
    }
}
?>
