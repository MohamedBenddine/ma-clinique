<?php
require_once 'translations.php';
$currentLang = getCurrentLang();
$isRTL = isRTL();
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
    <div class="carousel-overlay">
        <div class="overlay-content">
            <div class="heading-container">
                <h1 class="main-heading">
                    <?php echo $currentLang === 'ar' ? 'الرعاية الصحية متاحة' : 'HEALTH CARE AVAILABLE'; ?>
                </h1>
            </div>
            <div class="button-container">
                <a href="booking.php" class="bg-blue primary-button ">
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

<!-- Only minimal RTL font support, no style changes -->
<style>
[dir="rtl"] .main-heading,
[dir="rtl"] .primary-button,
[dir="rtl"] .secondary-button,
[dir="rtl"] .terms-text {
    font-family: 'Cairo', 'Tajawal', Arial, sans-serif;
}
</style>