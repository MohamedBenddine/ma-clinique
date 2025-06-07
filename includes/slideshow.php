<?php
require_once 'translations.php';
$currentLang = getCurrentLang();
$isRTL = isRTL();

// Function to check if clinic is open
function isClinicOpen() {
    $currentDay = date('w'); // 0 = Sunday, 1 = Monday, ..., 6 = Saturday
    $currentTime = date('H:i'); // 24-hour format
    
    switch($currentDay) {
        case 1: // Monday
        case 2: // Tuesday
        case 3: // Wednesday
        case 4: // Thursday
            return ($currentTime >= '08:00' && $currentTime <= '18:00');
        
        case 6: // Saturday
            return ($currentTime >= '09:00' && $currentTime <= '16:00');
        
        case 0: // Sunday - Emergency Only (closed)
        case 5: // Friday - Closed
        default:
            return false;
    }
}

$isOpen = isClinicOpen();
?>

<section id="image-carousel" class="splide" aria-label="<?php echo $currentLang === 'ar' ? 'صور جميلة' : 'Beautiful Images'; ?>" <?php echo $isRTL ? 'dir="rtl"' : ''; ?>>
    <div class="splide__track">
        <ul class="splide__list">
            <li class="splide__slide">
                <img src="images/new-pics/1.jpg" class="carouselImage" alt="<?php echo $currentLang === 'ar' ? 'المرفق الطبي' : 'Medical Facility'; ?>">
            </li>
            <li class="splide__slide">
                <img src="images/new-pics/4.jpg" class="carouselImage" alt="<?php echo $currentLang === 'ar' ? 'المرفق الطبي' : 'Medical Facility'; ?>">
            </li>
            <li class="splide__slide">
                <img src="images/new-pics/3.jpg" class="carouselImage" alt="<?php echo $currentLang === 'ar' ? 'المرفق الطبي' : 'Medical Facility'; ?>">
            </li>
            <li class="splide__slide">
                <img src="images/new-pics/5.jpg" class="carouselImage" alt="<?php echo $currentLang === 'ar' ? 'المرفق الطبي' : 'Medical Facility'; ?>">
            </li>
            <li class="splide__slide">
                <img src="images/new-pics/2.jpg" class="carouselImage" alt="<?php echo $currentLang === 'ar' ? 'المرفق الطبي' : 'Medical Facility'; ?>">
            </li>
            <li class="splide__slide">
                <img src="images/new-pics/6.jpg" class="carouselImage" alt="<?php echo $currentLang === 'ar' ? 'المرفق الطبي' : 'Medical Facility'; ?>">
            </li>
        </ul>
    </div>
    
    <!-- Clinic Status Indicator -->
    <div class="clinic-status <?php echo $isRTL ? 'rtl' : 'ltr'; ?>">
        <div class="status-indicator <?php echo $isOpen ? 'open' : 'closed'; ?>">
            <div class="status-dot"></div>
            <span class="status-text">
                <?php 
                if ($isOpen) {
                    echo $currentLang === 'ar' ? 'العيادة مفتوحة حاليا' : 'We are open now';
                } else {
                    echo $currentLang === 'ar' ? 'العيادة مغلقة حاليا' : 'We are closed now';
                }
                ?>
            </span>
        </div>
    </div>
    
    <div class="carousel-overlay">
        <div class="overlay-content">
            <div class="heading-container">
                <h1 class="main-heading">
                    <?php echo $currentLang === 'ar' ? 'الرعاية الصحية متاحة' : 'HEALTH CARE AVAILABLE'; ?>
                </h1>
            </div>
            <div class="button-container">
                <a href="booking.php" class="primary-button3" >
                    <?php echo $currentLang === 'ar' ? 'احجز الآن' : 'BOOK NOW'; ?>
                </a>
                <a href="#about" class="secondary-button">
                    <?php echo $currentLang === 'ar' ? 'اعرف المزيد' : 'LEARN MORE'; ?>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M7 17L17 7"/>
                        <path d="M7 7h10v10"/>
                    </svg>
                </a>
            </div>
            <div class="terms-container">
                <p class="terms-text"><?php echo $currentLang === 'ar' ? '*خدمات طبية مهنية متاحة، اتصل بنا لتفاصيل المواعيد.' : '*Professional medical services available, contact us for appointment details.'; ?></p>
            </div>
        </div>
    </div>
</section>

<style>
/* Clinic Status Indicator Styles */
.clinic-status {
    position: absolute;
    top: 20px;
    left: 20px;
    z-index: 1000;
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border-radius: 25px;
    padding: 8px 16px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.clinic-status.rtl {
    left: auto;
    right: 20px;
}

.status-indicator {
    display: flex;
    align-items: center;
    gap: 8px;
}

.status-dot {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    position: relative;
}

/* Open Status - Green with pulsing animation */
.status-indicator.open .status-dot {
    background: #00c851;
    animation: pulse 2s infinite;
}

/* Closed Status - Red, no animation */
.status-indicator.closed .status-dot {
    background: #ff4444;
}

.status-text {
    font-size: 0.9rem;
    font-weight: 600;
    color: #333;
    white-space: nowrap;
}

/* Pulsing animation for open status */
@keyframes pulse {
    0% {
        transform: scale(1);
        box-shadow: 0 0 0 0 rgba(0, 200, 81, 0.7);
    }
    50% {
        transform: scale(1.1);
        box-shadow: 0 0 0 6px rgba(0, 200, 81, 0.3);
    }
    100% {
        transform: scale(1);
        box-shadow: 0 0 0 0 rgba(0, 200, 81, 0);
    }
}

/* RTL Font Support */
[dir="rtl"] .main-heading,
[dir="rtl"] .primary-button,
[dir="rtl"] .secondary-button,
[dir="rtl"] .terms-text,
[dir="rtl"] .status-text {
    font-family: 'Cairo', 'Tajawal', Arial, sans-serif;
}

/* Responsive Design for Status Indicator */
@media (max-width: 768px) {
    .clinic-status {
        top: 15px;
        left: 15px;
        padding: 6px 12px;
    }
    
    .clinic-status.rtl {
        left: auto;
        right: 15px;
    }
    
    .status-dot {
        width: 10px;
        height: 10px;
    }
    
    .status-text {
        font-size: 0.8rem;
    }
}

@media (max-width: 480px) {
    .clinic-status {
        top: 10px;
        left: 10px;
        padding: 5px 10px;
    }
    
    .clinic-status.rtl {
        left: auto;
        right: 10px;
    }
    
    .status-text {
        font-size: 0.75rem;
    }
}

/* Ensure status indicator stays above carousel controls */
.splide__arrow {
    z-index: 999;
}

.splide__pagination {
    z-index: 999;
}
</style>