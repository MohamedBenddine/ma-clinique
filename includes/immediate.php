<?php
require_once 'translations.php';
$currentLang = getCurrentLang();
$isRTL = isRTL();
?>

<section class="section-padding text-white " id="bg-blue" <?php echo $isRTL ? 'dir="rtl"' : 'dir="ltr"'; ?>>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 col-12 fw-bolder">
                <h3 class="text-white"><?php echo t('need_immediate_attention'); ?></h3>
                <p class="text-white mb-0"><?php echo t('book_appointment_subtitle'); ?></p>
            </div>
            <div class="col-lg-4 col-12 <?php echo $isRTL ? 'text-lg-start' : 'text-lg-end'; ?>">
                <a href="booking.php" class="btn btn-primary2 btn-lg <?php echo $isRTL ? 'ms-3' : 'me-3'; ?> book">
                    <?php echo t('book_appointment'); ?>
                </a>
                
            </div>
        </div>
    </div>
</section>

<style>

    .btn-primary2 {
        background-color: #fff;
        border-color: #0099ff;
    }
    .btn-primary2:hover {
        background-color: #007acc;
        border-color: #007acc;
    }
    
    
    #bg-blue {
        background: #0099ff;
    }
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
