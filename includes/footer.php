<?php
require_once 'translations.php';
$currentLang = getCurrentLang();
$isRTL = isRTL();
?>

<footer class="site-footer section-padding" id="contact" <?php echo $isRTL ? 'dir="rtl"' : 'dir="ltr"'; ?>>
    <div class="container">
        <div class="row">
            <!-- Contact Information -->
            <div class="col-lg-4 col-md-6 col-12 mb-4">
                <div class="footer-section">
                    <div class="footer-logo mb-4">
                        <h3 class="clinic-name">
                            <i class="bi bi-hospital"></i>
                            <?php echo $currentLang === 'ar' ? 'عيادتي' : 'Ma Clinique'; ?>
                        </h3>
                        <p class="clinic-tagline">
                            <?php echo $currentLang === 'ar' ? 'التميز في الرعاية الصحية' : 'Excellence in Healthcare'; ?>
                        </p>
                    </div>
                    
                    <?php
                    $sql="SELECT * from tblpage where PageType='contactus'";
                    $query = $dbh -> prepare($sql);
                    $query->execute();
                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                    
                    if($query->rowCount() > 0) {
                        foreach($results as $row) {
                    ?>
                    
                    <div class="contact-info">
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="bi bi-clock"></i>
                            </div>
                            <div class="info-content">
                                <h6><?php echo $currentLang === 'ar' ? 'أوقات العمل' : 'Working Hours'; ?></h6>
                                <p><?php echo ($row->Timing); ?></p>
                            </div>
                        </div>
                        
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                            <div class="info-content">
                                <h6><?php echo $currentLang === 'ar' ? 'البريد الإلكتروني' : 'Email'; ?></h6>
                                <p><a href="mailto:<?php echo ($row->Email); ?>"><?php echo ($row->Email); ?></a></p>
                            </div>
                        </div>
                        
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="bi bi-telephone"></i>
                            </div>
                            <div class="info-content">
                                <h6><?php echo $currentLang === 'ar' ? 'الهاتف' : 'Phone'; ?></h6>
                                <p><a href="tel:+213555123456">+213 555 123 456</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- About Clinic -->
            <div class="col-lg-4 col-md-6 col-12 mb-4">
                <div class="footer-section">
                    <h5 class="footer-title">
                        <?php echo $currentLang === 'ar' ? 'عن عيادتنا' : 'About Our Clinic'; ?>
                    </h5>
                    <p class="clinic-description">
                        <?php echo ($row->PageDescription); ?>
                    </p>
                    
                    <div class="quick-links mt-4">
                        <h6 class="links-title">
                            <?php echo $currentLang === 'ar' ? 'روابط سريعة' : 'Quick Links'; ?>
                        </h6>
                        <ul class="links-list">
                            <li><a href="#about"><?php echo $currentLang === 'ar' ? 'من نحن' : 'About Us'; ?></a></li>
                            <li><a href="#services"><?php echo $currentLang === 'ar' ? 'خدماتنا' : 'Our Services'; ?></a></li>
                            <li><a href="booking.php"><?php echo $currentLang === 'ar' ? 'حجز موعد' : 'Book Appointment'; ?></a></li>
                            <li><a href="contactus.php"><?php echo $currentLang === 'ar' ? 'اتصل بنا' : 'Contact Us'; ?></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <?php }} ?>

            <!-- Social Media & Newsletter -->
            <div class="col-lg-4 col-md-12 col-12 mb-4">
                <div class="footer-section">
                    <h5 class="footer-title">
                        <?php echo $currentLang === 'ar' ? 'تواصل معنا' : 'Stay Connected'; ?>
                    </h5>
                    
                    <p class="social-description">
                        <?php echo $currentLang === 'ar' ? 'تابعنا على وسائل التواصل الاجتماعي للحصول على آخر التحديثات والنصائح الصحية.' : 'Follow us on social media for the latest updates and health tips.'; ?>
                    </p>
                    
                    <div class="social-media">
                        <h6 class="social-title">
                            <?php echo $currentLang === 'ar' ? 'وسائل التواصل' : 'Social Media'; ?>
                        </h6>
                        <div class="social-icons">
                            <a href="#" class="social-icon facebook" aria-label="Facebook">
                                <i class="bi bi-facebook"></i>
                            </a>
                            <a href="#" class="social-icon twitter" aria-label="Twitter">
                                <i class="bi bi-twitter"></i>
                            </a>
                            <a href="#" class="social-icon instagram" aria-label="Instagram">
                                <i class="bi bi-instagram"></i>
                            </a>
                            <a href="#" class="social-icon youtube" aria-label="YouTube">
                                <i class="bi bi-youtube"></i>
                            </a>
                            <a href="#" class="social-icon linkedin" aria-label="LinkedIn">
                                <i class="bi bi-linkedin"></i>
                            </a>
                        </div>
                    </div>
                    
                    <!-- Newsletter Signup -->
                    <div class="newsletter mt-4">
                        <h6 class="newsletter-title">
                            <?php echo $currentLang === 'ar' ? 'النشرة الإخبارية' : 'Newsletter'; ?>
                        </h6>
                        <form class="newsletter-form">
                            <div class="input-group">
                                <input type="email" class="form-control" 
                                       placeholder="<?php echo $currentLang === 'ar' ? 'أدخل بريدك الإلكتروني' : 'Enter your email'; ?>" 
                                       required>
                                <button class="btn btn-subscribe" type="submit">
                                    <i class="bi bi-send"></i>
                                </button>
                            </div>
                        </form>
                        <p class="newsletter-note">
                            <?php echo $currentLang === 'ar' ? 'احصل على نصائح صحية وتحديثات العيادة.' : 'Get health tips and clinic updates.'; ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <div class="row align-items-center">
                <div class="col-md-6 col-12">
                    <p class="copyright">
                        &copy; <?php echo date('Y'); ?> 
                        <?php echo $currentLang === 'ar' ? 'عيادتي. جميع الحقوق محفوظة.' : 'Ma Clinique. All rights reserved.'; ?>
                    </p>
                </div>
                <div class="col-md-6 col-12">
                    <div class="footer-links">
                        <a href="#"><?php echo $currentLang === 'ar' ? 'سياسة الخصوصية' : 'Privacy Policy'; ?></a>
                        <a href="#"><?php echo $currentLang === 'ar' ? 'الشروط والأحكام' : 'Terms & Conditions'; ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<style>
