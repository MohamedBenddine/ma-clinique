<?php
require_once 'translations.php';
$currentLang = getCurrentLang();
$isRTL = isRTL();
?>

<section class="section-padding bg-blue" <?php echo $isRTL ? 'dir="rtl"' : 'dir="ltr"'; ?>>
    <div class="container">
        <div class="row text-center">
            <div class="col-lg-3 col-md-6 col-12 mb-4">
                <div class="stats-card">
                    <i class="bi bi-people-fill stats-icon"></i>
                    <h3 class="stats-number">500+</h3>
                    <p class="stats-text"><?php echo $currentLang === 'ar' ? 'مرضى سعداء' : 'Happy Patients'; ?></p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12 mb-4">
                <div class="stats-card">
                    <i class="bi bi-award-fill stats-icon"></i>
                    <h3 class="stats-number">10+</h3>
                    <p class="stats-text"><?php echo $currentLang === 'ar' ? 'سنوات الخبرة' : 'Years Experience'; ?></p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12 mb-4">
                <div class="stats-card">
                    <i class="bi bi-heart-pulse-fill stats-icon"></i>
                    <h3 class="stats-number">15+</h3>
                    <p class="stats-text"><?php echo $currentLang === 'ar' ? 'تخصصات طبية' : 'Specializations'; ?></p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12 mb-4">
                <div class="stats-card">
                    <i class="bi bi-clock-fill stats-icon"></i>
                    <h3 class="stats-number">24/7</h3>
                    <p class="stats-text"><?php echo $currentLang === 'ar' ? 'رعاية الطوارئ' : 'Emergency Care'; ?></p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- RTL Support for Stats -->
<style>
[dir="rtl"] .stats-text {
    font-family: 'Cairo', 'Tajawal', Arial, sans-serif;
}

[dir="rtl"] .stats-card {
    font-family: 'Cairo', 'Tajawal', Arial, sans-serif;
}
</style>