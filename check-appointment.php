<?php
session_start();
include('doctor/includes/dbconnection.php');
require_once('includes/translations.php');
$currentLang = getCurrentLang();
$isRTL = isRTL();

// Add at the top
header('Content-Type: text/html; charset=UTF-8');
?>
<!doctype html>
<html lang="<?php echo $currentLang; ?>" <?php echo $isRTL ? 'dir="rtl"' : 'dir="ltr"'; ?>>

<head>
    <title><?php echo t('check_appointment_title'); ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS FILES -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <?php if ($isRTL): ?>
        <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&display=swap" rel="stylesheet">
    <?php endif; ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link href="css/templatemo-medic-care.css" rel="stylesheet">
    <link rel="stylesheet" href="css/check-appointment.css">
    <style>
        .checkhh {
            background : #f8f9fa;
        }
    </style>
</head>

<body id="top" class="checkhh">
    <main>
        <?php include_once('includes/header.php'); ?>

        <!-- Hero Section -->
        <section class="hero-section">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-8 mx-auto text-center">
                        <div class="hero-content">
                            <i class="bi bi-search hero-icon"></i>
                            <h1 class="hero-title"><?php echo t('check_your_appointment'); ?></h1>
                            <p class="hero-subtitle"><?php echo t('track_appointment_status'); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Search Section -->
        <section class="search-section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-12">
                        <div class="search-card">
                            <div class="search-card-header">
                                <h3><?php echo t('search_appointment'); ?></h3>
                                <p><?php echo t('search_appointment_subtitle'); ?></p>
                            </div>
                            
                            <form role="form" method="post" class="search-form">
                                <div class="search-input-group">
                                    <div class="input-icon">
                                        <i class="bi bi-search"></i>
                                        <input id="searchdata" type="text" name="searchdata" required="true"
                                            class="form-control search-input" 
                                            placeholder="<?php echo t('search_placeholder'); ?>"
                                            value="<?php echo isset($_POST['searchdata']) ? htmlspecialchars($_POST['searchdata']) : ''; ?>">
                                    </div>
                                    <button type="submit" class="btn search-btn" name="search">
                                        <i class="bi bi-search me-2"></i>
                                        <?php echo t('search'); ?>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Results Section -->
        <?php if (isset($_POST['search'])): ?>
            <?php $sdata = $_POST['searchdata']; ?>
            <section class="results-section">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="results-header">
                                <h4><i class="bi bi-list-check me-2"></i><?php echo t('search_results_for'); ?> "<span class="search-term"><?php echo htmlspecialchars($sdata); ?></span>"</h4>
                            </div>

                            <div class="results-card">
                                <?php
                                try {
                                    // Fixed SQL query with unique parameter names
                                    $sql = "SELECT 
                                        ta.*,
                                        td.FullName as DoctorName,
                                        td.MobileNumber as DoctorPhone,
                                        td.Email as DoctorEmail,
                                        ts.Specialization as SpecializationName
                                    FROM tblappointment ta
                                    LEFT JOIN tbldoctor td ON ta.Doctor = td.ID
                                    LEFT JOIN tblspecialization ts ON ta.Specialization = ts.ID
                                    WHERE ta.AppointmentNumber LIKE :search1
                                       OR ta.Name LIKE :search2
                                       OR ta.MobileNumber LIKE :search3
                                       OR td.FullName LIKE :search4
                                       OR ts.Specialization LIKE :search5";
                                    
                                    $query = $dbh->prepare($sql);
                                    $searchParam = '%' . $sdata . '%';
                                    
                                    // Bind each parameter with unique names
                                    $query->bindParam(':search1', $searchParam, PDO::PARAM_STR);
                                    $query->bindParam(':search2', $searchParam, PDO::PARAM_STR);
                                    $query->bindParam(':search3', $searchParam, PDO::PARAM_STR);
                                    $query->bindParam(':search4', $searchParam, PDO::PARAM_STR);
                                    $query->bindParam(':search5', $searchParam, PDO::PARAM_STR);
                                    
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);

                                    if ($query->rowCount() > 0):
                                        $cnt = 1;
                                        foreach ($results as $row): ?>
                                            <div class="appointment-item">
                                                <div class="appointment-header">
                                                    <div class="appointment-number">
                                                        <i class="bi bi-hash"></i>
                                                        <span><?php echo htmlentities($row->AppointmentNumber); ?></span>
                                                    </div>
                                                    <div class="appointment-status">
                                                        <?php 
                                                        $status = ($row->Status !== null) ? $row->Status : "Pending";
                                                        $statusClass = '';
                                                        $statusIcon = '';
                                                        $statusText = '';
                                                        
                                                        switch(strtolower($status)) {
                                                            case 'approved':
                                                                $statusClass = 'status-approved';
                                                                $statusIcon = 'bi-check-circle-fill';
                                                                $statusText = t('status_approved');
                                                                break;
                                                            case 'cancelled':
                                                            case 'rejected':
                                                                $statusClass = 'status-cancelled';
                                                                $statusIcon = 'bi-x-circle-fill';
                                                                $statusText = strtolower($status) === 'cancelled' ? t('status_cancelled') : t('status_rejected');
                                                                break;
                                                            case 'completed':
                                                                $statusClass = 'status-approved';
                                                                $statusIcon = 'bi-check-circle-fill';
                                                                $statusText = t('status_completed');
                                                                break;
                                                            default:
                                                                $statusClass = 'status-pending';
                                                                $statusIcon = 'bi-clock-fill';
                                                                $statusText = t('status_pending');
                                                        }
                                                        ?>
                                                        <span class="status-badge <?php echo $statusClass; ?>">
                                                            <i class="bi <?php echo $statusIcon; ?>"></i>
                                                            <?php echo $statusText; ?>
                                                        </span>
                                                    </div>
                                                </div>
                                                
                                                <div class="appointment-details">
                                                    <!-- Patient Information -->
                                                    <div class="detail-section">
                                                        <h5 class="section-title">
                                                            <i class="bi bi-person-circle"></i>
                                                            <?php echo t('patient_information'); ?>
                                                        </h5>
                                                        <div class="detail-grid">
                                                            <div class="detail-item">
                                                                <i class="bi bi-person-fill"></i>
                                                                <div>
                                                                    <span class="detail-label"><?php echo t('patient_name'); ?></span>
                                                                    <span class="detail-value"><?php echo htmlspecialchars($row->Name, ENT_QUOTES, 'UTF-8'); ?></span>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="detail-item">
                                                                <i class="bi bi-telephone-fill"></i>
                                                                <div>
                                                                    <span class="detail-label"><?php echo t('mobile_number'); ?></span>
                                                                    <span class="detail-value"><?php echo htmlentities($row->MobileNumber); ?></span>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="detail-item">
                                                                <i class="bi bi-envelope-fill"></i>
                                                                <div>
                                                                    <span class="detail-label"><?php echo t('email_address'); ?></span>
                                                                    <span class="detail-value"><?php echo htmlentities($row->Email); ?></span>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="detail-item">
                                                                <i class="bi bi-calendar-fill"></i>
                                                                <div>
                                                                    <span class="detail-label"><?php echo t('appointment_date'); ?></span>
                                                                    <span class="detail-value"><?php echo date('F j, Y', strtotime($row->AppointmentDate)); ?></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Doctor Information -->
                                                    <div class="detail-section">
                                                        <h5 class="section-title">
                                                            <i class="bi bi-person-badge"></i>
                                                            <?php echo t('doctor_information'); ?>
                                                        </h5>
                                                        <div class="detail-grid">
                                                            <div class="detail-item">
                                                                <i class="bi bi-person-badge-fill"></i>
                                                                <div>
                                                                    <span class="detail-label"><?php echo t('doctor_name'); ?></span>
                                                                    <span class="detail-value"><?php echo htmlspecialchars($row->DoctorName ?? 'N/A', ENT_QUOTES, 'UTF-8'); ?></span>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="detail-item">
                                                                <i class="bi bi-heart-pulse-fill"></i>
                                                                <div>
                                                                    <span class="detail-label"><?php echo t('specialization'); ?></span>
                                                                    <span class="detail-value"><?php echo htmlspecialchars($row->SpecializationName ?? 'N/A', ENT_QUOTES, 'UTF-8'); ?></span>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="detail-item">
                                                                <i class="bi bi-telephone-fill"></i>
                                                                <div>
                                                                    <span class="detail-label"><?php echo t('doctor_phone'); ?></span>
                                                                    <span class="detail-value"><?php echo htmlentities($row->DoctorPhone ?? 'N/A'); ?></span>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="detail-item">
                                                                <i class="bi bi-envelope-fill"></i>
                                                                <div>
                                                                    <span class="detail-label"><?php echo t('doctor_email'); ?></span>
                                                                    <span class="detail-value"><?php echo htmlentities($row->DoctorEmail ?? 'N/A'); ?></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Clinic Location -->
                                                    <div class="detail-section">
                                                        <h5 class="section-title">
                                                            <i class="bi bi-geo-alt"></i>
                                                            <?php echo t('clinic_location'); ?>
                                                        </h5>
                                                        <div class="clinic-location-card">
                                                            <div class="location-info">
                                                                <i class="bi bi-building-fill"></i>
                                                                <div>
                                                                    <span class="detail-label"><?php echo t('clinic_name'); ?></span>
                                                                    <span class="detail-value">Ma Clinique</span>
                                                                </div>
                                                            </div>
                                                            <div class="location-info">
                                                                <i class="bi bi-geo-alt-fill"></i>
                                                                <div>
                                                                    <span class="detail-label"><?php echo t('address'); ?></span>
                                                                    <span class="detail-value">Aflou, Laghouat, Algeria</span>
                                                                </div>
                                                            </div>
                                                            <div class="location-info">
                                                                <i class="bi bi-telephone-fill"></i>
                                                                <div>
                                                                    <span class="detail-label"><?php echo t('clinic_phone'); ?></span>
                                                                    <span class="detail-value">05 62 54 28 39</span>
                                                                </div>
                                                            </div>
                                                            <div class="location-actions">
                                                                <a href="https://www.google.com/maps/search/Aflou,+Laghouat,+Algeria" target="_blank" class="location-btn">
                                                                    <i class="bi bi-map"></i>
                                                                    <?php echo t('view_on_map'); ?>
                                                                </a>
                                                                <a href="tel:0562542839" class="location-btn">
                                                                    <i class="bi bi-telephone"></i>
                                                                    <?php echo t('call_clinic'); ?>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                
                                                    <?php if($row->Remark !== null && trim($row->Remark) !== ''): ?>
                                                        <div class="detail-section">
                                                            <h5 class="section-title">
                                                                <i class="bi bi-chat-square-text"></i>
                                                                <?php echo t('doctors_remark'); ?>
                                                            </h5>
                                                            <div class="appointment-remark">
                                                                <i class="bi bi-chat-square-text-fill"></i>
                                                                <div>
                                                                    <span class="detail-value">
                                                                        <?php echo htmlentities($row->Remark); ?>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        <?php 
                                        $cnt++;
                                        endforeach;
                                    else: ?>
                                        <div class="no-results">
                                            <i class="bi bi-search-no-results"></i>
                                            <h5><?php echo t('no_appointments_found'); ?></h5>
                                            <p><?php echo t('no_records_found'); ?> "<strong><?php echo htmlspecialchars($sdata); ?></strong>"</p>
                                            <p class="text-muted"><?php echo t('check_search_term'); ?></p>
                                        </div>
                                    <?php endif;
                                    
                                } catch (PDOException $e) {
                                    echo '<div class="alert alert-danger">Database error: ' . htmlentities($e->getMessage()) . '</div>';
                                } catch (Exception $e) {
                                    echo '<div class="alert alert-danger">Error: ' . htmlentities($e->getMessage()) . '</div>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>
        <img src="images/assets/wave-haikei.svg" alt="mamchatch">
    </main>

    <?php include_once('includes/footer.php'); ?>

    <!-- JAVASCRIPT FILES -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/custom.js"></script>
</body>

</html>