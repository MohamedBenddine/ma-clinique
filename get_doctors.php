<?php
include('doctor/includes/dbconnection.php');

if (isset($_POST['sp_id'])) {
    $specialization = $_POST['sp_id'];
    // Try to match both numeric ID and specialization name
    $sql = "SELECT ID, FullName FROM tbldoctor WHERE Specialization = :spec OR Specialization = (SELECT Specialization FROM tblspecialization WHERE ID = :spec)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':spec', $specialization, PDO::PARAM_STR);
    $query->execute();
    echo '<option value="">Select Doctor</option>';
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        echo '<option value="' . $row['ID'] . '">' . htmlspecialchars($row['FullName']) . '</option>';
    }
}
?>