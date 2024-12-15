<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>S'inscrire - Tuniverse</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>





<form action="process-signup.php" method="POST">
    <label for="fullName">Full Name:</label>
    <input type="text" name="fullName" id="fullName" required><br><br>

    <label for="email">Email:</label>
    <input type="email" name="email" id="email" required><br><br>

    <label for="password">Password:</label>
    <input type="password" name="password" id="password" required><br><br>
    <div class="form-group">
                <label>Ville d'Origine</label>
                <select name="hometown" required>
                    <option value="">Sélectionnez votre ville</option>
                    <option>Tunis</option>
                    <option>Sfax</option>
                    <option>Sousse</option>
                    <option>Kairouan</option>
                    <option>Bizerte</option>
                </select>
            </div>
            <div class="form-group">
                <label>Votre Centre d'Intérêt Principal</label>
                <select name="mainInterest" required>
                    <option value="">Choisissez un intérêt</option>
                    <option>Histoire</option>
                    <option>Culture</option>
                    <option>Artisanat</option>
                    <option>Gastronomie</option>
                    <option>Patrimoine</option>
                </select>
            </div>
            <div class="form-group">
                <label>Photo de Profil</label>
                <input type="file" name="profilePicture" accept="image/*">
            </div>

    <button type="submit">Sign Up</button>
</form>
<script src="signup.js"></script>
</body>
</html>