.site-footer {
    background: linear-gradient(135deg, #0099ff 0%, #0077cc 100%);
    color: white;
    position: relative;
    overflow: hidden;
}

.site-footer::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="50" cy="50" r="1" fill="rgba(255,255,255,0.03)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
    opacity: 0.5;
}

.footer-section {
    position: relative;
    z-index: 2;
}

.clinic-name {
    color: white;
    font-weight: 700;
    font-size: 1.8rem;
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
    gap: 10px;
}

.clinic-name i {
    color: #ffd700;
    font-size: 2rem;
}

.clinic-tagline {
    color: rgba(255, 255, 255, 0.8);
    font-size: 0.9rem;
    margin-bottom: 0;
    font-style: italic;
}

.footer-title {
    color: white;
    font-weight: 600;
    margin-bottom: 1.5rem;
    position: relative;
    padding-bottom: 10px;
}

.footer-title::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 50px;
    height: 3px;
    background: #ffd700;
    border-radius: 2px;
}

.info-item {
    display: flex;
    align-items: flex-start;
    margin-bottom: 1.5rem;
    gap: 15px;
}

.info-icon {
    width: 40px;
    height: 40px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    backdrop-filter: blur(10px);
}

.info-icon i {
    color: #ffd700;
    font-size: 1.1rem;
}

.info-content h6 {
    color: #ffd700;
    font-weight: 600;
    margin-bottom: 0.25rem;
    font-size: 0.9rem;
}

.info-content p {
    color: rgba(255, 255, 255, 0.9);
    margin: 0;
    line-height: 1.5;
}

.info-content a {
    color: rgba(255, 255, 255, 0.9);
    text-decoration: none;
    transition: color 0.3s ease;
}

.info-content a:hover {
    color: #ffd700;
}

.clinic-description {
    color: rgba(255, 255, 255, 0.9);
    line-height: 1.6;
    margin-bottom: 1.5rem;
}

.links-title {
    color: #ffd700;
    font-weight: 600;
    margin-bottom: 1rem;
    font-size: 1rem;
}

.links-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.links-list li {
    margin-bottom: 0.5rem;
}

.links-list a {
    color: rgba(255, 255, 255, 0.8);
    text-decoration: none;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    padding: 5px 0;
}

.links-list a::before {
    content: '▶';
    color: #ffd700;
    margin-right: 8px;
    font-size: 0.7rem;
    transition: transform 0.3s ease;
}

.links-list a:hover {
    color: #ffd700;
    padding-left: 10px;
}

.links-list a:hover::before {
    transform: translateX(5px);
}

