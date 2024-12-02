<?php
include '../../controller/ExperienceController.php';
include '../../controller/SiteController.php';

$siteController = new SiteController();
$sites = $siteController->listsite();
$error = "";
$experienceController = new ExperienceController();

if (isset($_POST['titre'], $_POST['descriptionE'], $_POST['dateE'] , $_POST['noteE'], $_POST['id_site'])) {
    if (!empty($_POST['titre']) && !empty($_POST['descriptionE']) && !empty($_POST['dateE']) && !empty($_POST['noteE']) && !empty($_POST['id_site']) ){
        $experience = new Experience(
            null,
            $_POST['titre'],
            $_POST['descriptionE'],
            new DateTime($_POST['dateE']),
            $_POST['noteE'],
            $_POST['id_site']
        );
        $experienceController->addexperience($experience);
        header('location:index.php');
        
        //header('Location: experienceList.php?id_site=' . $_POST['id_site']); 
        exit();
    } else {
        $error = "Missing information";
    }
}
    
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Experience culturelle</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="signup-container">
        <h2>Deposer votre experience</h2>
        <form id="addExperienceForm" action="" method="POST">
            <div class="form-group">
                <label for="nom_site">Nom du site:</label>
                <input class="form-control form-control-user" type="text" id="nom_site" name="nom_site" readonly value="<?php echo $_POST['nom_site']; ?>">
            </div>
            <div class="form-group">
                <input class="form-control form-control-user" type="hidden" id="id_site" name="id_site" readonly value="<?php echo $_POST['id_site']; ?>">
            </div>

            <div class="form-group">
                <label>Titre de l'experience:</label>
                <input type="text" name="titre" required>
            </div>
            <div class="form-group">
                <label for="descriptionE">description de l'experience:</label>
                <textarea id="descriptionE" rows="5" name="descriptionE">
                </textarea>
            </div>
            <div class="form-group">
                <label for="dateE">Date:</label>
                <input type="date" name="dateE" required>
            </div>
            <div class="form-group">
                <label for="noteE">Note de l'experience</label>
                <input type="number" step="1" max="5" min="0" name="noteE" placeholder="Note (0-5)" required />
            </div>
            <button type="submit">envoyer l'experience</button>
        </form>
        <?php ?>
    </div>
    <script src="signup.js"></script>
</body>
</html>