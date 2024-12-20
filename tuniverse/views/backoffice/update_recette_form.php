<?php
require_once "../../Controllers/connexion.php";

// Fetch the recipe's data based on the ID passed in the URL
$id_recette = $_GET['id_recette'] ?? null;

if (!$id_recette) {
    echo "<script>alert('No recipe selected for update.'); window.location.href='Recette_affich.php';</script>";
    exit;
}

try {
    $sql = "SELECT * FROM recette WHERE id_recette = :id_recette";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_recette', $id_recette, PDO::PARAM_INT);
    $stmt->execute();

    $recette = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$recette) {
        echo "<script>alert('Recipe not found.'); window.location.href='Recette_affich.php';</script>";
        exit;
    }
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Recipe</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
    <style>/* General Reset and Body Setup */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f4;
    color: #333;
    line-height: 1.6;
}

/* Container */
.container {
    max-width: 700px;
    margin: 0 auto;
    padding: 20px;
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

/* Heading */
h2 {
    text-align: center;
    color: #17a2b8;
    margin-bottom: 30px;
    font-size: 1.8em;
}

/* Form Elements */
form {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.mb-3 {
    margin-bottom: 1.5rem;
}

.form-label {
    font-weight: bold;
    font-size: 1.1em;
    color: #555;
}

.form-control {
    padding: 10px;
    font-size: 1.1em;
    border: 1px solid #ccc;
    border-radius: 5px;
    width: 100%;
}

.form-control:focus {
    border-color: #17a2b8;
    outline: none;
}

/* Audio File Section */
.form-control[type="file"] {
    padding: 8px;
}

.form-control[type="file"]:focus {
    border-color: #17a2b8;
}

p {
    color: #555;
    font-size: 1em;
    margin-top: 10px;
}

/* Buttons */
button[type="submit"] {
    padding: 12px 25px;
    background-color: #17a2b8;
    color: white;
    font-weight: bold;
    border-radius: 5px;
    border: none;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button[type="submit"]:hover {
    background-color: #138496;
}

/* Responsive Design */
@media screen and (max-width: 768px) {
    .container {
        padding: 15px;
    }

    h2 {
        font-size: 1.5em;
    }

    .form-control {
        font-size: 1em;
    }

    button[type="submit"] {
        padding: 12px 20px;
        font-size: 1em;
    }
}
</style>
</head>
    <body>
    
    <div class="container">
        <h2 class="text-center my-4">Update Recipe</h2>
        
        <form action="../../Controllers/update_recette.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id_recette" value="<?php echo htmlspecialchars($recette['id_recette']); ?>">

            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" value="<?php echo htmlspecialchars($recette['Nom']); ?>">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <input type="text" class="form-control" id="description" name="description" value="<?php echo htmlspecialchars($recette['description']); ?>">
            </div>

            <div class="mb-3">
                <label for="audio" class="form-label">Audio (Optional)</label>
                <input type="file" class="form-control" id="audio" name="audio" accept="audio/*">
                <p>Current File: <?php echo htmlspecialchars($recette['audio']); ?></p>
            </div>

            <div class="mb-3">
                <label for="categorie" class="form-label">Category</label>
                <input type="text" class="form-control" id="categorie" name="categorie" value="<?php echo htmlspecialchars($recette['categorie']); ?>" >
            </div>



            <div class="mb-3">
                <label for="image" class="form-label">Image (Optional)</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*">
                <p>Current Image: <?php echo htmlspecialchars($recette['image']); ?></p>
            </div>


            <button type="submit" class="btn btn-primary">Update Recipe</button>
            <div id="formMessage" class="text-center mt-3"></div>
        </form>
    </div>
   


</body>

</html>


