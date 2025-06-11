<?php
header('Content-Type: application/json');
include('../doctor/includes/dbconnection.php');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit();
}

$appointmentId = isset($_POST['appointment_id']) ? intval($_POST['appointment_id']) : 0;
$message = isset($_POST['message']) ? trim($_POST['message']) : '';
$senderType = isset($_POST['sender_type']) ? $_POST['sender_type'] : '';
$senderName = isset($_POST['sender_name']) ? $_POST['sender_name'] : '';

if (!$appointmentId || !$message || !$senderType || !$senderName) {
    echo json_encode(['success' => false, 'message' => 'Missing required fields']);
    exit();
}

if (strlen($message) > 1000) {
    echo json_encode(['success' => false, 'message' => 'Message too long']);
    exit();
}

try {
    $sql = "INSERT INTO tblchat (AppointmentID, SenderType, SenderName, Message) VALUES (:appointment_id, :sender_type, :sender_name, :message)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':appointment_id', $appointmentId, PDO::PARAM_INT);
    $query->bindParam(':sender_type', $senderType, PDO::PARAM_STR);
    $query->bindParam(':sender_name', $senderName, PDO::PARAM_STR);
    $query->bindParam(':message', $message, PDO::PARAM_STR);
    
    if ($query->execute()) {
        echo json_encode(['success' => true, 'message' => 'Message sent successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to send message']);
    }
    
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
?>