<?php 
session_start();
require_once 'conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $password = trim($_POST['password']);

    if(empty($name) || empty($raw_password)) {
        $error = "nama dan password wajib di isi";
    } else {
        $stmt = $pdo->prepare("SELECT * FROM login WHERE name = ?");
        $stmt->execute([$name]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ( $user && password_verify($raw_password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            header("Location: index.php");
            exit();
        } else {
            $error = "name atau password salah";
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
    <link rel="stylesheet" href="/style/login.css">
</head>
<body>
    
</body>
</html>