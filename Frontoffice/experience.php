<?php
include '../../controller/ExperienceController.php';

$experienceController = new ExperienceController();

if (isset($_GET['id_exp'])) {
    $id_exp = $_GET['id_exp'];

    $experienceController->incrementViews($id_exp);
    $experience = $experienceController->showexperience($id_exp);

    if ($experience) {
        ?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <title>Détails de l'Expérience</title>
            <link rel="stylesheet" href="style.css">
        </head>
        <body>
            <div class="signup-container" style="text-align: center;">
                <h2>Détails de l'Expérience</h2>
                <p><strong>Titre:</strong> <?= $experience['titre']; ?></p>
                <p><strong>Description:</strong> <?= $experience['descriptionE']; ?></p>
                <p><strong>Date:</strong> <?= $experience['dateE']; ?></p>
                <p><strong>Note:</strong> <?= $experience['noteE']; ?>/5</p>
                <button id="playText" class="btn btn-secondary" style="margin-top: 20px; width:auto;">Écouter l'expérience</button>

                <div class="retour">
                    <form action="viewexperience.php" method="GET">
                        <input type="hidden" name="id_site" value="<?= htmlspecialchars($_GET['id_site'] ?? '') ?>">
                        <button type="submit" class="btn btn-primary" style="padding: 10px 10px;">Retour</button>
                    </form>
                </div>
    
            </div>
            <script>
                document.getElementById('playText').addEventListener('click', function() {
                    const titre = "Titre : <?= addslashes($experience['titre']); ?>.";
                    const description = "Description : <?= addslashes($experience['descriptionE']); ?>.";
                    const date = "Date : <?= addslashes($experience['dateE']); ?>.";
                    const note = "Note : <?= addslashes($experience['noteE']); ?> sur 5.";
                    const text = `${titre} ${description} ${date} ${note}`;
                    const utterance = new SpeechSynthesisUtterance(text);
                    utterance.lang = 'fr-FR';
                    speechSynthesis.speak(utterance);
                });
            </script>
            <script src="script.js"></script>

            <style>
            .signup-container {
                position: relative; 
                padding: 20px;
                border: 1px solid #ddd;
                border-radius: 8px;
                max-width: 600px;
                margin: 40px auto;
            }

            .retour {
                position: absolute; 
                top: 10px; 
                left: 10px; 
            }
            #playText {
                background-color: #4CAF50;
                color: white;
                border: none;
                padding: 10px 20px;
                text-align: center;
                font-size: 16px;
                cursor: pointer;
                border-radius: 5px;
            }

            #playText:hover {
                background-color: #45a049;
            }
            </style>
        </body>
        </html>
        <?php
    } else {
        echo "Expérience non trouvée.";
    }
} else {
    echo "Aucun ID d'expérience fourni.";
}
?>
