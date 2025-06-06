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

<style>
/* Stats Section Styles - Simple & Modern */
.bg-blue {
    /* background: #0099ff; */
    background: none;
    position: relative;
    overflow: hidden;
}

.stats-card {
    /* background: rgba(255, 255, 255, 0.15); */
    background: #0099ff;
    opacity: 0.9;
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 15px;
    padding: 2rem 1.5rem;
    text-align: center;
    transition: all 0.3s ease;
    position: relative;
    z-index: 2;
    height: 180px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    border :none;
}

.stats-card:hover {
    /* background: rgba(255, 255, 255, 0.25); */
    /* background: #007acc; */
    /* opacity: 0.8; */
    /* border: 3px solid #fff; */
    transform: translateY(-5px);
    outline: none;
    /* border-color: rgba(255, 255, 255, 0.3); */
}

.stats-icon {
    font-size: 2.5rem;
    color: white;
    margin-bottom: 1rem;
    transition: all 0.3s ease;
}

.stats-card:hover .stats-icon {
    transform: scale(1.1);
}

.stats-number {
    font-size: 2.5rem;
    font-weight: 700;
    color: white;
    margin-bottom: 0.5rem;
    line-height: 1;
}

.stats-text {
    color: rgba(255, 255, 255, 0.9);
    font-size: 1rem;
    font-weight: 500;
    margin: 0;
}

/* Simple animation */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.stats-card {
    animation: fadeInUp 0.5s ease-out;
}

.stats-card:nth-child(1) { animation-delay: 0.1s; }
.stats-card:nth-child(2) { animation-delay: 0.2s; }
.stats-card:nth-child(3) { animation-delay: 0.3s; }
.stats-card:nth-child(4) { animation-delay: 0.4s; }

/* RTL Support for Stats */
[dir="rtl"] .stats-text,
[dir="rtl"] .stats-number {
    font-family: 'Cairo', 'Tajawal', Arial, sans-serif;
}

[dir="rtl"] .stats-card {
    font-family: 'Cairo', 'Tajawal', Arial, sans-serif;
}

/* Responsive Design */
@media (max-width: 768px) {
    .stats-card {
        height: 160px;
        padding: 1.5rem 1rem;
        margin-bottom: 2rem;
    }
    
    .stats-icon {
        font-size: 2rem;
        margin-bottom: 0.8rem;
    }
    
    .stats-number {
        font-size: 2rem;
    }
    
    .stats-text {
        font-size: 0.9rem;
    }
}

@media (max-width: 576px) {
    .stats-card {
        height: 140px;
        padding: 1rem;
    }
    
    .stats-icon {
        font-size: 1.8rem;
    }
    
    .stats-number {
        font-size: 1.8rem;
    }
    
    .stats-text {
        font-size: 0.8rem;
    }
}

/* Mobile hover adjustments */
@media (hover: none) {
    .stats-card:hover {
        transform: none;
        background: rgba(255, 255, 255, 0.15);
    }
    
    .stats-card:hover .stats-icon {
        transform: none;
    }
}
</style>