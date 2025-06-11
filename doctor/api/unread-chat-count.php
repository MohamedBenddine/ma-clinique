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
    $sql = "SELECT COUNT(*) as unread_count
            FROM tblchat tc
            INNER JOIN tblappointment ta ON tc.AppointmentID = ta.ID
            WHERE ta.Doctor = :doctor_id 
            AND tc.SenderType = 'patient' 
            AND tc.IsRead = 0";
    
    $query = $dbh->prepare($sql);
    $query->bindParam(':doctor_id', $doctorId, PDO::PARAM_INT);
    $query->execute();
    
    $result = $query->fetch(PDO::FETCH_OBJ);
    
    echo json_encode([
        'success' => true,
        'count' => $result->unread_count
    ]);
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Database error: ' . $e->getMessage()
    ]);
}
?>