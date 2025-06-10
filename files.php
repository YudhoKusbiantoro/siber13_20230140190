<!DOCTYPE html>
<html>
<head>
    <title>Daftar File</title>
    <style>
        body {
            font-family: sans-serif;
            background: #f4f4f4;
            padding: 20px;
        }
        .container {
            background: white;
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .file-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 10px;
            border-bottom: 1px solid #ddd;
        }
        .file-info {
            display: flex;
            align-items: center;
        }
        .file-info img {
            width: 28px;
            height: auto;
            margin-right: 12px;
        }
        .btn {
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-left: 5px;
        }
        .btn-download {
            background: #28a745;
            color: white;
        }
        .btn-delete {
            background: #dc3545;
            color: white;
        }
        .back-link {
            text-decoration: none;
            color: #007bff;
            display: inline-block;
            margin-bottom: 15px;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>📁 Daftar File yang Telah Diunggah</h2>
    <a href="index.html" class="back-link">⬅ Kembali ke Unggah</a>
    <hr>

    <?php
    $dir = "uploads/";
    if (!file_exists($dir)) {
        echo "<p>Belum ada file yang diunggah.</p>";
        exit;
    }

    $files = array_diff(scandir($dir), ['.', '..']);
    if (empty($files)) {
        echo "<p>Tidak ada file.</p>";
    } else {
        foreach ($files as $file) {
            $path = $dir . $file;
            $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            $icon = '';

            // Pilih ikon berdasarkan jenis file
            if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])) {
                $icon = 'https://cdn-icons-png.flaticon.com/512/337/337940.png';
            } else if ($ext === 'pdf') {
                $icon = 'https://cdn-icons-png.flaticon.com/512/337/337946.png';
            } else {
                $icon = 'https://cdn-icons-png.flaticon.com/512/564/564619.png';
            }

            echo "<div class='file-item'>
                    <div class='file-info'>
                        <img src='$icon' alt='icon'>
                        <span>$file</span>
                    </div>
                    <div>
                        <a href='$path' download class='btn btn-download'>Unduh</a>
                        <button onclick=\"hapusFile('$file')\" class='btn btn-delete'>Hapus</button>
                    </div>
                  </div>";
        }
    }
    ?>

    <script>
    function hapusFile(namaFile) {
        if (confirm("Yakin ingin menghapus " + namaFile + "?")) {
            fetch("delete.php?file=" + encodeURIComponent(namaFile))
                .then(res => res.text())
                .then(alert)
                .then(() => location.reload());
        }
    }
    </script>
</div>
</body>
</html>
