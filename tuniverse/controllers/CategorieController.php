<?php
// Connexion à la base de données
require_once('../config/config.php');

// Récupérer toutes les catégories
$query = $pdo->query("SELECT * FROM categorie");
$categories = $query->fetchAll();

// Gérer les catégories (ajout, modification, suppression)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'ajouter') {
            // Ajouter une nouvelle catégorie
            $nom = $_POST['nom'];
            $query = $pdo->prepare("INSERT INTO categorie (nom) VALUES (?)");
            $query->execute([$nom]);
        }
    }
}

// Récupérer la liste des catégories
$query = $pdo->query("SELECT * FROM categorie");
$categories = $query->fetchAll();
?>

<!-- Formulaire d'ajout de catégorie -->
<h1>Gérer les Catégories</h1>
<form method="POST" action="">
    <label for="nom">Nom de la catégorie</label>
    <input type="text" id="nom" name="nom" required>
    <button type="submit" name="action" value="ajouter">Ajouter</button>
</form>

<h2>Liste des Catégories</h2>
<ul>
    <?php foreach ($categories as $categorie): ?>
        <li><?php echo htmlspecialchars($categorie['nom']); ?></li>
    <?php endforeach; ?>
</ul>

