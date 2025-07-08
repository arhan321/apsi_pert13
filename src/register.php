<?php
require_once 'conn.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name         = trim($_POST["name"]);
    $raw_password = trim($_POST["password"]);

    if (empty($name) || empty($raw_password)) {
        $error = "Nama dan password tidak boleh kosong.";
    } else {
        $stmt = $pdo->prepare("SELECT id FROM login WHERE name = ?");
        $stmt->execute([$name]);

        if ($stmt->rowCount() > 0) {
            $error = "Nama pengguna sudah terdaftar. Silakan pilih nama lain.";
        } else {
            $hashed_password = password_hash($raw_password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO login (name, password) VALUES (?, ?)");

            if ($stmt->execute([$name, $hashed_password])) {
                $success = "Registrasi berhasil. Silakan login.";
            } else {
                $error = "Terjadi kesalahan saat menyimpan data.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/style/register.css">
</head>
<body>

<div class="form-container">
    <h2>form register</h2>

    <?php if (!empty($error)): ?>
        <div class="error-message">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>
    <?php if (!empty($success)): ?>
        <div class="success-message">
            <?php echo $success; ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="">
        <label for="name">Nama pengguna:</label>
        <input type="text" id="name" name="name" required>

        <label for="password">Kata sandi:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Daftar</button>
        <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
    </form>

</div>
    
</body>
</html>