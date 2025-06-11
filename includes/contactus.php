<?php
require_once 'translations.php';

// Include PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// require_once '../vendor/autoload.php'; // If using Composer
// OR if downloaded manual/PHPMailerly:
require_once 'PHPMailer/PHPMailer/src/Exception.php';
require_once 'PHPMailer/PHPMailer/src/PHPMailer.php';
require_once 'PHPMailer/PHPMailer/src/SMTP.php';

$messageSent = false;
$errorMessage = '';

// Handle form submission
if ($_POST) {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $subject = $_POST['subject'] ?? '';
    $message = $_POST['message'] ?? '';
    
    // Basic validation
    if (!empty($name) && !empty($email) && !empty($message)) {
        
        $mail = new PHPMailer(true);
        
        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'myclinique84@gmail.com'; // Your Gmail address
            $mail->Password   = 'muze rjpr zvhn wcbc';           // Your Gmail App Password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;
            $mail->CharSet    = 'UTF-8';

            // Recipients
            $mail->setFrom('myclinique84@gmail.com', 'Ma Clinique Contact Form');
            $mail->addAddress('bkrmld06@gmail.com', 'Clinic Admin');
            $mail->addAddress('beneddinemohamed11@gmail.com', 'Clinic Owner');
            $mail->addReplyTo($email, $name);

            // Content
            $mail->isHTML(true);
            $mail->Subject = "Contact Form: " . ($subject ?: 'General Inquiry');
            
            $emailBody = "
            <html>
            <head>
                <style>
                    body { font-family: Arial, sans-serif; line-height: 1.6; }
                    .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                    .header { background: #0099ff; color: white; padding: 20px; text-align: center; }
                    .content { padding: 20px; background: #f9f9f9; }
                    .field { margin-bottom: 15px; }
                    .label { font-weight: bold; color: #333; }
                </style>
            </head>
            <body>
                <div class='container'>
                    <div class='header'>
                        <h2>New Contact Form Submission</h2>
                    </div>
                    <div class='content'>
                        <div class='field'>
                            <span class='label'>Name:</span> " . htmlspecialchars($name) . "
                        </div>
                        <div class='field'>
                            <span class='label'>Email:</span> " . htmlspecialchars($email) . "
                        </div>";
                        
            if (!empty($phone)) {
                $emailBody .= "<div class='field'>
                    <span class='label'>Phone:</span> " . htmlspecialchars($phone) . "
                </div>";
            }
            
            $emailBody .= "<div class='field'>
                            <span class='label'>Subject:</span> " . htmlspecialchars($subject ?: 'General Inquiry') . "
                        </div>
                        <div class='field'>
                            <span class='label'>Message:</span><br>
                            " . nl2br(htmlspecialchars($message)) . "
                        </div>
                        <div class='field'>
                            <span class='label'>Sent at:</span> " . date('Y-m-d H:i:s') . "
                        </div>
                    </div>
                </div>
            </body>
            </html>";
            
            $mail->Body = $emailBody;
            $mail->AltBody = "Name: $name\nEmail: $email\nPhone: $phone\nSubject: $subject\nMessage: $message";

            $mail->send();
            $messageSent = true;
            
        } catch (Exception $e) {
            $errorMessage = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        $errorMessage = "Please fill in all required fields.";
    }
}

$currentLang = getCurrentLang();
$isRTL = isRTL();
?>

<section class="section-padding" id="contact-us" <?php echo $isRTL ? 'dir="rtl"' : 'dir="ltr"'; ?>>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2><?php echo t('contact_us'); ?></h2>
                <p class="lead"><?php echo t('contact_subtitle'); ?></p>
            </div>
        </div>
        
        <div class="row">
            <!-- Contact Information -->
            <div class="col-lg-5 col-md-6 col-12 mb-5">
                <div class="contact-info-section">
                    <h4 class="mb-4"><?php echo t('get_in_touch'); ?></h4>
                    
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="bi bi-geo-alt-fill"></i>
                        </div>
                        <div class="contact-details">
                            <h6><?php echo t('address'); ?></h6>
                            <p>123 Medical Street<br>Algiers, Algeria 16000</p>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="bi bi-telephone-fill"></i>
                        </div>
                        <div class="contact-details">
                            <h6><?php echo t('phone'); ?></h6>
                            <p>+213 555 123 456<br>+213 555 123 457</p>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="bi bi-envelope-fill"></i>
                        </div>
                        <div class="contact-details">
                            <h6><?php echo t('email'); ?></h6>
                            <p>beneddinemohamed11@gmail.com<br>contact@maclinique.dz</p>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="bi bi-clock-fill"></i>
                        </div>
                        <div class="contact-details">
                            <h6><?php echo t('working_hours'); ?></h6>
                            <p><?php echo t('working_hours_text'); ?></p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Contact Form -->
            <div class="col-lg-7 col-md-6 col-12">
                <div class="contact-form-section">
                    <h4 class="mb-4"><?php echo t('send_message'); ?></h4>
                    
                    <form method="POST" action="" id="contactForm">
                        <div class="row">
                            <div class="col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="name" class="form-label"><?php echo t('full_name'); ?> <?php echo t('required'); ?></label>
                                    <input type="text" class="form-control" id="name" name="name" 
                                           value="<?php echo $messageSent ? '' : ($_POST['name'] ?? ''); ?>" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="email" class="form-label"><?php echo t('email_address'); ?> <?php echo t('required'); ?></label>
                                    <input type="email" class="form-control" id="email" name="email" 
                                           value="<?php echo $messageSent ? '' : ($_POST['email'] ?? ''); ?>" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="phone" class="form-label"><?php echo t('phone_number'); ?></label>
                                    <input type="tel" class="form-control" id="phone" name="phone" 
                                           value="<?php echo $messageSent ? '' : ($_POST['phone'] ?? ''); ?>">
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="subject" class="form-label"><?php echo t('subject'); ?></label>
                                    <select class="form-control" id="subject" name="subject">
                                        <option value=""><?php echo t('select_subject'); ?></option>
                                        <option value="appointment" <?php echo (isset($_POST['subject']) && $_POST['subject'] == 'appointment' && !$messageSent) ? 'selected' : ''; ?>><?php echo t('book_appointment'); ?></option>
                                        <option value="inquiry" <?php echo (isset($_POST['subject']) && $_POST['subject'] == 'inquiry' && !$messageSent) ? 'selected' : ''; ?>><?php echo t('general_inquiry'); ?></option>
                                        <option value="emergency" <?php echo (isset($_POST['subject']) && $_POST['subject'] == 'emergency' && !$messageSent) ? 'selected' : ''; ?>><?php echo t('emergency'); ?></option>
                                        <option value="other" <?php echo (isset($_POST['subject']) && $_POST['subject'] == 'other' && !$messageSent) ? 'selected' : ''; ?>><?php echo t('other'); ?></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <div class="form-group">
                                <label for="message" class="form-label"><?php echo t('message'); ?> <?php echo t('required'); ?></label>
                                <textarea class="form-control" id="message" name="message" rows="6" 
                                          placeholder="<?php echo t('message_placeholder'); ?>" required><?php echo $messageSent ? '' : ($_POST['message'] ?? ''); ?></textarea>
                            </div>
                        </div>
                        
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-lg px-5">
                                <i class="bi bi-send"></i> <?php echo t('send_message_btn'); ?>
                            </button>
                        </div>
                        
                        <?php if ($messageSent): ?>
                        <div class="alert alert-success mt-3 text-center" id="successMessage">
                            <i class="bi bi-check-circle-fill"></i>
                            <strong><?php echo t('message_sent'); ?></strong><br>
                            <?php echo t('message_sent_desc'); ?>
                        </div>
                        <?php endif; ?>
                        
                        <?php if ($errorMessage): ?>
                        <div class="alert alert-danger mt-3 text-center">
                            <i class="bi bi-exclamation-triangle-fill"></i>
                            <strong>Error:</strong> <?php echo $errorMessage; ?>
                        </div>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.contact-info-section {
    background: #f8f9fa;
    padding: 3rem 2rem;
    border-radius: 15px;
    height: 100%;
}

.contact-form-section {
    background: white;
    padding: 3rem 2rem;
    border-radius: 15px;
    box-shadow: 0 5px 25px rgba(0, 0, 0, 0.1);
}

.contact-item {
    display: flex;
    align-items: flex-start;
    margin-bottom: 2rem;
}

.contact-item:last-child {
    margin-bottom: 0;
}

.contact-icon {
    width: 50px;
    height: 50px;
    background: linear-gradient(45deg, #0099ff, #0077cc);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.contact-icon i {
    color: white;
    font-size: 1.2rem;
}

.contact-details h6 {
    color: #333;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.contact-details p {
    color: #666;
    margin: 0;
    line-height: 1.5;
}

.form-group {
    position: relative;
}

.form-label {
    font-weight: 600;
    color: #333;
    margin-bottom: 0.5rem;
}

.form-control {
    border: 2px solid #e9ecef;
    border-radius: 10px;
    padding: 12px 15px;
    font-size: 16px;
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: #0099ff;
    box-shadow: 0 0 0 0.2rem rgba(0, 153, 255, 0.25);
}

.btn-primary {
    background: #0099ff;
    border: none;
    border-radius: 50px;
    padding: 12px 30px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    transform: translateY(-2px);
    /* box-shadow: 0 5px 15px rgba(0, 153, 255, 0.4); */
    background: #0099ff;
}

.alert-success {
    background: linear-gradient(45deg, #28a745, #20c997);
    border: none;
    color: white;
    border-radius: 10px;
    padding: 1rem;
    animation: slideDown 0.5s ease-out;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

h4 {
    color: #333;
    font-weight: 700;
    margin-bottom: 2rem;
}

/* RTL Support */
[dir="rtl"] .contact-item {
    text-align: right;
}

[dir="rtl"] .contact-icon {
    margin-right: 0;
    margin-left: 1rem;
}

[dir="rtl"] .form-label {
    text-align: right;
}

[dir="rtl"] .btn i {
    margin-right: 0;
    margin-left: 0.5rem;
}

@media (max-width: 768px) {
    .contact-info-section,
    .contact-form-section {
        padding: 2rem 1.5rem;
    }
    
    .contact-item {
        margin-bottom: 1.5rem;
    }
}
</style>

<script>
// Auto-hide success message after 20 seconds
<?php if ($messageSent): ?>
setTimeout(function() {
    const successMessage = document.getElementById('successMessage');
    if (successMessage) {
        successMessage.style.opacity = '0';
        successMessage.style.transition = 'opacity 0.5s ease';
        setTimeout(function() {
            successMessage.style.display = 'none';
        }, 500);
    }
}, 20000);
<?php endif; ?>

// Form validation
document.getElementById('contactForm').addEventListener('submit', function(e) {
    const name = document.getElementById('name').value.trim();
    const email = document.getElementById('email').value.trim();
    const message = document.getElementById('message').value.trim();
    
    if (!name || !email || !message) {
        e.preventDefault();
        alert('<?php echo $isRTL ? "يرجى ملء جميع الحقول المطلوبة." : "Please fill in all required fields."; ?>');
        return false;
    }
});
</script>