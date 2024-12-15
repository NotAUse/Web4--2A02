<?php
session_start();

// Vérifier si l'admin est connecté
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header('Location: login_admin.php');
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

    // Récupérer tous les utilisateurs
    $stmt = $pdo->query("SELECT * FROM users ORDER BY created_at DESC");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tableau de Bord Admin - Tuniverse</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
            text-align: left;
        }
        .actions {
            display: flex;
            gap: 10px;
        }
        .search-container {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <h1>Tableau de Bord Administrateur</h1>

    <div class="search-container">
        <input type="text" id="searchInput" placeholder="Rechercher un utilisateur...">
    </div>

    <table id="usersTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Date de Naissance</th>
                <th>Ville</th>
                <th>Date d'Inscription</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo htmlspecialchars($user['id']); ?></td>
                <td><?php echo htmlspecialchars($user['nom']); ?></td>
                <td><?php echo htmlspecialchars($user['prenom']); ?></td>
                <td><?php echo htmlspecialchars($user['email']); ?></td>
                <td><?php echo htmlspecialchars($user['date_naissance']); ?></td>
                <td><?php echo htmlspecialchars($user['ville']); ?></td>
                <td><?php echo htmlspecialchars($user['created_at']); ?></td>
                <td class="actions">
                    <button onclick="viewUserDetails(<?php echo $user['id']; ?>)">Détails</button>
                    <button onclick="deleteUser(<?php echo $user['id']; ?>)">Supprimer</button>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <script>
        // Fonction de recherche en temps réel
        document.getElementById('searchInput').addEventListener('keyup', function() {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll('#usersTable tbody tr');
            
            rows.forEach(row => {
                let text = row.textContent.toLowerCase();
                row.style.display = text.includes(filter) ? '' : 'none';
            });
        });

        function viewUserDetails(userId) {
            // Rediriger vers une page de détails spécifique
            window.location.href = `user_details.php?id=${userId}`;
        }

        function deleteUser(userId) {
            if (confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')) {
                // Requête AJAX pour supprimer l'utilisateur
                fetch(`delete_user.php?id=${userId}`, {
                    method: 'DELETE'
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Supprimer la ligne du tableau
                        document.querySelector(`tr:has(td:first-child:contains('${userId}'))`).remove();
                    } else {
                        alert('Erreur lors de la suppression');
                    }
                });
            }
        }
    </script>
</body>
</html>