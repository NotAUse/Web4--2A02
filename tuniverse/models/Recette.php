<?php

class Recette
{
    private ?int $id_recette;
    private ?string $nom;
    private ?string $description;
    private ?string $audio;
    private ?string $categorie;
    private ?string $image;  
    
    
    public function __construct(?int $id_recette = null, ?string $nom = null, ?string $description = null, ?string $audio = null, ?string $categorie = null, ?string $image=null )
    {
        $this->id_recette = $id_recette;
        $this->nom = $nom;
        $this->description = $description;
        $this->audio = $audio;
        $this->categorie = $categorie;
         $this->image = $image;
        
       //$this->pdo = $pdo;
    }
    

   /* public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): void
    {
        $this->image = $image;
    }*/
    



    // Define the method to add a recipe to the database
    public function addRecette($nom, $description, $categorie, $audioFile, $imageFile)
    {
        // Assuming $conn is available here or passed into the function
        global $conn;

        // Insert the new recipe into the database
        try {
            // Move the uploaded audio file to a specific directory (optional)
            if ($audioFile) {
                $audioPath = '../frontoffice/' . $audioFile['name'];
                move_uploaded_file($audioFile['tmp_name'], $audioPath);
            } else {
                $audioPath = null;
            }

           

            if ($imageFile) {
                $imagePath = '../frontoffice/' . $imageFile['name'];
                move_uploaded_file($imageFile['tmp_name'], $imagePath);
            } else {
                $imagePath = null;
            }


            // Prepare the SQL query to insert the recipe
            $sql = "INSERT INTO recette (nom, description, audio, categorie, image ) VALUES (:nom, :description, :audio, :categorie, :image)";
            $stmt = $conn->prepare($sql);

            // Bind the values to the SQL query
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':audio', $audioPath);
            $stmt->bindParam(':categorie', $categorie);
            $stmt->bindParam(':image', $imagePath);

            // Execute the query
            $stmt->execute();

            return "Recipe added successfully!";
        } catch (Exception $e) {
            // Handle any exceptions and return an error message
            return "Error: " . $e->getMessage();
        }
    }
    public function deleteRecette($id_recette)
{
    // Assuming $conn is available here or passed into the function
    global $conn;

    try {
        // Prepare the SQL query to delete the recipe
        $sql = "DELETE FROM recette WHERE id = :id_recette";
        $stmt = $conn->prepare($sql);

        // Bind the recipe ID to the SQL query
        $stmt->bindParam(':id_recette', $id_recette, PDO::PARAM_INT);
        

        // Execute the query
         $stmt->execute();
        

        // Check if a row was affected (recipe deleted)
        if ($stmt->rowCount() > 0) {
            return "Recipe deleted successfully!";
        } else {
            return "No recipe found with the provided ID.";
        }
    } catch (Exception $e) {
        // Handle any exceptions and return an error message
        return "Error: " . $e->getMessage();
    }
}
    
    


}

/*public function updateRecette(int $id_recette, string $nom, string $description, string $categorie, ?string $audio = null, ?string $image=null): bool {
    $sql = "UPDATE recette 
            SET Nom = :nom, description = :description, categorie = :categorie, audio = :audio , image=:image
            WHERE id_recette = :id_recette";

    $stmt = $this->pdo->prepare($sql);
    $stmt->bindParam(':id_recette', $id_recette, PDO::PARAM_INT);
    $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
    $stmt->bindParam(':description', $description, PDO::PARAM_STR);
    $stmt->bindParam(':categorie', $categorie, PDO::PARAM_STR);
    $stmt->bindParam(':audio', $audio, PDO::PARAM_STR);

    return $stmt->execute();
}*/

   


?>