<?php
require_once '../../view/tcpdf/tcpdf.php'; // Include TCPDF using Composer
require_once "../../Controller/connexion.php";

// Get the recipe ID from the query string
$recette_id = $_GET['recette_id'] ?? null;

if (!$recette_id) {
    die("Erreur : ID de la recette manquant !");
}

try {
    // Fetch recipe details
    $sql_recipe = "SELECT * FROM recette WHERE id_recette = :recette_id";
    $stmt_recipe = $conn->prepare($sql_recipe);
    $stmt_recipe->bindParam(':recette_id', $recette_id, PDO::PARAM_INT);
    $stmt_recipe->execute();
    $recipe = $stmt_recipe->fetch(PDO::FETCH_ASSOC);

    if (!$recipe) {
        die("Erreur : Recette introuvable !");
    }

    // Fetch associated ingredients
    $sql_ingredients = "
        SELECT i.nom AS ingredient_name, ri.quantity 
        FROM recipe_ingredient ri
        JOIN ingredient i ON ri.ingredient_id = i.ID_ingredient
        WHERE ri.recette_id = :recette_id
    ";
    $stmt_ingredients = $conn->prepare($sql_ingredients);
    $stmt_ingredients->bindParam(':recette_id', $recette_id, PDO::PARAM_INT);
    $stmt_ingredients->execute();
    $ingredients = $stmt_ingredients->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}

// Create the PDF
$pdf = new TCPDF();
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Tuniverse');
$pdf->SetTitle($recipe['Nom']);
$pdf->SetSubject('Détails de la recette');

// Add a page
$pdf->AddPage();

// Prepare the HTML content
$html = '
<h1 style="text-align:center;">' . htmlspecialchars($recipe['Nom']) . '</h1>
<p><strong>Description:</strong> ' . htmlspecialchars($recipe['description']) . '</p>
<p><strong>Catégorie:</strong> ' . htmlspecialchars($recipe['categorie']) . '</p>
<h3>Ingrédients :</h3>
<ul>';

foreach ($ingredients as $ingredient) {
    $html .= '<li>' . htmlspecialchars($ingredient['ingredient_name']) . ' - ' . htmlspecialchars($ingredient['quantity']) . '</li>';
}

$html .= '</ul>';

// Include the audio link if available
if (!empty($recipe['audio'])) {
    $html .= '<p><strong>Audio:</strong> <a href="../' . htmlspecialchars($recipe['audio']) . '">Écouter l\'audio</a></p>';
}

// Add content to the PDF
$pdf->writeHTML($html);

// Output the PDF
$fileName = 'recette_' . $recipe['id_recette'] . '.pdf';
$pdf->Output($fileName, 'I'); // Opens the PDF in the browser

