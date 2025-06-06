<?php
require_once 'translations.php';
$currentLang = getCurrentLang();
$isRTL = isRTL();
?>

<section class="section-padding text-white z-3" <?php echo $isRTL ? 'dir="rtl"' : 'dir="ltr"'; ?>>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 col-12 fw-bolder">
                <h3><?php echo t('need_immediate_attention'); ?></h3>
                <p class="mb-0"><?php echo t('book_appointment_subtitle'); ?></p>
            </div>
            <div class="col-lg-4 col-12 <?php echo $isRTL ? 'text-lg-start' : 'text-lg-end'; ?>">
                <a href="booking.php" class="btn btn-primary btn-lg <?php echo $isRTL ? 'ms-3' : 'me-3'; ?> book">
                    <?php echo t('book_appointment'); ?>
                </a>
                <a href="tel:+213555123456" class="btn btn-outline-primary btn-lg rounded-5 call">
                    <?php echo t('call_now'); ?>
                </a>
            </div>
        </div>
    </div>
</section>

<style>
    
    /* RTL Support for Immediate Section */
    [dir="rtl"] .immediate-section h3 {
        font-family: 'Cairo', 'Tajawal', Arial, sans-serif;
    }
    
    [dir="rtl"] .immediate-section p {
        font-family: 'Cairo', 'Tajawal', Arial, sans-serif;
    }
    
    [dir="rtl"] .btn {
        font-family: 'Cairo', 'Tajawal', Arial, sans-serif;
    }
    
    /* Button adjustments for RTL */
    @media (max-width: 991.98px) {
        [dir="rtl"] .col-lg-4 {
            text-align: center !important;
            margin-top: 1rem;
        }
        
        [dir="ltr"] .col-lg-4 {
            text-align: center !important;
            margin-top: 1rem;
        }
    }
</style>
