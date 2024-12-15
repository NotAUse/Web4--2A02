<?php
require_once '../config/config.php'; // Include the PDO connection file

$pdo = config::getConnexion();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    if ($action === 'add') {
        $eventName = $_POST['Nom'];
        $eventLocal = $_POST['localisation'];
        $eventDescription = $_POST['description'];
        $eventCat = $_POST['category'];
        $eventPrice = $_POST['price'];
        $eventContaI = $_POST['contact_info'];

        $stmt = $pdo->prepare("INSERT INTO events (Nom, localisation, description, category, price, contact_info) VALUES (?, ?, ?, ?, ?, ?)");
        

        if ($stmt->execute([$eventName,$eventLocal,$eventDescription,$eventCat,$eventPrice,$eventContaI])) {
            echo json_encode(['status' => 'success', 'message' => 'Event added successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to add event']);
        }
       

    } elseif ($action === 'modify') {
        $eventId = $_POST['id_event'];
        $eventName = $_POST['Nom'];
        $eventLocal = $_POST['localisation'];
        $eventDescription = $_POST['description'];
        $eventCat = $_POST['category'];
        $eventPrice = $_POST['price'];
        $eventContaI = $_POST['contact_info'];
        
        $stmt = $pdo->prepare("UPDATE events SET Nom = ?, localisation = ?, description = ?, category = ?, price = ?, contact_info = ? WHERE id_event = ?");

        if ($stmt->execute([$eventName,$eventLocal,$eventDescription,$eventCat,$eventPrice,$eventContaI,$eventId])) {
            echo json_encode(['status' => 'success', 'message' => 'Event updated successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to update event']);
        }
        

    } elseif ($action === 'delete') {
        $eventId = $_POST['id_event'];

        $stmt = $pdo->prepare("DELETE FROM events WHERE id_event = ?");
        

        if ($stmt->execute([$eventId])) {
            echo json_encode(['status' => 'success', 'message' => 'Event deleted successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to delete event']);
        }
       
    }
    exit;
}

// Fetch all events
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $result = $pdo->query("SELECT * FROM events ORDER BY date ASC");

    $events = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($events);
    exit;
}
?>
    