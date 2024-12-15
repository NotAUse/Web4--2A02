<?php
session_start(); // Start the session
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Tuniverse</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="profile.php">Profil</a></li>
                    <li><a href="logout.php">Se Déconnecter</a></li>
                <?php else: ?>
                    <li><a href="signup.html">S'inscrire</a></li>
                    <li><a href="login.html">Se Connecter</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
</body>
</html>
