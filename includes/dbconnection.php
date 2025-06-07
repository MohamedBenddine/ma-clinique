<?php
// DB credentials.
$DB_host = "localhost";
$DB_user = "root";
$DB_pass = "";
$DB_name = "damsmsdb";

// Establish database connection.
try {
    $dbh = new PDO("mysql:host={$DB_host};dbname={$DB_name};charset=utf8mb4", $DB_user, $DB_pass, array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci"
    ));
} catch (PDOException $e) {
    exit("Error: " . $e->getMessage());
}
?>