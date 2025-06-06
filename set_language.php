<?php
session_start();

    if ($_POST && isset($_POST['language'])) {
    $language = $_POST['language'];
    
    // Validate language
    if (in_array($language, ['en', 'ar'])) {
        $_SESSION['language'] = $language;
        echo json_encode(['status' => 'success', 'language' => $language]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid language']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'No language specified']);
}
?>