<?php
session_start(); // Démarre la session

// Connexion à la base de données
$dsn = "mysql:host=localhost;dbname=tuniverse";
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

// Vérification si le titre de l'histoire a été envoyé via POST
if (isset($_POST['titre'])) {
    $titre_histoire = $_POST['titre']; // Le titre de l'histoire

    // Récupérer l'ID de l'histoire à partir du titre
    $stmt = $conn->prepare("SELECT id_histoire FROM recits WHERE nom = :titre_histoire");
    $stmt->bindParam(':titre_histoire', $titre_histoire, PDO::PARAM_STR);
    $stmt->execute();

    $histoire = $stmt->fetch();

    if ($histoire) {
        $id_histoire = $histoire['id_histoire']; // L'ID de l'histoire

        // Vérifiez si l'utilisateur est connecté
        if (isset($_SESSION['session_id'])) {
            $session_id = session_id(); // Récupère l'ID de la session actuelle

            // Vérifier si l'histoire est déjà dans les favoris
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

                // Répondre au client avec un message JSON
                echo json_encode(['status' => 'success', 'message' => 'Histoire ajoutée aux favoris']);
                exit();
            } else {
                // Répondre avec un message d'erreur
                echo json_encode(['status' => 'error', 'message' => 'L\'histoire est déjà dans vos favoris']);
                exit();
            }
        } else {
            // Si l'utilisateur n'est pas connecté, renvoyer un message d'erreur
            echo json_encode(['status' => 'error', 'message' => 'Veuillez vous connecter pour ajouter aux favoris']);
            exit();
        }
    } else {
        // Si l'ID de l'histoire n'existe pas, renvoyer un message d'erreur
        echo json_encode(['status' => 'error', 'message' => 'Histoire non trouvée']);
        exit();
    }
} else {
    // Si le titre n'est pas fourni, renvoyer une erreur
    echo json_encode(['status' => 'error', 'message' => 'Titre manquant']);
    exit();
}
?>
