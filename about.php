<?php
session_start();
include('doctor/includes/dbconnection.php');
?>

<!doctype html>
<html lang="en">

<head>
    <title>Ma Clinique|| About Us</title>
    <!-- CSS FILES -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link href="css/templatemo-medic-care.css" rel="stylesheet">
    <link rel="stylesheet" href="css/global.css">
</head>

<body id="top">
    <main>
        <?php include_once('includes/header.php'); ?>
        
        <?php 
        $param1 = 'white'; // White background for standalone about page
        include_once('includes/about.php');
        ?>
    </main>

    <?php include_once('includes/footer.php'); ?>

    <!-- JAVASCRIPT FILES -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/custom.js"></script>
</body>

</html>