<?php
    // Sessionni boshlash (har doim eng yuqorida bo'lishi kerak)
    session_start();

    $servername = "localhost";
    $username_db = "root";
    $password_db = "root";
    $dbname = "asaxiy";

    // Ulanish obyektini yaratish
    $conn = new mysqli($servername, $username_db, $password_db, $dbname);

    // Ulanishni tekshirish
    if ($conn->connect_error) {
        die("Ulanishda xatolik: " . $conn->connect_error);
    }

    $message = ''; // Xabar uchun o'zgaruvchi

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = htmlspecialchars($_POST['username'] ?? '');
        $password = htmlspecialchars($_POST['password'] ?? '');

        // Kiritilgan ma'lumotlarni tekshirish
        if (empty($username) || empty($password)) {
            $message = "<p style='color: red;'>Iltimos, barcha maydonlarni to'ldiring!</p>";
        } else {
            // Parolni hash qilish (xavfsizlik uchun muhim!)
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // SQL INSERT so'rovini tayyorlash (Prepared Statement)
            $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $username, $hashed_password);

            if ($stmt->execute()) {
                $message = "<p style='color: green;'>Muvaffaqiyatli ro'yxatdan o'tdingiz!</p>";
                // Session yaratish
                $_SESSION['username'] = $username;
                
                // Foydalanuvchini keyingi sahifaga yo'naltirish
                header("Location: user_dashboard.php");
                exit();
            } else {
                // Xatolikni tekshirish, masalan, username takrorlanganda
                if ($conn->errno == 1062) { // 1062 - Duplicate entry for key 'username'
                    $message = "<p style='color: red;'>Bu foydalanuvchi nomi band. Boshqasini tanlang.</p>";
                } else {
                    $message = "<p style='color: red;'>Ro'yxatdan o'tishda xatolik: " . $stmt->error . "</p>";
                }
            }
            $stmt->close();
        }
    }
    $conn->close();
?>

<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registratsiya</title>
    <style>
        body { font-family: sans-serif; display: flex; justify-content: center; align-items: center; min-height: 100vh; background-color: #f0f2f5; }
        .register-container { background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); width: 400px; }
        .register-container h2 { text-align: center; margin-bottom: 20px; color: #333; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; color: #555; }
        .form-group input[type="text"], .form-group input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .form-group input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        .form-group input[type="submit"]:hover {
            background-color: #218838;
        }
        .message {
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2>Ro'yxatdan o'tish</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Parol:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Ro'yxatdan o'tish">
            </div>
            <?php echo $message; ?>
        </form>
    </div>
</body>
</html>