<?php
if (isset($_GET['file'])) {
    $filePath = $_GET['file'];

    // Periksa apakah file ada
    if (file_exists($filePath)) {
        header('Content-Description: File Transfer');
        header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
        header('Content-Type: application/octet-stream');
        header('Content-Length: ' . filesize($filePath));
        readfile($filePath);
        exit();
    } else {
        echo "File tidak ditemukan!";
    }
} else {
    echo "Invalid request!";
}
?>
