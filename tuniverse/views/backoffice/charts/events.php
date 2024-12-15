<?php
require_once 'cnx.php'; // Include the PDO connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        try {
            $pdo = config::getConnexion();

            if ($_POST['action'] == 'add') {
                $sql = "INSERT INTO events (Nom, description, localisation, category, price, contact_info, Creer) 
                        VALUES (:Nom, :description, :localisation, :category, :price, :contact_info, NOW())";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    ':Nom' => $_POST['Nom'],
                    ':description' => $_POST['description'],
                    ':localisation' => $_POST['localisation'],
                    ':category' => $_POST['category'],
                    ':price' => $_POST['price'],
                    ':contact_info' => $_POST['contact_info'],
                ]);
                echo "Event added successfully";
            }

            if ($_POST['action'] == 'delete') {
                $sql = "DELETE FROM events WHERE id_event = :id_event";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([':id_event' => $_POST['id_event']]);
                echo "Event deleted successfully";
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }else {
      echo "Action not set!";
  }
} else {
  echo "Invalid request method!";
}
?>
