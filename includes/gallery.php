<?php
require_once 'translations.php';
$currentLang = getCurrentLang();
$isRTL = isRTL();
?>

<section class="gallery-section section-padding" <?php echo $isRTL ? 'dir="rtl"' : 'dir="ltr"'; ?>>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="text-white mb-4"><?php echo t('our_medical_gallery'); ?></h2>
                <p class="lead text-white"><?php echo t('gallery_subtitle'); ?></p>
            </div>
        </div>
        
        <div class="row">
            <!-- Gallery Item 1 -->
            <div class="col-lg-3 col-md-6 col-12 mb-4">
                <div class="gallery-item">
                    <img src="images/new-pics/5.jpg" class="gallery-image" alt="<?php echo t('professional_medical_team'); ?>">
                    <div class="gallery-overlay">
                        <div class="overlay-content">
                            <h4><?php echo t('professional_medical_team'); ?></h4>
                            <p><?php echo t('professional_team_desc'); ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Gallery Item 2 -->
            <div class="col-lg-3 col-md-6 col-12 mb-4">
                <div class="gallery-item">
                    <img src="images/new-pics/6.jpg" class="gallery-image" alt="<?php echo t('modern_medical_facilities'); ?>">
                    <div class="gallery-overlay">
                        <div class="overlay-content">
                            <h4><?php echo t('modern_medical_facilities'); ?></h4>
                            <p><?php echo t('modern_facilities_desc'); ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Gallery Item 3 -->
            <div class="col-lg-3 col-md-6 col-12 mb-4">
                <div class="gallery-item">
                    <img src="images/gallery/about.jpg" class="gallery-image" alt="<?php echo t('comprehensive_patient_care'); ?>">
                    <div class="gallery-overlay">
                        <div class="overlay-content">
                            <h4><?php echo t('comprehensive_patient_care'); ?></h4>
                            <p><?php echo t('patient_care_desc'); ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Gallery Item 4 -->
            <div class="col-lg-3 col-md-6 col-12 mb-4">
                <div class="gallery-item">
                    <img src="images/gallery/about2.jpg" class="gallery-image" alt="<?php echo t('advanced_medical_technology'); ?>">
                    <div class="gallery-overlay">
                        <div class="overlay-content">
                            <h4><?php echo t('advanced_medical_technology'); ?></h4>
                            <p><?php echo t('advanced_technology_desc'); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.gallery-section {
    background: #0099ff;
    overflow: hidden;
}

.gallery-item {
    position: relative;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
    transition: all 0.3s ease;
    height: 250px;
}

.gallery-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25);
}

.gallery-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: all 0.3s ease;
}

.gallery-item:hover .gallery-image {
    transform: scale(1.05);
    filter: brightness(0.6);
}

.gallery-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 153, 255, 0.7);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: all 0.3s ease;
    border-radius: 15px;
}

.gallery-item:hover .gallery-overlay {
    opacity: 1;
}

.overlay-content {
    text-align: center;
    color: white;
    padding: 1.5rem;
    transform: translateY(20px);
    transition: all 0.3s ease;
}

.gallery-item:hover .overlay-content {
    transform: translateY(0);
}

.overlay-content h4 {
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
    color: white;
    line-height: 1.3;
}

.overlay-content p {
    font-size: 0.85rem;
    line-height: 1.4;
    margin-bottom: 0;
    color: rgba(255, 255, 255, 0.9);
}

/* RTL Support for Gallery */
[dir="rtl"] .gallery-section h2 {
    font-family: 'Cairo', 'Tajawal', Arial, sans-serif;
}

[dir="rtl"] .gallery-section .lead {
    font-family: 'Cairo', 'Tajawal', Arial, sans-serif;
}

[dir="rtl"] .overlay-content h4 {
    font-family: 'Cairo', 'Tajawal', Arial, sans-serif;
}

[dir="rtl"] .overlay-content p {
    font-family: 'Cairo', 'Tajawal', Arial, sans-serif;
}

/* Responsive Design */
@media (max-width: 992px) {
    .gallery-item {
        height: 220px;
    }
    
    .overlay-content h4 {
        font-size: 1rem;
    }
    
    .overlay-content p {
        font-size: 0.8rem;
    }
}

@media (max-width: 768px) {
    .gallery-item {
        height: 200px;
        margin-bottom: 1.5rem;
    }
    
    .overlay-content {
        padding: 1.2rem;
    }
    
    .overlay-content h4 {
        font-size: 0.95rem;
    }
    
    .overlay-content p {
        font-size: 0.75rem;
    }
}

@media (max-width: 576px) {
    .gallery-item {
        height: 180px;
    }
    
    .overlay-content {
        padding: 1rem;
    }
    
    .overlay-content h4 {
        font-size: 0.9rem;
    }
    
    .overlay-content p {
        font-size: 0.7rem;
    }
}

/* Loading animation */
.gallery-image {
    background: linear-gradient(45deg, #f0f0f0, #e0e0e0);
}

.gallery-item:hover::after {
    opacity: 0.8;
}

/* RTL Direction adjustments */
[dir="rtl"] .gallery-item::after {
    right: auto;
    left: 1rem;
}
</style>

<script>
// Add smooth loading effect
document.addEventListener('DOMContentLoaded', function() {
    const galleryItems = document.querySelectorAll('.gallery-item');
    
    galleryItems.forEach((item, index) => {
        item.style.opacity = '0';
        item.style.transform = 'translateY(30px)';
        
        setTimeout(() => {
            item.style.transition = 'all 0.6s ease';
            item.style.opacity = '1';
            item.style.transform = 'translateY(0)';
        }, index * 150);
    });
});

// Optional: Add click functionality to gallery items
document.querySelectorAll('.gallery-item').forEach(item => {
    item.addEventListener('click', function() {
        // You can add lightbox functionality here
        console.log('Gallery item clicked');
    });
});
</script>