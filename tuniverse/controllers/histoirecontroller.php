<?php
// Connexion à la base de données
try {
    $pdo = new PDO('mysql:host=localhost;dbname=tuniverse', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Inclure le contrôleur
require_once 'HistoireController.php';

// Créer une instance du contrôleur
$histoireController = new HistoireController($pdo);

// Vérifier si l'ID est passé dans l'URL
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    // Supprimer l'histoire
    $histoireController->deleteHistoire($id);

    // Rediriger après suppression
    header('Location: liste_histoire.php');
    exit;
} else {
    echo "ID d'histoire manquant.";
}
