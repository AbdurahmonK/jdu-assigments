<?php
    if (!isset($_COOKIE['user']) || $_COOKIE['user'] !== 'admin') {
        header("Location: index.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Paneli</title>
    <style>
        body { font-family: sans-serif; text-align: center; padding: 50px; background-color: #e6ffe6; }
        h1 { color: #28a745; }
        .logout-btn { padding: 10px 20px; background-color: #dc3545; color: white; border: none; border-radius: 5px; cursor: pointer; text-decoration: none; }
        .logout-btn:hover { background-color: #c82333; }
    </style>
</head>
<body>
    <h1>Xush kelibsiz, Admin!</h1>
    <p>Bu sizning admin paneli.</p>
    <a href="logout.php" class="logout-btn">Chiqish</a>
</body>
</html>