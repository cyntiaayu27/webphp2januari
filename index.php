<?php
// Konfigurasi koneksi database
$conn = new mysqli("localhost", "root", "", "test_db");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari database
$result = $conn->query("SELECT * FROM comments ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Komentar</title>
</head>
<body>
    <h1>Daftar Komentar</h1>
    <a href="form_comment.php">Tambah Komentar</a>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Email</th>
            <th>Komentar</th>
            <th>Gambar</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td><?= htmlspecialchars($row['comment']) ?></td>
            <td>
                <?php if ($row['image_path']): ?>
                    <a href="download.php?file=<?= urlencode($row['image_path']) ?>">Download Gambar</a>
                <?php else: ?>
                    Tidak ada
                <?php endif; ?>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
