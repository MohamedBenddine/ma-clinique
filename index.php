<?php
session_start();
require_once('includes/translations.php');
include('doctor/includes/dbconnection.php');

// Get current language and RTL status
$currentLang = getCurrentLang();
$isRTL = isRTL();
$carouselDirection = $isRTL ? 'rtl' : 'ltr';
?>

<!doctype html>
<html>

<head>
    <title>Ma Clinique|| Home Page</title>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            new Splide('.splide', {
                type: "loop",
                perPage: 1,
                perMove: 1,
                gap: "0",
                width: "100%",
                height: "500px",
                direction: "<?php echo $carouselDirection; ?>",
                pagination: false,
                arrows: false,
                autoScroll: {
                    pauseOnHover: false,
                    pauseOnFocus: false,
                    rewind: false,
                    speed: 2,
                },
            }).mount(window.splide.Extensions);

            new Splide('.services-splide', {
                type: "loop",
                perPage: 3,
                perMove: 1,
                gap: 40,
                width: "100%",
                height: "200px",
                direction: "<?php echo $carouselDirection; ?>",
                pagination: false,
                arrows: false,
                autoScroll: {
                    pauseOnHover: true,
                    pauseOnFocus: false,
                    rewind: false,
                    speed: 1.5,
                },
                breakpoints: {
                    768: {
                        perPage: 1,
                        gap: 20,
                    },
                    992: {
                        perPage: 2,
                        gap: 30,
                    }
                }
            }).mount(window.splide.Extensions);
        });
    </script>

    <!-- CSS FILES -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <!-- Add Arabic fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&family=Tajawal:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link href="css/owl.carousel.min.css" rel="stylesheet">
    <link href="css/templatemo-medic-care.css" rel="stylesheet">
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.3/dist/css/splide.min.css">

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

<body id="top" <?php echo $isRTL ? 'dir="rtl"' : 'dir="ltr"'; ?>>
<main class="main-wrapper">
    <?php include_once('includes/header.php'); ?>

    <?php include_once('includes/slideshow.php'); ?>

    <?php include_once('includes/immediate.php'); ?>
    
    <img src="images/assets/wave-haikei-down.svg" alt="mamchatch">


    <?php include_once('includes/services.php'); ?>

    <!-- <img src="images/assets/wave-up.svg" alt="mamchatch">

    <img src="images/assets/wave-down.svg" alt="mamchatch"> -->


    <img src="images/assets/wave-up.svg" alt="mamchatch">
    
    <?php 
    $param1 = '#0099ff';
    include_once('includes/about.php');
    ?>
    
    <?php include_once('includes/gallery.php'); ?>
    <img src="images/assets/wave-down.svg" alt="mamchatch">
    
    <?php include_once('includes/stats.php'); ?>
    <?php include_once('includes/contactus.php'); ?>
    
    <img src="images/assets/wave-haikei.svg" alt="mamchatch">
</main>

    <?php include_once('includes/footer.php'); ?>

    <!-- JAVASCRIPT FILES -->
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.3/dist/js/splide.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide-extension-auto-scroll@0.5.3/dist/js/splide-extension-auto-scroll.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery.sticky.js"></script>
    <script src="js/click-scroll.js"></script>
    <script src="js/custom.js"></script>

</body>
</html>