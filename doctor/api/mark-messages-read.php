<?php
session_start();
header('Content-Type: application/json');
include('../includes/dbconnection.php');

if (strlen($_SESSION['damsid']) == 0) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit();
}

$input = json_decode(file_get_contents('php://input'), true);
$appointmentId = isset($input['appointment_id']) ? intval($input['appointment_id']) : 0;
$readerType = isset($input['reader_type']) ? $input['reader_type'] : '';

if (!$appointmentId || !$readerType) {
    echo json_encode(['success' => false, 'message' => 'Missing parameters']);
    exit();
}

try {
    // Mark messages as read based on reader type
    if ($readerType === 'doctor') {
        // Doctor is reading patient messages
        $sql = "UPDATE tblchat SET IsRead = 1 
                WHERE AppointmentID = :appointment_id 
                AND SenderType = 'patient' 
                AND IsRead = 0";
    } else {
        // Patient is reading doctor messages
        $sql = "UPDATE tblchat SET IsRead = 1 
                WHERE AppointmentID = :appointment_id 
                AND SenderType = 'doctor' 
                AND IsRead = 0";
    }
    
    $query = $dbh->prepare($sql);
    $query->bindParam(':appointment_id', $appointmentId, PDO::PARAM_INT);
    $query->execute();
    
    echo json_encode(['success' => true]);
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Database error: ' . $e->getMessage()
    ]);
}
?>