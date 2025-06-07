<?php
session_start();
include('doctor/includes/dbconnection.php');
require_once('includes/translations.php');
$currentLang = getCurrentLang();
$isRTL = isRTL();
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
</head>

<body id="top">
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
                                $sql = "SELECT * from tblappointment where AppointmentNumber like '%$sdata%' || Name like '%$sdata%' || MobileNumber like '%$sdata%'";
                                $query = $dbh->prepare($sql);
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
                                                <div class="detail-grid">
                                                    <div class="detail-item">
                                                        <i class="bi bi-person-fill"></i>
                                                        <div>
                                                            <span class="detail-label"><?php echo t('patient_name'); ?></span>
                                                            <span class="detail-value"><?php echo htmlentities($row->Name); ?></span>
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
                                                
                                                <?php if($row->Remark !== null && trim($row->Remark) !== ''): ?>
                                                    <div class="appointment-remark">
                                                        <i class="bi bi-chat-square-text-fill"></i>
                                                        <div>
                                                            <span class="detail-label"><?php echo t('doctors_remark'); ?></span>
                                                            <span class="detail-value">
                                                                <?php 
                                                                $originalRemark = htmlentities($row->Remark);
                                                                $translatedRemark = translateRemark($row->Remark, $currentLang);
                                                                
                                                                // If the translated remark is different from original, show both
                                                                if ($originalRemark !== $translatedRemark && $translatedRemark !== $row->Remark) {
                                                                    echo htmlentities($translatedRemark);
                                                                    // Show original in small text if it was translated
                                                                    if ($currentLang === 'ar' && !Translation::isArabicText($row->Remark)) {
                                                                        echo '<br><small class="text-muted original-remark">(' . $originalRemark . ')</small>';
                                                                    } elseif ($currentLang === 'en' && Translation::isArabicText($row->Remark)) {
                                                                        echo '<br><small class="text-muted original-remark">(' . $originalRemark . ')</small>';
                                                                    }
                                                                } else {
                                                                    echo $originalRemark;
                                                                }
                                                                ?>
                                                            </span>
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
                                <?php endif; ?>
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