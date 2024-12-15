<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";  // Remplacez par votre nom d'utilisateur MySQL
$password = "";      // Remplacez par votre mot de passe MySQL
$dbname = "tuniverse";  // Remplacez par le nom de votre base de données

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $image = $_POST['image'];

    // Insérer l'histoire dans la base de données
    $sql = "INSERT INTO histoires (titre, description, image) VALUES ('$titre', '$description', '$image')";

    if ($conn->query($sql) === TRUE) {
        echo "Histoire ajoutée avec succès.";
    } else {
        echo "Erreur: " . $conn->error;
    }
}

$conn->close();
?>
