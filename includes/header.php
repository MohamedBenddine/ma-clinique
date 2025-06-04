<nav class="navbar navbar-expand-lg navbar-custom fixed-top shadow-lg">
    <div class="container">
        <a class="navbar-brand mx-auto d-lg-none" href="index.php">
            <span class="brand-text">Ma Clinique</span>
            <strong class="brand-tagline d-block">Healthcare Excellence</strong>
        </a>

        <a class="navbar-brand d-none d-lg-block" href="index.php">
            <span class="brand-text">Ma Clinique</span>
            <strong class="brand-tagline d-block">Healthcare Excellence</strong>
        </a>

        <button class="navbar-toggler custom-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <!-- Language Selector -->
            <div class="language-selector ms-auto me-3">
                <!-- <select id="language-select" onchange="changeLanguage()" class="language-select-custom">
                    <option value="en">🇺🇸 EN</option>
                    <option value="ar">🇸🇦 AR</option>
                </select> -->
            </div>

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link nav-link-custom" href="about.php" data-en="About" data-ar="من نحن">
                        About
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link nav-link-custom" href="check-appointment.php" data-en="Check Appointment" data-ar="تحقق من الموعد">
                        Check Appointment
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link nav-link-custom pappointment-btn" href="booking.php" data-en="Appointment" data-ar="حجز موعد">
                        Book Now
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link nav-link-custom" href="#contact" data-en="Contact" data-ar="اتصل بنا">
                        Contact
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link nav-link-custom doctor-login" href="doctor/login.php" data-en="Doctor Login" data-ar="تسجيل دخول الطبيب">
                        Doctor Portal
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<style>
.navbar-custom {
    background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
    backdrop-filter: blur(10px);
    padding: 1.2rem 0;
    transition: all 0.3s ease;
}

.navbar-custom.scrolled {
    background: rgba(255, 255, 255, 0.95);
    padding: 0.5rem 0;
}

.navbar-brand {
    color: #0099ff !important;
    font-weight: 700;
    font-size: 1.5rem;
    text-decoration: none;
    transition: transform 0.3s ease;
}

.navbar-brand:hover {
    transform: scale(1.05);
    color: #0077cc !important;
}

.brand-text {
    font-size: 1.8rem;
    font-weight: 800;
    background: linear-gradient(45deg, #0099ff, #0077cc);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.brand-tagline {
    font-size: 0.75rem;
    color: #6c757d;
    font-weight: 400;
    margin-top: -5px;
}

.custom-toggler {
    border: 1px solid #dee2e6;
    border-radius: 4px;
    padding: 0.5rem;
}

.custom-toggler:focus {
    box-shadow: none;
}

.navbar-toggler-icon {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='%23495057' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
}

.language-selector {
    position: relative;
}

.language-select-custom {
    background: #0099ff;
    color: white;
    border: none;
    border-radius: 20px;
    padding: 0.4rem 0.8rem;
    font-size: 0.85rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    appearance: none;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='white' viewBox='0 0 16 16'%3e%3cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right 0.5rem center;
    background-size: 12px;
    padding-right: 2rem;
}

.language-select-custom:hover {
    background: #0077cc;
    transform: translateY(-1px);
}

.nav-link-custom {
    color: #495057 !important;
    font-weight: 500;
    padding: 0.5rem 1rem !important;
    transition: color 0.3s ease;
    text-decoration: none;
}

.nav-link-custom:hover {
    color: #0099ff !important;
}

.appointment-btn {
    background: #0099ff !important;
    color: white !important;
    font-weight: 600;
    border-radius: 25px;
}

.appointment-btn:hover {
    background: #0077cc !important;
    color: white !important;
}

.doctor-login {
    color: #0099ff !important;
    font-weight: 600;
}

.doctor-login:hover {
    color: #0077cc !important;
}

/* Responsive Design */
@media (max-width: 991px) {
    .navbar-nav {
        text-align: center;
        margin-top: 1rem;
    }
    
    .nav-link-custom {
        margin: 0.2rem 0;
    }
    
    .language-selector {
        text-align: center;
        margin-bottom: 1rem;
    }
    
    .brand-text {
        font-size: 1.5rem;
    }
}

/* Smooth scroll behavior */
html {
    scroll-behavior: smooth;
}

/* Add scroll effect */
.navbar-custom.scrolled {
    animation: slideDown 1.2s ease;
}

@keyframes slideDown {
    from {
        transform: translateY(-100%);
    }
    to {
        transform: translateY(0);
    }
}
</style>

<script>
function changeLanguage() {
    var lang = document.getElementById("language-select").value;
    var elements = document.querySelectorAll('[data-en]');

    elements.forEach(function(el) {
        el.textContent = el.getAttribute('data-' + lang);
    });

    // Language direction handling
    if (lang === "ar") {
        document.body.dir = "rtl";
        document.body.style.textAlign = "right";
        document.querySelector('.navbar-nav').style.flexDirection = "row-reverse";
    } else {
        document.body.dir = "ltr";
        document.body.style.textAlign = "left";
        document.querySelector('.navbar-nav').style.flexDirection = "row";
    }
}

// Add scroll effect to navbar
window.addEventListener('scroll', function() {
    const navbar = document.querySelector('.navbar-custom');
    if (window.scrollY > 50) {
        navbar.classList.add('scrolled');
    } else {
        navbar.classList.remove('scrolled');
    }
});
</script>
