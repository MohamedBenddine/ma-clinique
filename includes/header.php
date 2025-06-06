<?php
require_once 'translations.php';
$currentLang = getCurrentLang();
$isRTL = isRTL();
?>

<nav class="navbar navbar-expand-lg navbar-custom fixed-top" <?php echo $isRTL ? 'dir="rtl"' : 'dir="ltr"'; ?>>
    <div class="container">
        <a class="navbar-brand mx-auto d-lg-none" href="index.php">
            <span class="brand-text"><?php echo t('ma_clinique'); ?></span>
            <strong class="brand-tagline d-block"><?php echo t('healthcare_excellence'); ?></strong>
        </a>

        <a class="navbar-brand d-none d-lg-block" href="index.php">
            <span class="brand-text"><?php echo t('ma_clinique'); ?></span>
            <strong class="brand-tagline d-block"><?php echo t('healthcare_excellence'); ?></strong>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <!-- Language Selector -->
            <div class="language-selector <?php echo $isRTL ? 'me-auto ms-3' : 'ms-auto me-3'; ?>">
                <button class="language-btn" onclick="changeLanguage()">
                    <?php echo $currentLang === 'ar' ? '🇸🇦 AR' : '🇺🇸 EN'; ?>
                </button>
            </div>

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link nav-link-custom" href="about.php">
                        <?php echo t('about'); ?>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link nav-link-custom" href="check-appointment.php">
                        <?php echo t('check_appointment'); ?>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link nav-link-custom" href="booking.php">
                        <?php echo t('appointment'); ?>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link nav-link-custom" href="contactus.php">
                        <?php echo t('contact'); ?>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link nav-link-custom doctor-login" href="doctor/login.php">
                        <?php echo t('doctor_login'); ?>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<style>
/* Simple Navbar */
.navbar-custom {
    background: white;
    transition: all 0.3s ease;
    padding: 1rem 0;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

/* Scrolled State - Simple Blue */
.navbar-custom.scrolled {
    background: #0099ff;
    padding: 0.5rem 0;
}

/* Brand */
.navbar-brand {
    color: #0099ff !important;
    font-weight: 700;
    text-decoration: none;
}

.navbar-custom.scrolled .navbar-brand {
    color: white !important;
}

.brand-text {
    font-size: 1.5rem;
    font-weight: 800;
}

.brand-tagline {
    font-size: 0.7rem;
    color: #666;
}

.navbar-custom.scrolled .brand-tagline {
    color: rgba(255,255,255,0.8);
}

/* Navigation Links */
.nav-link-custom {
    color: #333 !important;
    font-weight: 500;
    padding: 0.5rem 1rem !important;
    transition: all 0.3s ease;
}

.nav-link-custom:hover {
    color: #0099ff !important;
}

.navbar-custom.scrolled .nav-link-custom {
    color: white !important;
}

.navbar-custom.scrolled .nav-link-custom:hover {
    color: #ffd700 !important;
}

/* Doctor Login */
.doctor-login {
    color: #0099ff !important;
    font-weight: 600;
}

.doctor-login:hover {
    color: #0077cc !important;
}

.navbar-custom.scrolled .doctor-login {
    color: #ffd700 !important;
}

.navbar-custom.scrolled .doctor-login:hover {
    color: white !important;
}

/* Simple Language Button */
.language-btn {
    background: none;
    border: 2px solid #0099ff;
    color: #0099ff;
    padding: 0.4rem 0.8rem;
    border-radius: 8px;
    font-size: 0.9rem;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
}

.language-btn:hover {
    background: #0099ff;
    color: white;
}

.navbar-custom.scrolled .language-btn {
    border-color: white;
    color: white;
}

.navbar-custom.scrolled .language-btn:hover {
    background: white;
    color: #0099ff;
}

/* RTL Support */
[dir="rtl"] .navbar-nav {
    flex-direction: row-reverse;
}

[dir="rtl"] .nav-link-custom,
[dir="rtl"] .navbar-brand,
[dir="rtl"] .language-btn {
    font-family: 'Cairo', 'Tajawal', Arial, sans-serif;
}

/* Mobile */
@media (max-width: 991px) {
    .navbar-nav {
        text-align: center;
        margin-top: 1rem;
    }
    
    .brand-text {
        font-size: 1.3rem;
    }
    
    .language-btn {
        margin-bottom: 1rem;
    }
}
</style>

<script>
function changeLanguage() {
    const currentLang = '<?php echo $currentLang; ?>';
    const newLang = currentLang === 'ar' ? 'en' : 'ar';
    
    if (newLang === "ar") {
        document.documentElement.dir = "rtl";
        document.documentElement.lang = "ar";
    } else {
        document.documentElement.dir = "ltr";
        document.documentElement.lang = "en";
    }
    
    fetch('set_language.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'language=' + newLang
    }).then(() => {
        window.location.reload();
    });
}

// Simple scroll effect
window.addEventListener('scroll', function() {
    const navbar = document.querySelector('.navbar-custom');
    if (window.scrollY > 50) {
        navbar.classList.add('scrolled');
    } else {
        navbar.classList.remove('scrolled');
    }
});

// Set initial language
document.addEventListener('DOMContentLoaded', function() {
    const currentLang = '<?php echo $currentLang; ?>';
    if (currentLang === "ar") {
        document.documentElement.dir = "rtl";
        document.documentElement.lang = "ar";
    }
});
</script>
