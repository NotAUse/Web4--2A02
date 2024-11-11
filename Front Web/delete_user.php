<?php
header('Content-Type: application/json');

// Vérifier l'authentification admin
session_start();
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    echo json_encode(['success' => false, 'message' => 'Non autorisé']);
    exit();
}

// Connexion à la base de données
$host = 'localhost';
$dbname = 'tuniverse_db';
$username = 'votre_nom_utilisateur';
$password = 'votre_mot_de_passe';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Supprimer l'utilisateur
    $userId = $_GET['id'];
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
    $result = $stmt->execute([$userId]);

    echo json_encode(['success' => $result]);
} catch(PDOException $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}