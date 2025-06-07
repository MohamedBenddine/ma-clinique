<?php
require_once 'translations.php';
require_once 'doctor/includes/dbconnection.php';
$currentLang = getCurrentLang();
$isRTL = isRTL();

// Fetch specializations from database
try {
    $sql = "SELECT ID, Specialization FROM tblspecialization ORDER BY Specialization ASC";
    $query = $dbh->prepare($sql);
    $query->execute();
    $specializations = $query->fetchAll(PDO::FETCH_OBJ);
} catch(Exception $e) {
    $specializations = [];
}

// Translation mapping for specializations
$specializationTranslations = [
    'Orthopedics' => [
        'en' => 'Orthopedics',
        'ar' => 'العظام',
        'icon' => 'bi bi-bandaid-fill',
        'desc_en' => 'Comprehensive bone, joint, and muscle care for all ages.',
        'desc_ar' => 'رعاية شاملة للعظام والمفاصل والعضلات لجميع الأعمار.'
    ],
    'Internal Medicine' => [
        'en' => 'Internal Medicine',
        'ar' => 'الباطنية',
        'icon' => 'bi bi-heart-pulse-fill',
        'desc_en' => 'Expert diagnosis and treatment of internal diseases.',
        'desc_ar' => 'تشخيص وعلاج متخصص للأمراض الباطنية.'
    ],
    'Obstetrics and Gynecology' => [
        'en' => 'Obstetrics & Gynecology',
        'ar' => 'النساء والتوليد',
        'icon' => 'bi bi-gender-female',
        'desc_en' => 'Complete women\'s health and maternity care.',
        'desc_ar' => 'رعاية صحية شاملة للنساء والأمومة.'
    ],
    'Dermatology' => [
        'en' => 'Dermatology',
        'ar' => 'الجلدية',
        'icon' => 'bi bi-droplet-fill',
        'desc_en' => 'Advanced skin, hair, and nail treatments.',
        'desc_ar' => 'علاجات متقدمة للجلد والشعر والأظافر.'
    ],
    'Pediatrics' => [
        'en' => 'Pediatrics',
        'ar' => 'طب الأطفال',
        'icon' => 'bi bi-emoji-smile-fill',
        'desc_en' => 'Specialized healthcare for infants, children, and teens.',
        'desc_ar' => 'رعاية صحية متخصصة للرضع والأطفال والمراهقين.'
    ],
    'Radiology' => [
        'en' => 'Radiology',
        'ar' => 'الأشعة',
        'icon' => 'bi bi-radioactive',
        'desc_en' => 'Advanced imaging and diagnostic services.',
        'desc_ar' => 'خدمات تصوير وتشخيص متقدمة.'
    ],
    'General Surgery' => [
        'en' => 'General Surgery',
        'ar' => 'الجراحة العامة',
        'icon' => 'bi bi-hospital-fill',
        'desc_en' => 'Expert surgical procedures with modern techniques.',
        'desc_ar' => 'إجراءات جراحية متخصصة بتقنيات حديثة.'
    ],
    'Ophthalmology' => [
        'en' => 'Ophthalmology',
        'ar' => 'طب العيون',
        'icon' => 'bi bi-eye-fill',
        'desc_en' => 'Complete eye care and vision correction.',
        'desc_ar' => 'رعاية شاملة للعيون وتصحيح البصر.'
    ],
    'Family Medicine' => [
        'en' => 'Family Medicine',
        'ar' => 'طب الأسرة',
        'icon' => 'bi bi-house-heart-fill',
        'desc_en' => 'Comprehensive healthcare for the whole family.',
        'desc_ar' => 'رعاية صحية شاملة لجميع أفراد الأسرة.'
    ],
    'Chest Medicine' => [
        'en' => 'Chest Medicine',
        'ar' => 'أمراض الصدر',
        'icon' => 'bi bi-wind',
        'desc_en' => 'Respiratory and lung disease treatment.',
        'desc_ar' => 'علاج أمراض الجهاز التنفسي والرئتين.'
    ],
    'Anesthesia' => [
        'en' => 'Anesthesia',
        'ar' => 'التخدير',
        'icon' => 'bi bi-capsule-pill',
        'desc_en' => 'Safe and comfortable anesthesia services.',
        'desc_ar' => 'خدمات تخدير آمنة ومريحة.'
    ],
    'Pathology' => [
        'en' => 'Pathology',
        'ar' => 'علم الأمراض',
        'icon' => 'bi bi-graph-up',
        'desc_en' => 'Accurate laboratory diagnosis and testing.',
        'desc_ar' => 'تشخيص مخبري دقيق وفحوصات.'
    ],
    'ENT' => [
        'en' => 'ENT',
        'ar' => 'الأنف والأذن والحنجرة',
        'icon' => 'bi bi-headphones',
        'desc_en' => 'Ear, nose, and throat specialist care.',
        'desc_ar' => 'رعاية متخصصة للأنف والأذن والحنجرة.'
    ]
];

