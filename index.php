<?php
session_start();
//error_reporting(0);
include('doctor/includes/dbconnection.php');

?>

<!doctype html>
<html lang="en">

<head>
    <title>Ma Clinique|| Home Page</title>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            new Splide('.splide', {
                type: "loop",
          perPage: 1,
          perMove: 1,
          gap: "0",
          width: "100%",
          height: "500px",
          direction: "ltr",
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
          height: "500px",
          direction: "ltr",
          pagination: false,
          arrows: false,
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">    <link href="css/owl.carousel.min.css" rel="stylesheet">
    <link href="css/templatemo-medic-care.css" rel="stylesheet">
    <link rel="stylesheet" href="css/global.css" >
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

<body id="top">

    <main class="main-wrapper">

        <?php include_once('includes/header.php'); ?>

        <?php include_once('includes/slideshow.php'); ?>
      
            <?php include_once('includes/immediate.php'); ?>

        
        
        <?php include_once('includes/services.php'); ?>
        
        <!-- <img src="images/assets/wave-up.svg" alt="mamchatch">
        
        <img src="images/assets/wave-down.svg" alt="mamchatch"> -->
        
        
        <img src="images/assets/wave-up.svg" alt="mamchatch">
        
        <?php 
        $param1 = '#0099ff';
        include_once('includes/about.php');
        ?>
         
         <?php include_once('includes/gallery.php'); ?>
         <?php include_once('includes/stats.php'); ?>
        <img src="images/assets/wave-down.svg" alt="mamchatch">

        <?php include_once('includes/contactus.php'); ?>
    
    </main>

    <?php include_once('includes/footer.php'); ?>

    <!-- JAVASCRIPT FILES -->
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide-extension-auto-scroll@0.5.3/dist/js/splide-extension-auto-scroll.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.3/dist/js/splide.min.js"></script>
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