<?php
$target_dir = "uploads/";
if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
}

$success = 0;
$failed = 0;

foreach ($_FILES["files"]["name"] as $index => $name) {
    $tmp = $_FILES["files"]["tmp_name"][$index];
    $size = $_FILES["files"]["size"][$index];
    $error = $_FILES["files"]["error"][$index];
    $target_file = $target_dir . basename($name);

    if ($error !== UPLOAD_ERR_OK) {
        $failed++;
        continue;
    }

    if ($size > 5 * 1024 * 1024) {
        $failed++;
        continue;
    }

    if (!move_uploaded_file($tmp, $target_file)) {
        $failed++;
    } else {
        $success++;
    }
}

header("Location: files.php");
exit;
?>
