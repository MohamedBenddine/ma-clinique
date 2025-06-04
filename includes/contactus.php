<?php
$messageSent = false;

// Handle form submission
if ($_POST) {
    // Simulate email sending (you can add actual mail() function here)
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $subject = $_POST['subject'] ?? '';
    $message = $_POST['message'] ?? '';
    
    // Basic validation
    if (!empty($name) && !empty($email) && !empty($message)) {
        // Here you would normally send the email using mail() or PHPMailer
        // mail($to, $subject, $message, $headers);
        
        $messageSent = true;
    }
}
?>

<section class="section-padding" id="contact-us">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2>Contact Us</h2>
                <p class="lead">Get in touch with us for any inquiries or appointments</p>
            </div>
        </div>
        
        <div class="row">
            <!-- Contact Information -->
            <div class="col-lg-5 col-md-6 col-12 mb-5">
                <div class="contact-info-section">
                    <h4 class="mb-4">Get In Touch</h4>
                    
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="bi bi-geo-alt-fill"></i>
                        </div>
                        <div class="contact-details">
                            <h6>Address</h6>
                            <p>123 Medical Street<br>Algiers, Algeria 16000</p>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="bi bi-telephone-fill"></i>
                        </div>
                        <div class="contact-details">
                            <h6>Phone</h6>
                            <p>+213 555 123 456<br>+213 555 123 457</p>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="bi bi-envelope-fill"></i>
                        </div>
                        <div class="contact-details">
                            <h6>Email</h6>
                            <p>info@maclinique.dz<br>contact@maclinique.dz</p>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="bi bi-clock-fill"></i>
                        </div>
                        <div class="contact-details">
                            <h6>Working Hours</h6>
                            <p>Mon - Fri: 8:00 AM - 6:00 PM<br>
                               Sat: 9:00 AM - 4:00 PM<br>
                               Sun: Emergency Only</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Contact Form -->
            <div class="col-lg-7 col-md-6 col-12">
                <div class="contact-form-section">
                    <h4 class="mb-4">Send us a Message</h4>
                    
                    <form method="POST" action="" id="contactForm">
                        <div class="row">
                            <div class="col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="name" class="form-label">Full Name *</label>
                                    <input type="text" class="form-control" id="name" name="name" 
                                           value="<?php echo $messageSent ? '' : ($_POST['name'] ?? ''); ?>" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="email" class="form-label">Email Address *</label>
                                    <input type="email" class="form-control" id="email" name="email" 
                                           value="<?php echo $messageSent ? '' : ($_POST['email'] ?? ''); ?>" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="tel" class="form-control" id="phone" name="phone" 
                                           value="<?php echo $messageSent ? '' : ($_POST['phone'] ?? ''); ?>">
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="subject" class="form-label">Subject</label>
                                    <select class="form-control" id="subject" name="subject">
                                        <option value="">Select a subject</option>
                                        <option value="appointment" <?php echo (isset($_POST['subject']) && $_POST['subject'] == 'appointment' && !$messageSent) ? 'selected' : ''; ?>>Book Appointment</option>
                                        <option value="inquiry" <?php echo (isset($_POST['subject']) && $_POST['subject'] == 'inquiry' && !$messageSent) ? 'selected' : ''; ?>>General Inquiry</option>
                                        <option value="emergency" <?php echo (isset($_POST['subject']) && $_POST['subject'] == 'emergency' && !$messageSent) ? 'selected' : ''; ?>>Emergency</option>
                                        <option value="other" <?php echo (isset($_POST['subject']) && $_POST['subject'] == 'other' && !$messageSent) ? 'selected' : ''; ?>>Other</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <div class="form-group">
                                <label for="message" class="form-label">Message *</label>
                                <textarea class="form-control" id="message" name="message" rows="6" 
                                          placeholder="Tell us how we can help you..." required><?php echo $messageSent ? '' : ($_POST['message'] ?? ''); ?></textarea>
                            </div>
                        </div>
                        
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-lg px-5">
                                <i class="bi bi-send"></i> Send Message
                            </button>
                        </div>
                        
                        <?php if ($messageSent): ?>
                        <div class="alert alert-success mt-3 text-center" id="successMessage">
                            <i class="bi bi-check-circle-fill"></i>
                            <strong>Message Sent Successfully!</strong><br>
                            Thank you for contacting us. We'll get back to you within 24 hours.
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
    margin-right: 1rem;
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
    background: linear-gradient(45deg, #0099ff, #0077cc);
    border: none;
    border-radius: 50px;
    padding: 12px 30px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 153, 255, 0.4);
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
// Auto-hide success message after 5 seconds
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
        alert('Please fill in all required fields.');
        return false;
    }
});
</script>