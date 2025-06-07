<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include('doctor/includes/dbconnection.php');
require_once('includes/translations.php');

// Add at the top after session_start()
header('Content-Type: text/html; charset=UTF-8');
// Remove this line since you're using PDO, not mysqli:
// mysqli_set_charset($connection, "utf8mb4"); // If using mysqli

$currentLang = getCurrentLang();
$isRTL = isRTL();
$error = '';
$success = '';

// Clear any previous ticket info from session
unset($_SESSION['appointment_data']);

// Changed condition - check for POST method instead of submit button
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get and sanitize form data with proper UTF-8 handling
    $name = trim($_POST['name'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $date = $_POST['date'] ?? '';
    $specialization = $_POST['specialization'] ?? '';
    $doctor = $_POST['doctor'] ?? '';
    $user_type = $_POST['user_type'] ?? '';
    
    // Ensure proper UTF-8 encoding
    $name = mb_convert_encoding($name, 'UTF-8', 'auto');
    
    // Validation
    if (empty($name)) {
        $error = t('name_required');
    } elseif (empty($phone)) {
        $error = t('phone_required');
    } elseif (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = t('email_required');
    } elseif (empty($date)) {
        $error = t('date_required');
    } elseif (empty($specialization)) {
        $error = t('specialization_required');
    } elseif (empty($doctor)) {
        $error = t('doctor_required');
    } elseif (empty($user_type)) {
        $error = t('user_type_required');
    } else {
        // Date validation
        $today = date('Y-m-d');
        if ($date <= $today) {
            $error = t('date_error');
        } else {
            try {
                // Generate appointment number
                $appointmentNumber = mt_rand(100000000, 999999999);
                
                // Insert into database
                $sql = "INSERT INTO tblappointment (AppointmentNumber, Name, MobileNumber, Email, AppointmentDate, Specialization, Doctor, ApplyDate) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, NOW())";
                
                $stmt = $dbh->prepare($sql);
                $result = $stmt->execute([
                    $appointmentNumber,
                    $name,
                    $phone,
                    $email,
                    $date,
                    $specialization,
                    $doctor
                ]);
                
                if ($result) {
                    // Store appointment data in session for ticket
                    $_SESSION['appointment_data'] = [
                        'appointment_number' => $appointmentNumber,
                        'name' => $name,
                        'phone' => $phone,
                        'email' => $email,
                        'date' => $date,
                        'specialization' => $specialization,
                        'doctor' => $doctor
                    ];
                    
                    // Redirect to ticket page
                    header("Location: ticket.php");
                    exit();
                } else {
                    $error = t('something_wrong');
                }
                
            } catch (Exception $e) {
                $error = t('something_wrong') . ': ' . $e->getMessage();
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="<?php echo $currentLang; ?>" <?php echo $isRTL ? 'dir="rtl"' : 'dir="ltr"'; ?>>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo t('book_appointment_title'); ?></title>
    
    <!-- CSS FILES -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <?php if ($isRTL): ?>
        <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&display=swap" rel="stylesheet">
    <?php endif; ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/templatemo-medic-care.css" rel="stylesheet">
    <link href="css/booking.css" rel="stylesheet">
</head>

<body id="top">
    <main>
        <?php include_once('includes/header.php'); ?>

        <!-- Hero Section -->
        <section class="booking-hero-section">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="booking-hero-content">
                            <div class="booking-icon">
                                <i class="bi bi-calendar-check"></i>
                            </div>
                            <h1 class="booking-title"><?php echo t('book_an_appointment'); ?></h1>
                            <p class="booking-subtitle"><?php echo t('schedule_your_visit'); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Booking Form Section -->
        <section class="booking-form-section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-12">
                        
                        <!-- Error Alert -->
                        <?php if (!empty($error)): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                <?php echo $error; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>

                        <!-- Booking Form Card -->
                        <div class="booking-card">
                            <div class="booking-card-header">
                                <h3><?php echo t('appointment_details'); ?></h3>
                                <p><?php echo t('fill_form_carefully'); ?></p>
                            </div>

                            <form method="post" id="bookingForm" accept-charset="UTF-8">
                                <div class="form-grid">
                                    <!-- User Type -->
                                    <div class="form-group">
                                        <label for="user_type" class="form-label">
                                            <?php echo t('who_are_you'); ?> <span class="required">*</span>
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-icon">
                                                <i class="bi bi-person-circle"></i>
                                            </span>
                                            <select name="user_type" id="user_type" class="form-control" required>
                                                <option value=""><?php echo t('select_user_type'); ?></option>
                                                <option value="new" <?php echo (isset($_POST['user_type']) && $_POST['user_type'] == 'new') ? 'selected' : ''; ?>>
                                                    <?php echo t('new_appointment'); ?>
                                                </option>
                                                <option value="returning" <?php echo (isset($_POST['user_type']) && $_POST['user_type'] == 'returning') ? 'selected' : ''; ?>>
                                                    <?php echo t('already_booked'); ?>
                                                </option>
                                                <option value="inquiry" <?php echo (isset($_POST['user_type']) && $_POST['user_type'] == 'inquiry') ? 'selected' : ''; ?>>
                                                    <?php echo t('inquiry'); ?>
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Full Name -->
                                    <div class="form-group">
                                        <label for="name" class="form-label">
                                            <?php echo t('full_name_label'); ?> <span class="required">*</span>
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-icon">
                                                <i class="bi bi-person-fill"></i>
                                            </span>
                                            <input type="text" name="name" id="name" class="form-control" 
                                                placeholder="<?php echo t('full_name_placeholder'); ?>" 
                                                value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8') : ''; ?>" 
                                                accept-charset="UTF-8" required>
                                        </div>
                                    </div>

                                    <!-- Phone -->
                                    <div class="form-group">
                                        <label for="phone" class="form-label">
                                            <?php echo t('phone_label'); ?> <span class="required">*</span>
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-icon">
                                                <i class="bi bi-telephone-fill"></i>
                                            </span>
                                            <input type="tel" name="phone" id="phone" class="form-control" 
                                                placeholder="<?php echo t('phone_placeholder'); ?>" 
                                                value="<?php echo isset($_POST['phone']) ? htmlspecialchars($_POST['phone'], ENT_QUOTES, 'UTF-8') : ''; ?>" required>
                                        </div>
                                    </div>

                                    <!-- Email -->
                                    <div class="form-group">
                                        <label for="email" class="form-label">
                                            <?php echo t('email_label'); ?> <span class="required">*</span>
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-icon">
                                                <i class="bi bi-envelope-fill"></i>
                                            </span>
                                            <input type="email" name="email" id="email" class="form-control" 
                                                placeholder="<?php echo t('email_placeholder'); ?>" 
                                                value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8') : ''; ?>" required>
                                        </div>
                                    </div>

                                    <!-- Date -->
                                    <div class="form-group">
                                        <label for="date" class="form-label">
                                            <?php echo t('date_label'); ?> <span class="required">*</span>
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-icon">
                                                <i class="bi bi-calendar-fill"></i>
                                            </span>
                                            <input type="date" name="date" id="date" class="form-control" 
                                                value="<?php echo isset($_POST['date']) ? $_POST['date'] : ''; ?>" 
                                                min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>" required>
                                        </div>
                                    </div>

                                    <!-- Specialization -->
                                    <div class="form-group">
                                        <label for="specialization" class="form-label">
                                            <?php echo t('specialization_label'); ?> <span class="required">*</span>
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-icon">
                                                <i class="bi bi-heart-pulse-fill"></i>
                                            </span>
                                            <select name="specialization" id="specialization" class="form-control" required onchange="loadDoctors(this.value)">
                                                <option value=""><?php echo t('select_specialization'); ?></option>
                                                <?php
                                                try {
                                                    $sql = "SELECT * FROM tblspecialization ORDER BY Specialization";
                                                    $stmt = $dbh->query($sql);
                                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                        $selected = (isset($_POST['specialization']) && $_POST['specialization'] == $row['ID']) ? 'selected' : '';
                                                        echo '<option value="' . $row['ID'] . '" ' . $selected . '>' . htmlspecialchars($row['Specialization'], ENT_QUOTES, 'UTF-8') . '</option>';
                                                    }
                                                } catch (Exception $e) {
                                                    echo '<option value="">Error loading specializations</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Doctor -->
                                    <div class="form-group">
                                        <label for="doctor" class="form-label">
                                            <?php echo t('doctor_label'); ?> <span class="required">*</span>
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-icon">
                                                <i class="bi bi-person-badge-fill"></i>
                                            </span>
                                            <select name="doctor" id="doctor" class="form-control" required>
                                                <option value=""><?php echo t('select_doctor'); ?></option>
                                                <?php if (isset($_POST['specialization']) && !empty($_POST['specialization'])): ?>
                                                    <?php
                                                    try {
                                                        $sql = "SELECT ID, FullName FROM tbldoctor WHERE Specialization = ? ORDER BY FullName";
                                                        $stmt = $dbh->prepare($sql);
                                                        $stmt->execute([$_POST['specialization']]);
                                                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                            $selected = (isset($_POST['doctor']) && $_POST['doctor'] == $row['ID']) ? 'selected' : '';
                                                            echo '<option value="' . $row['ID'] . '" ' . $selected . '>' . htmlspecialchars($row['FullName'], ENT_QUOTES, 'UTF-8') . '</option>';
                                                        }
                                                    } catch (Exception $e) {
                                                        echo '<option value="">Error loading doctors</option>';
                                                    }
                                                    ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="submit-container">
                                    <button type="submit" class="submit-btn">
                                        <span class="btn-text">
                                            <i class="bi bi-calendar-plus me-2"></i>
                                            <?php echo t('submit_appointment'); ?>
                                        </span>
                                        <span class="btn-loading d-none">
                                            <span class="spinner-border spinner-border-sm me-2"></span>
                                            <?php echo t('processing'); ?>
                                        </span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <img src="images/assets/wave-haikei.svg" alt="mamchatch">
    </main>

    <?php include_once('includes/footer.php'); ?>

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Load doctors based on specialization
        function loadDoctors(specializationId) {
            const doctorSelect = document.getElementById('doctor');
            
            if (!specializationId) {
                doctorSelect.innerHTML = '<option value=""><?php echo t('select_doctor'); ?></option>';
                return;
            }
            
            // Show loading
            doctorSelect.innerHTML = '<option value=""><?php echo t('loading'); ?></option>';
            
            // AJAX request
            fetch('get_doctors.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
                },
                body: 'sp_id=' + encodeURIComponent(specializationId)
            })
            .then(response => response.text())
            .then(data => {
                doctorSelect.innerHTML = data;
            })
            .catch(error => {
                console.error('Error:', error);
                doctorSelect.innerHTML = '<option value=""><?php echo t('error_loading_doctors'); ?></option>';
            });
        }
        
        // Form submission handling
        document.getElementById('bookingForm').addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('.submit-btn');
            const btnText = submitBtn.querySelector('.btn-text');
            const btnLoading = submitBtn.querySelector('.btn-loading');
            
            // Show loading state
            btnText.classList.add('d-none');
            btnLoading.classList.remove('d-none');
            submitBtn.disabled = true;
        });
    </script>
</body>
</html>