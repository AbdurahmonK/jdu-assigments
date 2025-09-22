<?php
    session_start();

    if (!isset($_SESSION['username'])) {
        header("Location: register.php");
        exit();
    }

    $username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foydalanuvchi Dashbodi</title>
    <style>
        body { font-family: sans-serif; text-align: center; padding: 50px; background-color: #f8f9fa; }
        .dashboard-container { background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); display: inline-block; }
        h1 { color: #007bff; }
        p { font-size: 1.1em; color: #555; }
        .username-display { font-weight: bold; color: #28a745; }
        .logout-btn { padding: 10px 20px; background-color: #dc3545; color: white; border: none; border-radius: 5px; cursor: pointer; text-decoration: none; margin-top: 20px; display: inline-block; }
        .logout-btn:hover { background-color: #c82333; }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <h1>Xush kelibsiz, <span class="username-display"><?php echo htmlspecialchars($username); ?></span>!</h1>
        <p>Siz muvaffaqiyatli tizimga kirdingiz.</p>
        <p>Sizning foydalanuvchi ma'lumotlaringiz Session orqali olinmoqda.</p>
        <a href="logout_session.php" class="logout-btn">Chiqish</a>
    </div>
</body>
</html>