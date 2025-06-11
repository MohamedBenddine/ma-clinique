<?php
session_start();
header('Content-Type: application/json');
include('../includes/dbconnection.php');

if (strlen($_SESSION['damsid']) == 0) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit();
}

$doctorId = $_SESSION['damsid'];

try {
    $sql = "SELECT DISTINCT
        ta.ID as AppointmentID,
        ta.AppointmentNumber,
        ta.Name as PatientName,
        ta.AppointmentDate,
        (SELECT Message FROM tblchat tc WHERE tc.AppointmentID = ta.ID ORDER BY tc.CreatedAt DESC LIMIT 1) as LastMessage,
        (SELECT CreatedAt FROM tblchat tc WHERE tc.AppointmentID = ta.ID ORDER BY tc.CreatedAt DESC LIMIT 1) as LastMessageTime,
        (SELECT COUNT(*) FROM tblchat tc WHERE tc.AppointmentID = ta.ID AND tc.SenderType = 'patient' AND tc.IsRead = 0) as UnreadCount
    FROM tblappointment ta
    WHERE ta.Doctor = :doctor_id
    AND EXISTS (SELECT 1 FROM tblchat tc WHERE tc.AppointmentID = ta.ID)
    ORDER BY LastMessageTime DESC";
    
    $query = $dbh->prepare($sql);
    $query->bindParam(':doctor_id', $doctorId, PDO::PARAM_INT);
    $query->execute();
    
    $chats = $query->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode([
        'success' => true,
        'chats' => $chats
    ]);
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Database error: ' . $e->getMessage()
    ]);
}
?>