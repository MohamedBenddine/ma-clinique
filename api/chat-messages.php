<?php
header('Content-Type: application/json');
include('../doctor/includes/dbconnection.php');

if (!isset($_GET['appointment_id'])) {
    echo json_encode(['success' => false, 'message' => 'Missing appointment ID']);
    exit();
}

$appointmentId = intval($_GET['appointment_id']);

try {
    $sql = "SELECT * FROM tblchat WHERE AppointmentID = :appointment_id ORDER BY CreatedAt ASC";
    $query = $dbh->prepare($sql);
    $query->bindParam(':appointment_id', $appointmentId, PDO::PARAM_INT);
    $query->execute();
    
    $messages = $query->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode([
        'success' => true,
        'messages' => $messages
    ]);
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Database error: ' . $e->getMessage()
    ]);
}
?>