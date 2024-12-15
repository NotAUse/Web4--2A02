<?php
// Définir les paramètres de la base de données
define('DB_HOST', 'localhost');
define('DB_NAME', 'tuniverse');
define('DB_USER', 'root');
define('DB_PASSWORD', '');

try {
    // Connexion à la base de données avec PDO
    $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Activer les exceptions pour les erreurs PDO
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Mode de récupération par défaut
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4' // Définir l'encodage
    ]);

    // (Log de succès supprimé)
} catch (PDOException $e) {
    // (Log d'erreur supprimé)
    die('Erreur de connexion à la base de données : ' . $e->getMessage());
}
