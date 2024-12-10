<?php
    require_once '../../controller/SiteController.php';
    require_once '../../controller/ExperienceController.php';
    $siteController = new SiteController();
    $experienceController = new ExperienceController();
    $sites=$siteController->listsite();

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        if(isset($_POST['id_site'])&& isset($_POST['search'])) {
            $id_site=$_POST['id_site'];
            $experiences=$experienceController->showExperienceBySite($id_site); //
        }
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche des expériences culturelles</title>
</head>
<body>
    <h1>Recherche des expériences culturelles par site</h1>

    <!-- Formulaire pour sélectionner un site -->
    <form method="POST" action="">
        <label for="id_site">Sélectionnez un site :</label>
        <select name="id_site" id="id_site" required>
            <option value="">-- Choisir un site --</option>
            <?php foreach ($sites as $site): ?>
                <option value="<?= $site['id_site'] ?>">
                    <?= $site['nom'] ?> (<?= $site['localisation'] ?>)
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit" name="search">Rechercher</button>
    </form>

    <!-- Affichage des expériences -->
    <?php if (!empty($experiences)): ?>
        <h2>Résultats :</h2>
        <ul>
            <?php foreach ($experiences as $experience): ?>
                <li><?= $experience['titre'] ?></li>
                <li><?= $experience['descriptionE'] ?></li>
                <li><?= $experience['dateE'] ?></li>
            <?php endforeach; ?>
        </ul>
    <?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
        <p>Aucune expérience trouvée pour ce site.</p>
    <?php endif; ?>
</body>
</html>