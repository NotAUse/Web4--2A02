<?php
// Connexion à la base de données
require_once('../../config/selima.php');

// Récupérer l'id de l'histoire à supprimer
$id = $_GET['id'];

// Supprimer l'histoire de la base de données
$query = $pdo->prepare("DELETE FROM histoires WHERE id = ?");
$query->execute([$id]);

// Redirection vers la page de liste des histoires après la suppression
header('Location: list_histoire.php');
exit();
