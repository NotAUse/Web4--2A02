<?php
session_start(); // Démarre la session

// Connexion à la base de données
$dsn = "mysql:host=localhost;dbname=categorie_db";
$username = "root";
$password = "";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $conn = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    die("Échec de la connexion : " . $e->getMessage());
}

// Style du message avec CSS
echo '<style>
.message {
    padding: 15px;
    border-radius: 5px;
    margin: 20px 0;
    font-size: 16px;
    font-family: Arial, sans-serif;
    text-align: center;
    max-width: 400px;
    margin-left: auto;
    margin-right: auto;
}

.success {
    background-color: #4CAF50; /* Vert */
    color: white;
    border: 1px solid #45a049;
}

.error {
    background-color: #f44336; /* Rouge */
    color: white;
    border: 1px solid #e53935;
}

.info {
    background-color: #2196F3; /* Bleu */
    color: white;
    border: 1px solid #1976D2;
}

.favoris-table {
    width: 100%;
    margin: 20px 0;
    border-collapse: collapse;
}

.favoris-table th, .favoris-table td {
    padding: 10px;
    text-align: left;
    border: 1px solid #ddd;
}

.favoris-table th {
    background-color: #f2f2f2;
}
</style>';

// Affichage de la liste des favoris en incluant le fichier list_favoris.php
include('list_favoris.php'); // Assurez-vous que ce fichier existe et qu'il affiche les favoris correctement

// Vérifier si l'ID de l'histoire est passé
if (isset($_GET['histoire_id'])) { // Changer 'id_histoire' par 'histoire_id'
    $id_histoire = (int)$_GET['histoire_id']; // Assurez-vous que l'ID est un entier

    // Vérifier si l'utilisateur est connecté en vérifiant si session_id existe
    if (isset($_SESSION['session_id'])) {
        $session_id = session_id(); // Récupère l'ID de la session actuelle

        // Vérifier si l'histoire n'est pas déjà dans les favoris
        $stmt = $conn->prepare("SELECT COUNT(*) FROM favoris WHERE id_histoire = :id_histoire AND session_id = :session_id");
        $stmt->bindParam(':id_histoire', $id_histoire, PDO::PARAM_INT);
        $stmt->bindParam(':session_id', $session_id, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->fetchColumn() == 0) {
            // Ajouter l'histoire aux favoris
            $stmt = $conn->prepare("INSERT INTO favoris (session_id, id_histoire) VALUES (:session_id, :id_histoire)");
            $stmt->bindParam(':id_histoire', $id_histoire, PDO::PARAM_INT);
            $stmt->bindParam(':session_id', $session_id, PDO::PARAM_STR);
            $stmt->execute();

            // Affichage du message avec la classe de succès
            echo '<div class="message success">L\'histoire a été ajoutée à vos favoris !</div>';
        } else {
            // Affichage du message avec la classe d'erreur
            echo '<div class="message error">Cette histoire est déjà dans vos favoris.</div>';
        }
    } else {
        // Affichage du message avec la classe d'information
        echo '<div class="message info">Vous devez être connecté pour ajouter aux favoris.</div>';
    }
} else {
    // Affichage du message d'erreur
    echo '<div class="message error">Aucune histoire sélectionnée.</div>';
}
?>
