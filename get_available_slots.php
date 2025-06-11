<?php
session_start();
include('doctor/includes/dbconnection.php');

if (isset($_POST['doctor']) && isset($_POST['date'])) {
    $doctor = $_POST['doctor'];
    $date = $_POST['date'];
    
    $allSlots = [
        '09:00:00' => '09:00 AM',
        '09:30:00' => '09:30 AM',
        '10:00:00' => '10:00 AM',
        '10:30:00' => '10:30 AM',
        '11:00:00' => '11:00 AM',
        '11:30:00' => '11:30 AM',
        '12:00:00' => '12:00 PM',
        '14:00:00' => '02:00 PM',
        '14:30:00' => '02:30 PM',
        '15:00:00' => '03:00 PM',
        '15:30:00' => '03:30 PM',
        '16:00:00' => '04:00 PM',
        '16:30:00' => '04:30 PM',
        '17:00:00' => '05:00 PM'
    ];
    
    try {
        // Get booking counts for each time slot
        // Count ALL bookings (pending appointments) regardless of doctor's approval
        $sql = "SELECT AppointmentTime, COUNT(*) as booking_count FROM tblappointment 
                WHERE Doctor = :doctor 
                AND DATE(AppointmentDate) = :date 
                AND AppointmentTime IS NOT NULL
                GROUP BY AppointmentTime";
        
        $query = $dbh->prepare($sql);
        $query->bindParam(':doctor', $doctor, PDO::PARAM_INT);
        $query->bindParam(':date', $date, PDO::PARAM_STR);
        $query->execute();
        
        $bookingCounts = $query->fetchAll(PDO::FETCH_KEY_PAIR);
        
        // Filter out slots that have 3 or more bookings
        $availableSlots = [];
        foreach($allSlots as $time => $display) {
            $count = isset($bookingCounts[$time]) ? intval($bookingCounts[$time]) : 0;
            
            if ($count >= 1) {
                // Don't show slots that are fully booked (3 bookings)
                continue;
            } else if ($count > 0) {
                // Show available slots with booking count
                $availableSlots[$time] = $display . " ({$count}/1 spots taken)";
            } else {
                // Show completely available slots
                $availableSlots[$time] = $display;
            }
        }
        
        header('Content-Type: application/json');
        echo json_encode($availableSlots);
        
    } catch(PDOException $e) {
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
    }
} else {
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Missing required parameters']);
}
?>