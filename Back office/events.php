<?php
require_once '../cnx.php'; // Include the PDO connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        try{
            $pdo = config::getConnexion();
            $action = $_POST['action']; // Get the action

            switch ($action) {
                case 'add':
                    // Handle adding a new event
                    if (isset($_POST['clientValidated']) && $_POST['clientValidated'] === 'true') {
                        $sql = "INSERT INTO events (Nom, description, localisation, category, price, contact_info, Creer) 
                        VALUES (:Nom, :description, :localisation, :category, :price, :contact_info, NOW())";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute([
                            ':Nom' => $_POST['Nom'],
                            ':description' => $_POST['description'],
                            ':localisation' => $_POST['localisation'],
                            //':img' => $_FILES['img'],
                            ':category' => $_POST['category'],
                            ':price' => $_POST['price'],
                            ':contact_info' => $_POST['contact_info'],
                        ]);

                        echo "Event successfully added on the server.";
                    } else {
                        echo "Failed to add event. Validation did not pass.";
                    }
                    break;

                case "modify":
                    if (isset($_POST['eventId'])) {
                        $eventId = $_POST['eventId'];
                        $sql = "UPDATE events SET 
                            Nom = :Nom, 
                            description = :description, 
                            localisation = :localisation, 
                            --img = :img,
                            category = :category, 
                            price = :price, 
                            contact_info = :contact_info ";
                        
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([
                    ':Nom' => $_POST['Nom'],
                    ':description' => $_POST['description'],
                    ':localisation' => $_POST['localisation'],
                    //':img' => $_POST['img'],
                    ':category' => $_POST['category'],
                    ':price' => $_POST['price'],
                    ':contact_info' => $_POST['contact_info']
                ]);

                        echo "Event successfully modified.";
                    } else {
                        echo "Failed to modify event. Event ID is missing.";
                    }
                    break;
                case "delete":
                    if (isset($_POST['eventId'])) {
                        $eventId = $_POST['eventId'];
                        $sql = "DELETE FROM events WHERE id_event = :id_event";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute([':id_event' => $_POST['id_event']]);
                        

                        echo "Event successfully deleted.";
                    } else {
                        echo "Failed to delete event. Event ID is missing.";
                    }
                    break;
    
                default:
                    // Handle unknown actions
                    echo "Unknown action: $action";
                    break;
            } } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }else {
          echo "Action not set!";
      }
    } else {
      echo "Invalid request method!";
    }
    
?>
    