// Function to get translated specialization data
function getSpecializationData($specialization, $currentLang, $translations) {
    if (isset($translations[$specialization])) {
        $data = $translations[$specialization];
        return [
            'name' => $data[$currentLang] ?? $specialization,
            'icon' => $data['icon'] ?? 'bi bi-hospital',
            'desc' => $data['desc_' . $currentLang] ?? $data['desc_en'] ?? 'Professional medical services available.'
        ];
    }
    
    // Fallback for unknown specializations
    return [
        'name' => $specialization,
        'icon' => 'bi bi-hospital',
        'desc' => $currentLang === 'ar' ? 'خدمات طبية متخصصة متاحة.' : 'Professional medical services available.'
    ];
}
?>

<section class="section-padding srvces-section" <?php echo $isRTL ? 'dir="rtl"' : 'dir="ltr"'; ?>>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2><?php echo $currentLang === 'ar' ? 'خدماتنا الطبية' : 'Our Medical Services'; ?></h2>
                <p class="lead"><?php echo $currentLang === 'ar' ? 'رعاية صحية شاملة ومتخصصة' : 'Comprehensive and specialized healthcare'; ?></p>
            </div>
        </div>
        
        <!-- Services Carousel -->
        <div id="services-carousel" class="splide services-splide" aria-label="<?php echo $currentLang === 'ar' ? 'خدماتنا الطبية' : 'Our Medical Services'; ?>">
            <div class="splide__track">
                <ul class="splide__list">
                    <?php 
                    if (!empty($specializations)) {
                        foreach ($specializations as $spec) {
                            $specData = getSpecializationData($spec->Specialization, $currentLang, $specializationTranslations);
                    ?>
                    <li class="splide__slide">
                        <div class="service-card">
                            <div class="service-icon">
                                <i class="<?php echo $specData['icon']; ?>"></i>
                            </div>
                            <h4>
                                <strong href="specialization.php?id=<?php echo $spec->ID; ?>&name=<?php echo urlencode($spec->Specialization); ?>" 
                                   class="service-link">
                                    <?php echo $specData['name']; ?>
                                </strong>
                            </h4>
                            <p><?php echo $specData['desc']; ?></p>
                        </div>
                    </li>
                    <?php 
                        }
                    } else {
                        // Fallback message if no specializations found
                        echo '<li class="splide__slide"><div class="service-card"><p>' . 
                             ($currentLang === 'ar' ? 'لا توجد خدمات متاحة حالياً.' : 'No services available at the moment.') . 
                             '</p></div></li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</section>

<style>
    body {
        overflow-x: hidden;
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
        transition: all 0.3s ease;
    }

    .service-card:hover {
        border: 2px solid #0099ff;
        box-shadow: 0 8px 30px rgba(0, 153, 255, 0.2);
        transform: translateY(-5px);
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
        transition: all 0.3s ease;
    }

    .service-card:hover .service-icon {
        transform: scale(1.1);
        box-shadow: 0 8px 20px rgba(0, 153, 255, 0.3);
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

    .service-link {
        color: #333;
        text-decoration: none;
        transition: all 0.3s ease;
        display: block;
    }

    .service-link:hover {
        color: #0099ff;
        text-decoration: none;
    }

    .service-card:hover .service-link {
        color: #0099ff;
    }

    .service-card p {
        color: #666;
        font-size: 0.95rem;
        line-height: 1.5;
        margin: 0;
    }

    /* RTL Support for Services */
    [dir="rtl"] .service-card {
        text-align: center;
    }

    [dir="rtl"] .service-card h4,
    [dir="rtl"] .service-card p,
    [dir="rtl"] .service-link {
        font-family: 'Cairo', 'Tajawal', Arial, sans-serif;
    }

    [dir="rtl"] h2 {
        font-family: 'Cairo', 'Tajawal', Arial, sans-serif;
    }

    [dir="rtl"] .lead {
        font-family: 'Cairo', 'Tajawal', Arial, sans-serif;
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

    /* Responsive Design */
    @media (max-width: 768px) {
        .services-splide {
            height: 320px;
        }
        
        .service-card {
            height: 300px;
            padding: 1.5rem;
        }
        
        .service-card h4 {
            font-size: 1.1rem;
        }
        
        .service-card p {
            font-size: 0.9rem;
        }
    }

    @media (max-width: 576px) {
        .service-card {
            margin: 0 2px;
        }
        
        h2 {
            font-size: 1.8rem;
        }
    }
</style>

