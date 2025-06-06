<?php
require_once 'translations.php';
$currentLang = getCurrentLang();
$isRTL = isRTL();
?>

<section class="section-padding srvces-section" <?php echo $isRTL ? 'dir="rtl"' : 'dir="ltr"'; ?>>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2><?php echo t('our_medical_services'); ?></h2>
                <p class="lead"><?php echo t('comprehensive_healthcare'); ?></p>
            </div>
        </div>
        
        <!-- Services Carousel -->
        <div id="services-carousel" class="splide services-splide" aria-label="<?php echo t('our_medical_services'); ?>">
            <div class="splide__track">
                <ul class="splide__list">
                    <li class="splide__slide">
                        <div class="service-card">
                            <div class="service-icon">
                                <i class="bi bi-bandaid-fill"></i>
                            </div>
                            <h4><?php echo t('orthopedics'); ?></h4>
                            <p><?php echo t('orthopedics_desc'); ?></p>
                        </div>
                    </li>
                    <li class="splide__slide">
                        <div class="service-card">
                            <div class="service-icon">
                                <i class="bi bi-heart-pulse-fill"></i>
                            </div>
                            <h4><?php echo t('internal_medicine'); ?></h4>
                            <p><?php echo t('internal_medicine_desc'); ?></p>
                        </div>
                    </li>
                    <li class="splide__slide">
                        <div class="service-card">
                            <div class="service-icon">
                                <i class="bi bi-gender-female"></i>
                            </div>
                            <h4><?php echo t('obstetrics_gynecology'); ?></h4>
                            <p><?php echo t('obstetrics_gynecology_desc'); ?></p>
                        </div>
                    </li>
                    <li class="splide__slide">
                        <div class="service-card">
                            <div class="service-icon">
                                <i class="bi bi-droplet-fill"></i>
                            </div>
                            <h4><?php echo t('dermatology'); ?></h4>
                            <p><?php echo t('dermatology_desc'); ?></p>
                        </div>
                    </li>
                    <li class="splide__slide">
                        <div class="service-card">
                            <div class="service-icon">
                                <i class="bi bi-emoji-smile-fill"></i>
                            </div>
                            <h4><?php echo t('pediatrics'); ?></h4>
                            <p><?php echo t('pediatrics_desc'); ?></p>
                        </div>
                    </li>
                    <li class="splide__slide">
                        <div class="service-card">
                            <div class="service-icon">
                            <i class="bi bi-radioactive" ></i>                                                    
                        </div>
                            <h4><?php echo t('radiology'); ?></h4>
                            <p><?php echo t('radiology_desc'); ?></p>
                        </div>
                    </li>
                    <li class="splide__slide">
                        <div class="service-card">
                            <div class="service-icon">
                                <i class="bi bi-hospital-fill"></i>
                            </div>
                            <h4><?php echo t('general_surgery'); ?></h4>
                            <p><?php echo t('general_surgery_desc'); ?></p>
                        </div>
                    </li>
                    <li class="splide__slide">
                        <div class="service-card">
                            <div class="service-icon">
                                <i class="bi bi-eye-fill"></i>
                            </div>
                            <h4><?php echo t('ophthalmology'); ?></h4>
                            <p><?php echo t('ophthalmology_desc'); ?></p>
                        </div>
                    </li>
                    <li class="splide__slide">
                        <div class="service-card">
                            <div class="service-icon">
                                <i class="bi bi-house-heart-fill"></i>
                            </div>
                            <h4><?php echo t('family_medicine'); ?></h4>
                            <p><?php echo t('family_medicine_desc'); ?></p>
                        </div>
                    </li>
                    <li class="splide__slide">
                        <div class="service-card">
                            <div class="service-icon">
                                <i class="bi bi-wind"></i>
                            </div>
                            <h4><?php echo t('chest_medicine'); ?></h4>
                            <p><?php echo t('chest_medicine_desc'); ?></p>
                        </div>
                    </li>
                    <li class="splide__slide">
                        <div class="service-card">
                            <div class="service-icon">
                                <i class="bi bi-capsule-pill"></i>
                            </div>
                            <h4><?php echo t('anesthesia'); ?></h4>
                            <p><?php echo t('anesthesia_desc'); ?></p>
                        </div>
                    </li>
                    <li class="splide__slide">
                        <div class="service-card">
                            <div class="service-icon">
                                <i class="bi bi-graph-up"></i>
                            </div>
                            <h4><?php echo t('pathology'); ?></h4>
                            <p><?php echo t('pathology_desc'); ?></p>
                        </div>
                    </li>
                    <li class="splide__slide">
                        <div class="service-card">
                            <div class="service-icon">
                                <i class="bi bi-headphones"></i>
                            </div>
                            <h4><?php echo t('ent'); ?></h4>
                            <p><?php echo t('ent_desc'); ?></p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<style>
    body{
        overflow-x: hidden; /* Prevent horizontal overflow */
    }

    .srvces-section {
        z-index: 1;
    }
    
    /* Services Carousel Styles */
    .services-splide {
        overflow: visible; 
        height: 300px; 
    }
    
    .splide__track {
        overflow: visible;
    }
    
    .splide__list {
        overflow: visible;
    }
    
    .service-card {
        background: white;
        border-radius: 15px;
        padding: 2rem;
        text-align: center;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        height: 280px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        margin: 0 5px;
    }

    .service-icon {
        background: linear-gradient(45deg, #0099ff, #0077cc);
        width: 70px;
        height: 70px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
    }

    .service-icon i {
        font-size: 2rem;
        color: white;
        font-weight: bold;
    }

    .service-card h4 {
        color: #333;
        font-weight: 600;
        margin-bottom: 1rem;
        font-size: 1.25rem;
    }

    .service-card p {
        color: #666;
        font-size: 0.95rem;
        line-height: 1.5;
        margin: 0;
    }

    /* Stats Card Styles */
    .stats-card {
        background: white;
        border-radius: 15px;
        padding: 2rem;
        text-align: center;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        height: 200px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        position: relative;
        z-index: 1;
    }

    .stats-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 30px rgba(0, 153, 255, 0.2);
        z-index: 10;
    }

    .stats-icon {
        font-size: 3rem;
        color: #0099ff;
        margin-bottom: 1rem;
    }

    .stats-number {
        font-size: 2.5rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 0.5rem;
    }

    .stats-text {
        color: #666;
        font-weight: 500;
        margin: 0;
    }

    /* RTL Support for Services */
    [dir="rtl"] .service-card {
        text-align: center; /* Keep center alignment for cards */
    }

    [dir="rtl"] .service-card h4 {
        font-family: 'Cairo', 'Tajawal', Arial, sans-serif;
    }

    [dir="rtl"] .service-card p {
        font-family: 'Cairo', 'Tajawal', Arial, sans-serif;
        text-align: center;
    }

    /* Splide RTL adjustments */
    [dir="rtl"] .splide__arrow {
        transform: scaleX(-1);
    }

    [dir="rtl"] .splide__arrow--prev {
        right: 1em;
        left: auto;
    }

    [dir="rtl"] .splide__arrow--next {
        left: 1em;
        right: auto;
    }
</style>

