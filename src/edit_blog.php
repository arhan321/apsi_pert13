<?php 
session_start();
require_once 'conn.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['id']) || !is_numeric(($_GET['id']))) {
    echo "ID blog tidak valid.";
    exit;
}

$blog_id = (int) $_GET['id'];
$user_id = $_SESSION['user_id'];

if(!$blog) {
    echo "blog tidak di temukan";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $judul = trim($_POST['judul']);
    $deskripsi = trim($_POST['deskripsi']);

    if ($judul === '' || $deskripsi === '') {
        $error = "judul deskripsi tidak boleh kosong.";
    } else {
        $stmt = $pdo->prepare("UPDATE blog SET judul = ?, WHERE id = ? AND user_id = ?");
        $stmt->execute([$judul, $deskripsi, $blog_id, $user_id]);
        header("Location: index.php");
        exit;
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>