<?php
include('doctor/includes/dbconnection.php');
require_once('includes/translations.php');

if (isset($_POST['sp_id']) && !empty($_POST['sp_id'])) {
    try {
        $specialization = $_POST['sp_id'];
        $sql = "SELECT ID, FullName FROM tbldoctor WHERE Specialization = ? ORDER BY FullName";
        $stmt = $dbh->prepare($sql);
        $stmt->execute([$specialization]);
        
        echo '<option value="">' . t('select_doctor') . '</option>';
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<option value="' . htmlspecialchars($row['ID']) . '">' . htmlspecialchars($row['FullName']) . '</option>';
        }
        
    } catch (Exception $e) {
        echo '<option value="">' . t('error_loading_doctors') . '</option>';
    }
} else {
    echo '<option value="">' . t('select_specialization_first') . '</option>';
}
?>