<?php
// Include database config
include '../cnx.php';

header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);

if (!empty($data['id_user']) && !empty($data['id_event']) && isset($data['nbr_ticket'])) {
    $id_user = $data['id_user'];
    $id_event = $data['id_event'];
    $date_part = date('Y-m-d');
    $nbr_ticket = $data['nbr_ticket'];
    $payed = $data['payed'];

    try {
        $pdo = config::getConnexion();
        $stmt = $pdo->prepare("
            INSERT INTO participants (id_user, id_event, date_part, nbr_ticket, payed)
            VALUES (:id_user, :id_event, :date_part, :nbr_ticket, :payed)
        ");
        $stmt->execute([
            ':id_user' => $id_user,
            ':id_event' => $id_event,
            ':date_part' => $date_part,
            ':nbr_ticket' => $nbr_ticket,
            ':payed' => $payed
        ]);

        echo json_encode(['success' => true]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid data']);
}
?>
