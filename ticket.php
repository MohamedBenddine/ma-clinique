<?php
session_start();
include('doctor/includes/dbconnection.php');
require_once('includes/translations.php');

$currentLang = getCurrentLang();
$isRTL = isRTL();

// Check if appointment data exists in session
if (!isset($_SESSION['appointment_data'])) {
    header("Location: booking.php");
    exit();
}

$appointmentData = $_SESSION['appointment_data'];

// Get additional data (doctor name, specialization name)
try {
    $sql = "SELECT d.FullName as DoctorName, s.Specialization as SpecializationName 
            FROM tbldoctor d 
            JOIN tblspecialization s ON d.Specialization = s.ID 
            WHERE d.ID = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$appointmentData['doctor']]);
    $details = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($details) {
        $appointmentData['doctor_name'] = $details['DoctorName'];
        $appointmentData['specialization_name'] = $details['SpecializationName'];
    }
} catch (Exception $e) {
    $appointmentData['doctor_name'] = 'Unknown';
    $appointmentData['specialization_name'] = 'Unknown';
}

// Get clinic address (you can modify this based on your clinic info storage)
$clinicAddress = "123 Medical Center Street, City, Country"; // Replace with actual address
$googleMapsLink = "https://www.google.com/maps?q=" . urlencode($clinicAddress);

// Clear session data after use
unset($_SESSION['appointment_data']);
?>
<!DOCTYPE html>
<html lang="<?php echo $currentLang; ?>" <?php echo $isRTL ? 'dir="rtl"' : 'dir="ltr"'; ?>>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo t('appointment_ticket_title'); ?></title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <?php if ($isRTL): ?>
        <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&display=swap" rel="stylesheet">
    <?php endif; ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/templatemo-medic-care.css" rel="stylesheet">
    <link href="css/ticket.css" rel="stylesheet">
</head>

<body id="top">
    <main>
        <?php include_once('includes/header.php'); ?>

        <section class="ticket-section">
            <div class="container">
                <div class="ticket-card">
                    <!-- Header -->
                    <div class="ticket-header">
                        <i class="bi bi-check-circle-fill ticket-success-icon"></i>
                        <h1><?php echo t('appointment_confirmed_title'); ?></h1>
                        <p><?php echo t('appointment_confirmed_subtitle'); ?></p>
                    </div>

                    <!-- Body -->
                    <div class="ticket-body">
                        <!-- Appointment Number -->
                        <div class="appointment-number-section">
                            <h2><?php echo t('your_appointment_number_is'); ?></h2>
                            <div class="appointment-number"><?php echo htmlspecialchars($appointmentData['appointment_number']); ?></div>
                        </div>

                        <!-- Details Grid -->
                        <div class="ticket-details-grid">
                            <!-- Patient Details -->
                            <div class="ticket-detail-item">
                                <h4><?php echo t('patient_details'); ?></h4>
                                <div class="detail-row">
                                    <strong><?php echo t('full_name_label'); ?>:</strong>
                                    <span><?php echo htmlspecialchars($appointmentData['name']); ?></span>
                                </div>
                                <div class="detail-row">
                                    <strong><?php echo t('phone_label'); ?>:</strong>
                                    <span><?php echo htmlspecialchars($appointmentData['phone']); ?></span>
                                </div>
                                <div class="detail-row">
                                    <strong><?php echo t('email_label'); ?>:</strong>
                                    <span><?php echo htmlspecialchars($appointmentData['email']); ?></span>
                                </div>
                            </div>

                            <!-- Appointment Details -->
                            <div class="ticket-detail-item">
                                <h4><?php echo t('appointment_details'); ?></h4>
                                <div class="detail-row">
                                    <strong><?php echo t('date_label'); ?>:</strong>
                                    <span><?php echo date('d/m/Y', strtotime($appointmentData['date'])); ?></span>
                                </div>
                                <div class="detail-row">
                                    <strong><?php echo t('specialization_label'); ?>:</strong>
                                    <span><?php echo htmlspecialchars($appointmentData['specialization_name']); ?></span>
                                </div>
                                <div class="detail-row">
                                    <strong><?php echo t('doctor_label'); ?>:</strong>
                                    <span><?php echo htmlspecialchars($appointmentData['doctor_name']); ?></span>
                                </div>
                            </div>
                        </div>

                        <!-- Clinic Location -->
                        <div class="clinic-location-section">
                            <h4><?php echo t('clinic_location'); ?></h4>
                            <div class="clinic-address-web">
                                <a href="<?php echo $googleMapsLink; ?>" target="_blank" rel="noopener noreferrer">
                                    <i class="bi bi-geo-alt-fill"></i>
                                    <?php echo $clinicAddress; ?>
                                </a>
                            </div>
                            <div class="clinic-address-print">
                                <i class="bi bi-geo-alt-fill"></i>
                                <?php echo $clinicAddress; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="ticket-footer">
                        <button onclick="window.print()" class="btn btn-primary print-button">
                            <i class="bi bi-printer-fill"></i> <?php echo t('print_ticket'); ?>
                        </button>
                        <a href="index.php" class="btn btn-secondary back-home-button">
                            <i class="bi bi-house-fill"></i> <?php echo t('back_to_home'); ?>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <img src="images/assets/wave-haikei.svg" alt="mamchatch">
    </main>

    <?php include_once('includes/footer.php'); ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>