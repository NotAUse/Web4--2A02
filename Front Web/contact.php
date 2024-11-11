<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Ici, vous pouvez ajouter le code pour envoyer un email ou enregistrer les données
    echo "Merci, $name. Votre message a été reçu.";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Contact - Tuniverse</title>
</head>
<body>
    <h1>Contactez-nous</h1>
    <form method="post" action="">
        <label for="name">Nom:</label>
        <input type="text" id="name" name="name" required>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        
        <label for="message">Message:</label>
        <textarea id="message" name="message" required></textarea>
        
        <button type="submit">Envoyer</button>
    </form>
</body>
</html>