<?php
if (isset($_GET['file'])) {
    $file = basename($_GET['file']);
    $path = "uploads/" . $file;
    if (file_exists($path)) {
        unlink($path);
        echo "File berhasil dihapus.";
    } else {
        echo "File tidak ditemukan.";
    }
}
?>