.social-description {
    color: rgba(255, 255, 255, 0.9);
    margin-bottom: 1.5rem;
    line-height: 1.5;
}

.social-title {
    color: #ffd700;
    font-weight: 600;
    margin-bottom: 1rem;
}

.social-icons {
    display: flex;
    gap: 15px;
    margin-bottom: 2rem;
    flex-wrap: wrap;
}

.social-icon {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255, 255, 255, 0.2);
}

.social-icon.facebook { background: rgba(59, 89, 152, 0.3); }
.social-icon.twitter { background: rgba(29, 161, 242, 0.3); }
.social-icon.instagram { background: rgba(225, 48, 108, 0.3); }
.social-icon.youtube { background: rgba(255, 0, 0, 0.3); }
.social-icon.linkedin { background: rgba(0, 119, 181, 0.3); }

.social-icon i {
    color: white;
    font-size: 1.2rem;
}

.social-icon:hover {
    transform: translateY(-3px) scale(1.1);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
    border-color: #ffd700;
}

.newsletter-title {
    color: #ffd700;
    font-weight: 600;
    margin-bottom: 1rem;
}

.newsletter-form .input-group {
    border-radius: 25px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
}

.newsletter-form .form-control {
    border: none;
    padding: 12px 20px;
    background: rgba(255, 255, 255, 0.95);
    color: #333;
}

.newsletter-form .form-control:focus {
    box-shadow: none;
    background: white;
}

.btn-subscribe {
    background: #ffd700;
    border: none;
    color: #333;
    padding: 12px 20px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-subscribe:hover {
    background: #ffed4a;
    transform: scale(1.05);
}

.newsletter-note {
    color: rgba(255, 255, 255, 0.7);
    font-size: 0.8rem;
    margin-top: 0.5rem;
    margin-bottom: 0;
}

.footer-bottom {
    border-top: 1px solid rgba(255, 255, 255, 0.2);
    margin-top: 3rem;
    padding-top: 2rem;
    position: relative;
    z-index: 2;
}

.copyright {
    color: rgba(255, 255, 255, 0.8);
    margin: 0;
    font-size: 0.9rem;
}

.footer-links {
    display: flex;
    gap: 20px;
    justify-content: flex-end;
}

.footer-links a {
    color: rgba(255, 255, 255, 0.8);
    text-decoration: none;
    font-size: 0.9rem;
    transition: color 0.3s ease;
}

.footer-links a:hover {
    color: #ffd700;
}

/* RTL Support */
[dir="rtl"] .clinic-name {
    flex-direction: row-reverse;
}

[dir="rtl"] .info-item {
    flex-direction: row-reverse;
    text-align: right;
}

[dir="rtl"] .footer-title::after {
    left: auto;
    right: 0;
}

[dir="rtl"] .links-list a::before {
    margin-right: 0;
    margin-left: 8px;
    content: '◀';
}

[dir="rtl"] .links-list a:hover {
    padding-left: 0;
    padding-right: 10px;
}

[dir="rtl"] .footer-links {
    justify-content: flex-start;
}

[dir="rtl"] .clinic-name,
[dir="rtl"] .clinic-tagline,
[dir="rtl"] .footer-title,
[dir="rtl"] .info-content h6,
[dir="rtl"] .info-content p,
[dir="rtl"] .clinic-description,
[dir="rtl"] .links-title,
[dir="rtl"] .links-list a,
[dir="rtl"] .social-description,
[dir="rtl"] .social-title,
[dir="rtl"] .newsletter-title,
[dir="rtl"] .newsletter-note,
[dir="rtl"] .copyright,
[dir="rtl"] .footer-links a {
    font-family: 'Cairo', 'Tajawal', Arial, sans-serif;
}

/* Responsive Design */
@media (max-width: 768px) {
    .social-icons {
        justify-content: center;
    }
    
    .footer-links {
        justify-content: center !important;
        flex-direction: column;
        text-align: center;
        gap: 10px;
    }
    
    .clinic-name {
        justify-content: center;
        text-align: center;
    }
    
    .footer-title::after {
        left: 50%;
        transform: translateX(-50%);
    }
    
    [dir="rtl"] .footer-title::after {
        right: 50%;
        left: 50%;
        transform: translateX(50%);
    }
}

@media (max-width: 576px) {
    .info-item {
        flex-direction: column;
        text-align: center;
        gap: 10px;
    }
    
    [dir="rtl"] .info-item {
        flex-direction: column;
    }
    
    .social-icons {
        justify-content: center;
    }
}
</style>