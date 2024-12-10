<?php
include '../../controller/ExperienceController.php';

$experienceController = new ExperienceController();

if (isset($_GET['id_site'])) {
    $id_site = $_GET['id_site'];
    $experienceController->incrementViews($id_site);
    $experiences = $experienceController->showExperienceBySite($id_site);
} else {
    echo "Aucun site sélectionné.";
    exit();
}
$experienceParPage = 6;
$pageActuelle = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$startIndex = ($pageActuelle - 1) * $experienceParPage;
$totalExperience = count($experiences); 
$totalPages = ceil($totalExperience / $experienceParPage);
$experiencesAffichees = array_slice($experiences, $startIndex, $experienceParPage);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Experiences Culturelles</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main>
        <section id="meilleures-places">
            <div class="header-container">
                <h2>Les Experiences Culturelles</h2>
            </div>
            <div class="places-container" id="placesContainer">
                <?php if(empty($experiences)): ?>
                    <div class="no-experience">
                        <p>Aucune expérience disponible pour ce site pour l'instant.</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($experiencesAffichees as $experience): ?>
                        <div class="place">
                            <h1>Titre: <?= $experience['titre']; ?></h1>
                            <p><strong>Description: </strong><?= $experience['descriptionE']; ?></p>
                            <p><strong>Date: </strong> <?= $experience['dateE']; ?></p>
                            <p><strong>Note: </strong> <?= $experience['noteE']; ?>/5</p>
                            <p><strong>Nombre de vues: </strong> <?= $experience['views']; ?></p>
                            <form method="GET" action="experience.php" style="display: inline;" >
                                <input type="hidden" value="<?php echo $experience['id_exp']; ?>" name="id_exp">
                                <input type="hidden" name="id_site" value="<?= htmlspecialchars($id_site) ?>">
                            <button type="submit" name="experience" class="btn btn-primary">afficher</button>
                        </form>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <div class="pagination">
                <?php if ($pageActuelle > 1): ?>
                    <a href="?id_site=<?= $id_site ?>&page=<?= $pageActuelle - 1; ?>">Précédent</a>
                <?php endif; ?>
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <a href="?id_site=<?= $id_site ?>&page=<?= $i; ?>" 
                       class="<?= ($i === $pageActuelle) ? 'active' : ''; ?>">
                        <?= $i; ?>
                    </a>
                <?php endfor; ?>
                <?php if ($pageActuelle < $totalPages): ?>
                    <a href="?id_site=<?= $id_site ?>&page=<?= $pageActuelle + 1; ?>">Suivant</a>
                <?php endif; ?>
            </div>
            <div class="retour">
                <form action="index.php" style="display: inline-block; margin: 0; padding: 0;">
                    <button type="submit" class="btn btn-primary" style="padding: 5px 10px;">Retour</button>
                </form>
            </div>
        </section>
    </main>
    <style>
        .header-container {
            display: flex;
            justify-content: center; 
            align-items: center; 
            height: 100px; 
        }

        
        .no-experience {
            text-align: center;
            color: #555;
            font-size: 1.2em;
            padding: 20px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 80%;
            margin: 20px 0;
        }

        .retour {
            display: flex;
            justify-content: center;
            margin: 20px 0;
        }


        .place h1 {
            font-size: 1.5em;
            margin-bottom: 10px;
        }
        .pagination {
        display: flex;
        justify-content: center;
        margin: 20px 0;
        }

        .pagination a {
            margin: 0 5px;
            padding: 8px 16px;
            text-decoration: none;
            background-color: #e0f7e0;  
            color: #2c6b2f;  
            border: 1px solid #b3e0b3;  
            border-radius: 5px;
        }

        .pagination a.active {
            background-color: #28a745;  
            color: #fff;  
            border: 1px solid #218838;  
        }

        .pagination a:hover {
            background-color: #a1e6a1;  
        }
    </style>
</body>
</html>