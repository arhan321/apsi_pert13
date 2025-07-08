<?php
session_start();
require_once 'conn.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul = trim($_POST['judul']);
    $deskripsi = trim($_POST['deskripsi']);
    $user_id = $_SESSION['user_id']; 

    if (empty($judul) || empty($deskripsi)) {
        $error = "Judul dan deskripsi tidak boleh kosong.";
    } else {
        $stmt = $pdo->prepare("INSERT INTO blog (judul, deskripsi, user_id) VALUES (?, ?, ?)");
        if ($stmt->execute([$judul, $deskripsi, $user_id])) {
            header("Location: index.php");
            exit;
        } else {
            $error = "Terjadi kesalahan saat menyimpan data.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=s, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/style/tambah_blog.css">
</head>
<body>

<div class="form-container">
    <h2>
        tambah postingan blog
    </h2>
</div>
<?php if (!empty($error)): ?>
    <div class="message error"> <?= htmlspecialchars($error) ?> </div>
<?php endif; ?>

<form method="POST" action="">
    <label for="judul"> judul:</label>
    <input type="text" id="judul" required>

    <label for="deskripsi"> deskripsi</label>
    <textarea name="deskripsi" name="deskripsi"></textarea>

    <button type="submit"> simpan</button>

    <a class="back-link" href="index.php">kembali ke beranda</a>
</form>
    
</body>
</html>