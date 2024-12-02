<?php
// Konfigurasi koneksi database
$conn = new mysqli("localhost", "root", "", "test_db");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Proses jika form dikirim
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $comment = $_POST['comment'];
    $imagePath = null;

    // Proses upload file
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $targetDir = "uploads/";
        $fileName = basename($_FILES['image']['name']);
        $targetFilePath = $targetDir . $fileName;

        // Pindahkan file ke folder uploads/
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
            $imagePath = $targetFilePath;
        }
    }

    // Simpan data ke database
    $stmt = $conn->prepare("INSERT INTO comments (email, comment, image_path) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $email, $comment, $imagePath);
    $stmt->execute();
    $stmt->close();

    // Redirect ke daftar komentar
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Komentar Baru</title>
</head>
<body>
    <h1>Tambah Komentar Baru</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="comment">Komentar:</label><br>
        <textarea id="comment" name="comment" required></textarea><br><br>

        <label for="image">Gambar (opsional):</label><br>
        <input type="file" id="image" name="image"><br><br>

        <button type="submit">Kirim Komentar</button>
        <a href="index.php">Kembali ke Daftar</a>
    </form>
</body>
</html>
