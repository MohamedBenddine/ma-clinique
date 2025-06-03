<nav class="navbar navbar-expand-lg bg-light fixed-top shadow-lg">
                <div class="container">
                    <a class="navbar-brand mx-auto d-lg-none" href="index.php">
                       Ma Clinique
                        <strong class="d-block">Ma Clinique</strong>
                    </a>

                    <a class="navbar-brand d-none d-lg-block" href="index.php">
                                Ma Clinique
                                <strong class="d-block">Ma Clinique</strong>
                            </a>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarNav">
                               
                         <!-- مكانه: مثلاً داخل الهيدر أو النافبار -->
<div class="language-selector text-end p-2">
  <select id="language-select" onchange="changeLanguage()" class="form-select w-auto d-inline-block">
    <option value="en">English</option>
    <option value="ar">العربية</option>
  </select>
</div>




<ul class="navbar-nav mx-auto">
  <li class="nav-item">
    <a class="nav-link" href="#about" data-en="About" data-ar="من نحن">About</a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="check-appointment.php" data-en="Check Appointment" data-ar="تحقق من الموعد">Check Appointment</a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="booking.php" data-en="Appointment" data-ar="حجز موعد">Appointment</a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="#contact" data-en="Contact" data-ar="اتصل بنا">Contact</a>
  </li>

  <li class="nav-item active">
    <a class="nav-link" href="doctor/login.php" data-en="Doctor Login" data-ar="تسجيل دخول الطبيب">Doctor Login</a>
  </li>
</ul>

                    </div>

                </div>
            </nav>
            <script>
function changeLanguage() {
  var lang = document.getElementById("language-select").value;
  var elements = document.querySelectorAll('[data-en]');

  elements.forEach(function(el) {
    el.textContent = el.getAttribute('data-' + lang);
  });

  // خيار اتجاه الصفحة في حالة اللغة العربية
  if (lang === "ar") {
    document.body.dir = "rtl";
    document.body.style.textAlign = "right";
  } else {
    document.body.dir = "ltr";
    document.body.style.textAlign = "left";
  }
}
</script>
