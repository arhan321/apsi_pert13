<?php 
session_start();
require_once 'conn.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$stmt = $pdo->prepare("
SELECT blog.*, login.name AS penulis 
FROM blog 
JOIN 
login ON blog.user_id = login.id 
ORDER BY blog.created_at DSC
");
$stmt->execute();
$blogs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <link rel="stylesheet" href="/style/indexs.css">
</head>
<body>
    
</body>
</html>