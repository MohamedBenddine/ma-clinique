<?php
session_start();
//error_reporting(0);
include('doctor/includes/dbconnection.php');

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $mobnum = $_POST['phone'];
    $email = $_POST['email'];
    $appdate = $_POST['date'];
    $specialization = $_POST['specialization'];
    $doctorlist = $_POST['doctorlist'];
    $aptnumber = mt_rand(100000000, 999999999);
    $cdate = date('Y-m-d');

    if ($appdate <= $cdate) {
        echo '<script>alert("Appointment date must be greater than todays date")</script>';
    } else {
        $sql = "INSERT INTO tblappointment(AppointmentNumber, Name, MobileNumber, Email, AppointmentDate, Specialization, Doctor) 
                VALUES (:aptnumber, :name, :mobnum, :email, :appdate, :specialization, :doctorlist)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':aptnumber', $aptnumber, PDO::PARAM_STR);
        $query->bindParam(':name', $name, PDO::PARAM_STR);
        $query->bindParam(':mobnum', $mobnum, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':appdate', $appdate, PDO::PARAM_STR);
        $query->bindParam(':specialization', $specialization, PDO::PARAM_STR);
        $query->bindParam(':doctorlist', $doctorlist, PDO::PARAM_INT);
        $query->execute();

        $LastInsertId = $dbh->lastInsertId();
        if ($LastInsertId > 0) {
            echo '<script>alert("Your Appointment Request Has Been Send. We Will Contact You Soon")</script>';
            echo "<script>window.location.href ='index.php'</script>";
        } else {
            echo '<script>alert("Something Went Wrong. Please try again")</script>';
        }
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <title>Ma Clinique|| Home Page</title>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            new Splide('#image-carousel', {
                type: 'loop',
                perPage: 1,
                perMove: 1,
                gap: '0',
                width: '100%',
                height: '500px',
                direction: 'ltr',
                pagination: false,
                arrows: false,
                autoplay: true,
                interval: 3000,
                speed: 1000,
                easing: 'cubic-bezier(0.25, 1, 0.5, 1)',
                autoScroll: {
                    pauseOnHover: false,
                    pauseOnFocus: false,
                    rewind: false,
                    speed: 2,
                },
            }).mount(window.splide.Extensions);
        });
    </script>

    <!-- CSS FILES -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-icons.css" rel="stylesheet">
    <link href="css/owl.carousel.min.css" rel="stylesheet">
    <link href="css/owl.theme.default.min.css" rel="stylesheet">
    <link href="css/templatemo-medic-care.css" rel="stylesheet">
    <link href="css/global.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.3/dist/css/splide.min.css">
    <style>
        .splide__slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .bg-blue {
            background-color: #0099ff;
            /* لون الخلفية الأزرق */
        }

        .galleryImage {
            width: 100%;
            height: 300px;
            /* أو أي ارتفاع يناسب التصميم */
            object-fit: cover;
            border-radius: 8px;
            /* اختياري: يجعل الزوايا ناعمة */
        }

        .carousel-inner {
            height: 400px;
            /* يمكنك تعديله حسب الحاجة */
            background-color: #000;
            /* يساعد في ملء الخلفية عند وجود فراغات */
        }

        .carouselImage {
            width: 100%;
            height: 100%;
            object-fit: contain;
            /* ✅ عرض الصورة كاملة دون قص */
        }

        .carousel-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.7), transparent);
            z-index: 10;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 2rem;
        }

        .carousel-heading {
            color: white;
            text-align: center;
            font-weight: bold;
            font-size: 2.5rem;
            margin-top: 60px;
        }

        .carousel-buttons {
            display: flex;
            justify-content: center;
            gap: 1rem;
        }

        .appoint-button {
            background-color: #007bff;
            color: white;
            padding: 1rem 2rem;
            border-radius: 9999px;
            border: none;
            font-weight: 600;
            font-size: 1.125rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .appoint-button:hover {
            background-color: #0056b3;
        }

        .splide {
            position: relative;
        }

        .carouselImage {
            width: 100%;
            height: 100%;
            object-fit: cover;

        }
    </style>

    <script>
        function getdoctors(val) {
            $.ajax({
                type: "POST",
                url: "get_doctors.php",
                data: 'sp_id=' + val,
                success: function (data) {
                    $("#doctorlist").html(data);
                }
            });
        }
    </script>
</head>

<body id="top">

    <main>

        <?php include_once('includes/header.php'); ?>

        <section class="hero" id="hero">
            <div class="container hidden">
                <div class="row">
                    <div class="col-12">
                        <div id="myCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel"
                            data-bs-interval="3000">

                            <div class="carousel-inner">

                                <div class="carousel-item active">
                                    <img src="images/slider/home.jpg" class="carouselImage" alt="">
                                </div>

                                <div class="carousel-item">
                                    <img src="images/slider/home3.jpg" class="carouselImage" alt="">
                                </div>

                                <div class="carousel-item">
                                    <img src="images/slider/home2.jpg" class="carouselImage" alt="">
                                </div>

                                <div class="carousel-item">
                                    <img src="images/slider/about1.jpg" class="carouselImage" alt="">
                                </div>

                                <div class="carousel-item">
                                    <img src="images/slider/about2.jpg" class="carouselImage" alt="">
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="image-carousel" class="splide" aria-label="Beautiful Images">
            <div class="splide__track">
                <ul class="splide__list">
                    <!-- <li class="splide__slide">
                        <img src="images/slider/home.jpg" class="carouselImage" alt="">
                    </li>
                    <li class="splide__slide">
                        <img src="images/slider/home3.jpg" class="carouselImage" alt="">
                    </li>
                    <li class="splide__slide">
                        <img src="images/slider/home2.jpg" class="carouselImage" alt="">
                    </li>
                    <li class="splide__slide">
                        <img src="images/slider/about.jpg" class="carouselImage" alt="">
                    </li>
                    <li class="splide__slide">
                        <img src="images/slider/about2.jpg" class="carouselImage" alt="">
                    </li> -->
                    <li class="splide__slide">
                        <div class="carouselImage">mmmm</div>
                    </li>
                </ul>
            </div>
            <div class="carousel-overlay">
                <h2 class="carousel-heading">
                    APPOINTMENTS AVAILABLE
                    <p style="font-size: 1.5rem; margin-top: 0.5rem;">Book Your Visit Today</p>
                </h2>
                <div class="carousel-buttons">
                    <a href="booking.php" class="appoint-button">APPOINT NOW</a>
                </div>
            </div>
        </section>

        <section class="section-padding" id="about">
            <div class="container">
                <div class="row">

                    <div class="col-lg-6 col-md-6 col-12">
                        <?php
                        $sql = "SELECT * from tblpage where PageType='aboutus'";
                        $query = $dbh->prepare($sql);
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);

                        $cnt = 1;
                        if ($query->rowCount() > 0) {
                            foreach ($results as $row) {
                                ?>
                                <h2 class="mb-lg-3 mb-3"><?php echo htmlentities($row->PageTitle); ?></h2>
                                <p><?php echo ($row->PageDescription); ?>.</p>
                                <?php
                                $cnt = $cnt + 1;
                            }
                        }
                        ?>
                    </div>

                    <div class="col-lg-4 col-md-5 col-12 mx-auto">
                        <div
                            class="featured-circle bg-white shadow-lg d-flex justify-content-center align-items-center">
                            <p class="featured-text"><span class="featured-number">3 Licence</span> Ouarnoughi-Benddine
                                <br>
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <img src="images/assets/wave-up.svg" alt="mamchatch">
        <section class="gallery bg-blue">
            <div class="container">
                <div class="row">
                    <!-- الصف الأول -->
                    <div class="col-lg-6 col-6 mb-3">
                        <img src="images/gallery/doc.jpg" class="galleryImage" alt="get a vaccine">
                    </div>

                    <div class="col-lg-6 col-6 mb-3">
                        <img src="images/gallery/contact.jpg" class="galleryImage" alt="wear a mask">
                    </div>

                    <!-- الصف الثاني -->
                    <div class="col-lg-6 col-6">
                        <img src="images/gallery/about.jpg" class="galleryImage" alt="get a vaccine">
                    </div>

                    <div class="col-lg-6 col-6">
                        <img src="images/gallery/about2.jpg" class="galleryImage" alt="get a vaccine">
                    </div>
                </div>
            </div>
        </section>
        <div>
            <img src="images/assets/wave-down.svg" alt="mamchatch">
        </div>
        </div>
        </div>
        </section>
    </main>

    <?php include_once('includes/footer.php'); ?>

    <!-- JAVASCRIPT FILES -->
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide-extension-auto-scroll@0.5.3/dist/js/splide-extension-auto-scroll.min.js
"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/scrollspy.min.js"></script>
    <script src="js/custom.js"></script>
    <script>
        function changeLanguage() {
            var lang = document.getElementById("language-select").value;
            var elements = document.querySelectorAll('[data-en]');

            elements.forEach(function (el) {
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


</body>

</html>