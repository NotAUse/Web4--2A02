<?php
session_start(); 
// Connexion à la base de données
$dsn = "mysql:host=localhost;dbname=categorie_db";
$username = "root";
$password = "";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

if (!isset($_SESSION['session_id'])) {
    $_SESSION['session_id'] = session_id(); // Utilise l'ID de session PHP
}

try {
    $conn = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    die("Échec de la connexion : " . $e->getMessage());
}

// Récupérer les catégories pour le formulaire de recherche
$stmt = $conn->query("SELECT id, nom FROM categorie");
$categories = $stmt->fetchAll();

// Récupérer le numéro de page et la catégorie sélectionnée
$categorie_id = isset($_POST['categorie']) ? $_POST['categorie'] : '';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 5;  // Nombre d'histoires par page
$offset = ($page - 1) * $limit;  // Calcul de l'offset

// Récupérer les histoires (optionnellement filtrées par catégorie)
if ($categorie_id) {
    $stmt = $conn->prepare("SELECT h.id, h.titre, h.contenu, h.date_creation, c.nom AS categorie 
                            FROM histoires h 
                            JOIN categorie c ON h.categorie_id = c.id 
                            WHERE h.categorie_id = :categorie_id 
                            ORDER BY h.date_creation DESC 
                            LIMIT :limit OFFSET :offset");
    $stmt->bindParam(':categorie_id', $categorie_id, PDO::PARAM_INT);
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
} else {
    $stmt = $conn->prepare("SELECT h.id, h.titre, h.contenu, h.date_creation, c.nom AS categorie 
                            FROM histoires h 
                            JOIN categorie c ON h.categorie_id = c.id 
                            ORDER BY h.date_creation DESC 
                            LIMIT :limit OFFSET :offset");
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
}

$histoires = $stmt->fetchAll();

// Calculer le nombre total d'histoires pour la pagination
$stmt = $conn->query("SELECT COUNT(*) FROM histoires");
$total_histoires = $stmt->fetchColumn();
$total_pages = ceil($total_histoires / $limit);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Histoires</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        /* Global styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            background-color: #f4f4f9;
        }
        
        /* Sidebar styles */
        .sidebar {
            width: 250px;
            background-color: #2c3e50;
            color: white;
            padding: 20px;
            height: 100vh;
            position: fixed;
        }

        .sidebar h2 {
            text-align: center;
            color: #ecf0f1;
            margin-bottom: 20px;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
            font-size: 16px;
        }

        .sidebar a:hover {
            background-color: #34495e;
        }

        /* Main content styles */
        .main-content {
            margin-left: 250px;
            padding: 20px;
            width: calc(100% - 250px);
        }

        .main-content h1 {
            color: #2c3e50;
        }

        /* Table styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }

        /* Pagination styles */
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination a {
            color: #3498db;
            text-decoration: none;
            padding: 8px 16px;
            margin: 0 4px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .pagination a:hover {
            background-color: #2980b9;
            color: white;
        }

        .pagination .active {
            background-color: #3498db;
            color: white;
        }

        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: white;
            margin: 15% auto;
            padding: 20px;
            width: 80%;
            max-width: 600px;
            border-radius: 5px;
        }

        .close {
            color: #aaa;
            font-size: 28px;
            font-weight: bold;
            position: absolute;
            top: 10px;
            right: 25px;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Menu</h2>
        <a href="#" onclick="afficherFormulaireAjout()">Ajouter une histoire</a>
        <a href="list_histoire.php">Liste des histoires</a>
        <a href="list_categorie.php">Liste des catégories</a>
    </div>

    <!-- Main content -->
    <div class="main-content">
        <h1>Gestion des Histoires</h1>

        <!-- Form for filtering by category -->
        <form method="POST" action="list_histoire.php" class="mb-4">
            <label for="categorie" class="form-label">Filtrer par catégorie :</label>
            <select id="categorie" name="categorie" class="form-select">
                <option value="">Toutes les catégories</option>
                <?php foreach ($categories as $categorie): ?>
                    <option value="<?= $categorie['id']; ?>" <?= ($categorie_id == $categorie['id']) ? 'selected' : ''; ?>><?= htmlspecialchars($categorie['nom']); ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit" class="btn btn-primary mt-2">Rechercher</button>
        </form>

        <h2>Liste des Histoires</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titre</th>
                    <th>Contenu</th>
                    <th>Catégorie</th>
                    <th>Date de création</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($histoires as $histoire): ?>
                    <tr>
                        <td><?= $histoire['id']; ?></td>
                        <td><?= htmlspecialchars($histoire['titre']); ?></td>
                        <td><?= htmlspecialchars($histoire['contenu']); ?></td>
                        <td><?= htmlspecialchars($histoire['categorie']); ?></td>
                        <td><?= $histoire['date_creation']; ?></td>
                        <td>
                            <a href="update_histoire.php?id=<?= $histoire['id']; ?>" class="btn btn-secondary btn-sm">Modifier</a>
                            <a href="delete_histoire.php?id=<?= $histoire['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette histoire ?');">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="pagination">
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <a href="?page=<?= $i; ?>" class="<?= ($page == $i) ? 'active' : ''; ?>"><?= $i; ?></a>
            <?php endfor; ?>
        </div>
    </div>

    <!-- Modal pour ajouter une histoire -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="fermerModal()">&times;</span>
            <h2>Ajouter une histoire</h2>
            <form action="add_histoire.php" method="POST">
                <div class="mb-3">
                    <label for="titre" class="form-label">Titre</label>
                    <input type="text" class="form-control" id="titre" name="titre" required>
                </div>
                <div class="mb-3">
                    <label for="contenu" class="form-label">Contenu</label>
                    <textarea class="form-control" id="contenu" name="contenu" rows="4" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="categorie" class="form-label">Catégorie</label>
                    <select class="form-select" id="categorie" name="categorie" required>
                        <option value="">Sélectionnez une catégorie</option>
                        <?php foreach ($categories as $categorie): ?>
                            <option value="<?= $categorie['id']; ?>"><?= htmlspecialchars($categorie['nom']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Ajouter l'histoire</button>
            </form>
        </div>
    </div>

    <script>
        // Fonction pour afficher la modal
        function afficherFormulaireAjout() {
            document.getElementById('myModal').style.display = "block";
        }

        // Fonction pour fermer la modal
        function fermerModal() {
            document.getElementById('myModal').style.display = "none";
        }

        // Fermer la modal si l'utilisateur clique en dehors de celle-ci
        window.onclick = function(event) {
            if (event.target == document.getElementById('myModal')) {
                fermerModal();
            }
        }
    </script>

</body>
</html>
