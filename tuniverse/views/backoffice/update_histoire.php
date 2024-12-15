<?php
// Connexion à la base de données
require_once('../../config/selima.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données du formulaire
    $id = $_POST['id'];
    $titre = $_POST['titre'];
    $contenu = $_POST['contenu'];
    $categorie_id = $_POST['categorie_id'];

    // Mise à jour de l'histoire dans la base de données
    $query = $pdo->prepare("UPDATE histoires SET titre = ?, contenu = ?, categorie_id = ? WHERE id = ?");
    $query->execute([$titre, $contenu, $categorie_id, $id]);

    // Redirection vers la page de liste des histoires après la mise à jour
    header('Location: list_histoire.php');
    exit();
}

// Récupérer l'id de l'histoire à modifier
$id = $_GET['id'];

// Récupérer les informations de l'histoire à modifier
$query = $pdo->prepare("SELECT * FROM histoires WHERE id = ?");
$query->execute([$id]);
$histoire = $query->fetch();

if (!$histoire) {
    // Si l'histoire n'existe pas, rediriger vers la liste des histoires
    header('Location: list_histoire.php');
    exit();
}
?>

<!-- Formulaire de mise à jour de l'histoire -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier l'Histoire</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 60%;
            margin: 0 auto;
            background-color: #fff;
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin-top: 50px;
        }
        h1 {
            color: #5A5A5A;
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            font-size: 16px;
            color: #555;
            margin-bottom: 8px;
            display: block;
        }
        input[type="text"], textarea, select {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }
        textarea {
            resize: vertical;
            height: 150px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 18px;
        }
        button:hover {
            background-color: #45a049;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .error {
            color: red;
            font-size: 14px;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Modifier l'Histoire</h1>
        <form method="POST" action="">
            <input type="hidden" name="id" value="<?php echo $histoire['id']; ?>">

            <div class="form-group">
                <label for="titre">Titre</label>
                <input type="text" id="titre" name="titre" value="<?php echo htmlspecialchars($histoire['titre']); ?>" required>
            </div>

            <div class="form-group">
                <label for="contenu">Contenu</label>
                <textarea id="contenu" name="contenu" required><?php echo htmlspecialchars($histoire['contenu']); ?></textarea>
            </div>

            <div class="form-group">
                <label for="categorie_id">Catégorie</label>
                <select id="categorie_id" name="categorie_id" required>
                    <?php
                    // Récupérer les catégories pour le formulaire
                    $categories = $pdo->query("SELECT id, nom FROM categorie")->fetchAll();
                    foreach ($categories as $categorie) {
                        $selected = ($categorie['id'] == $histoire['categorie_id']) ? 'selected' : '';
                        echo "<option value='{$categorie['id']}' $selected>{$categorie['nom']}</option>";
                    }
                    ?>
                </select>
            </div>

            <button type="submit">Mettre à jour</button>
        </form>
    </div>
</body>
</html>
