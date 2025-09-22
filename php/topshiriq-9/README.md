## 1\. Cookie orqali login tizimini ishlab chiqish

### Kerakli fayllar yaratish:

1.  **`9-topshiriq`** nomli yangi papka yarating.
2.  Uning ichida quyidagi uchta faylni yarating:
      * `index.php` (Login formasi joylashgan asosiy sahifa)
      * `admin.php` (Admin sahifasi)
      * `user.php` (Oddiy foydalanuvchi sahifasi)
      * `logout.php` (Profile dan chiqish uchun)

### `index.php` kodi:

```php
<?php
    // Sahifani yangilashdan oldin Cookie mavjudligini tekshirish
    if (isset($_COOKIE['user'])) {
        $user_type = $_COOKIE['user'];
        if ($user_type === 'admin') {
            header("Location: admin.php");
            exit();
        } elseif ($user_type === 'user') {
            header("Location: user.php");
            exit();
        }
    }

    // Forma yuborilganligini tekshirish
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'] ?? ''; // Null coalescing operator PHP 7+
        $password = $_POST['password'] ?? '';

        // username va password ni tekshirish
        if ($username === 'admin' && $password === 'adminpass') { // 'adminpass' misol uchun parol
            // Admin uchun 'user' nomli cookie yaratish, qiymati 'admin', 5 daqiqaga (300 soniya)
            setcookie('user', 'admin', time() + 300, "/");
            header("Location: admin.php");
            exit();
        } elseif ($username === 'user' && $password === 'userpass') { // 'userpass' misol uchun parol
            // User uchun 'user' nomli cookie yaratish, qiymati 'user', 5 daqiqaga (300 soniya)
            setcookie('user', 'user', time() + 300, "/");
            header("Location: user.php");
            exit();
        } else {
            $error_message = "Noto'g'ri foydalanuvchi nomi yoki parol!";
        }
    }
?>

<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Sahifasi</title>
    <style>
        body { font-family: sans-serif; display: flex; justify-content: center; align-items: center; min-height: 100vh; background-color: #f4f4f4; }
        .login-container { background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .login-container h2 { text-align: center; margin-bottom: 20px; color: #333; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; color: #555; }
        .form-group input[type="text"], .form-group input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box; /* Padding hisobga olinishi uchun */
        }
        .form-group input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        .form-group input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .error-message {
            color: red;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Tizimga kirish</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label for="username">Foydalanuvchi nomi:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Parol:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Kirish">
            </div>
            <?php if (isset($error_message)): ?>
                <p class="error-message"><?php echo $error_message; ?></p>
            <?php endif; ?>
        </form>
    </div>
</body>
</html>
```

### `admin.php` kodi:

```php
<?php
    // Cookie ni tekshirish
    if (!isset($_COOKIE['user']) || $_COOKIE['user'] !== 'admin') {
        header("Location: index.php"); // Agar cookie mavjud bo'lmasa yoki admin bo'lmasa, login sahifasiga yo'naltirish
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
```

### `user.php` kodi:

```php
<?php
    // Cookie ni tekshirish
    if (!isset($_COOKIE['user']) || $_COOKIE['user'] !== 'user') {
        header("Location: index.php"); // Agar cookie mavjud bo'lmasa yoki user bo'lmasa, login sahifasiga yo'naltirish
        exit();
    }
?>
<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foydalanuvchi Sahifasi</title>
    <style>
        body { font-family: sans-serif; text-align: center; padding: 50px; background-color: #e6f7ff; }
        h1 { color: #007bff; }
        .logout-btn { padding: 10px 20px; background-color: #dc3545; color: white; border: none; border-radius: 5px; cursor: pointer; text-decoration: none; }
        .logout-btn:hover { background-color: #c82333; }
    </style>
</head>
<body>
    <h1>Xush kelibsiz, Foydalanuvchi!</h1>
    <p>Bu sizning shaxsiy sahifangiz.</p>
    <a href="logout.php" class="logout-btn">Chiqish</a>
</body>
</html>
```

### `logout.php` kodi (Cookie ni o'chirish uchun):

```php
<?php
    // 'user' nomli cookie ni o'chirish
    // Cookie ni o'chirish uchun uning amal qilish muddatini o'tmishga o'rnatish kerak
    setcookie('user', '', time() - 3600, "/");

    // Foydalanuvchini login sahifasiga yo'naltirish
    header("Location: index.php");
    exit();
?>
```

**Tushuntirish:**

  * **`setcookie('user', 'admin', time() + 300, "/");`**: Bu funksiya Cookie yaratadi.
      * `'user'`: Cookie nomi.
      * `'admin'`: Cookie qiymati.
      * `time() + 300`: Cookie 5 daqiqa (300 soniya) davomida saqlanadi. `time()` joriy UNIX vaqt tamg'asini qaytaradi.
      * `"/"`: Cookie butun domenda (saytda) mavjud bo'lishini bildiradi.
  * **`isset($_COOKIE['user'])`**: Bu Cookie mavjudligini tekshiradi.
  * **`header("Location: admin.php");`**: Foydalanuvchini boshqa sahifaga yo'naltiradi. `exit()` funksiyasidan foydalanish uning ortidan boshqa kodlarning ishga tushishini oldini oladi.

-----

## 2\. Registratsiya formasi, MySQL ga saqlash va Session yaratish

### 2.1. MySQLda `users` jadvalini yaratish:

Avval `asaxiy` ma'lumotlar bazasini yaratgan bo'lishingiz kerak. Endi uning ichiga `users` jadvalini yaratamiz.

  * phpMyAdmin ga kiring.
  * Chap tomondan **`asaxiy`** ma'lumotlar bazasini tanlang.
  * **"Create table"** qismiga **`users`** deb yozing va ustunlar sonini **`4`** qilib, "Create" tugmasini bosing.
  * Quyidagi ustunlarni kiriting:

| Nomi       | Turi        | Uzunligi/Qiymatlari | Null | Indeks    | A\_I   |
| :--------- | :---------- | :------------------ | :--- | :-------- | :---- |
| `id`       | `INT`       | `11`                |      | `PRIMARY` | (belgilash) |
| `username` | `VARCHAR`   | `255`               |      | `UNIQUE`  |       |
| `password` | `VARCHAR`   | `255`               |      |           |       |
| `created_at`| `TIMESTAMP` |                     |      |           |       |
\* `id` uchun **`A_I` (Auto Increment)** va **`PRIMARY`** ni belgilang.
\* `username` uchun **`UNIQUE`** indeksni tanlang (bir xil username bo'lmasligi uchun).
\* `created_at` uchun "Default" qiymatini `current_timestamp()` ga o'rnating.

  * **"Save"** tugmasini bosing.

### 2.2. PHP loyihasida fayllarni yaratish:

Agar yuqorida `9-topshiriq` papkasini yaratgan bo'lsangiz, shu papka ichida ishlashingiz mumkin.

  * `register.php` (Registratsiya formasi va ma'lumotlarni saqlash)
  * `user_dashboard.php` (Session ma'lumotlarini chiqarish sahifasi)

### 2.3. `register.php` kodi:

```php
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
                <label for="username">Foydalanuvchi nomi:</label>
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
```

### `user_dashboard.php` kodi:

```php
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
```

### `logout_session.php` kodi (Sessionni tugatish uchun):

```php
<?php
    session_start();

    $_SESSION = array();

    // Agar Session Cookieda ham ishlatilgan bo'lsa, Cookie ni ham o'chirish
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    // Sessionni to'liq tugatish
    session_destroy();

    // Foydalanuvchini registratsiya sahifasiga yo'naltirish
    header("Location: register.php");
    exit();
?>
```

**Tushuntirish:**

  * **`session_start();`**: Har bir sahifa boshida sessiondan foydalanishdan oldin chaqirilishi shart.
  * **`$_SESSION['username'] = $username;`**: Bu qator `username` qiymatini sessionga saqlaydi. Session ma'lumotlari server tomonida saqlanadi va foydalanuvchi sahifalar orasida harakatlanganda mavjud bo'lib turadi.
  * **`password_hash($password, PASSWORD_DEFAULT);`**: Parollarni ma'lumotlar bazasiga to'g'ridan-to'g'ri (clear text) saqlash juda xavflidir. `password_hash()` funksiyasi parolni xavfsiz tarzda hashlaydi. Keyinchalik, foydalanuvchi kirganida parolni tekshirish uchun `password_verify()` funksiyasidan foydalaniladi (bu topshiriqda login qismi talab qilinmaganligi sababli, u kiritilmagan, lekin haqiqiy ilovalarda qo'llaniladi).
  * **Prepared Statements (`$conn->prepare()`, `$stmt->bind_param()`, `$stmt->execute()`):** Ma'lumotlar bazasiga ma'lumot yozishda SQL Injection hujumlaridan himoya qilish uchun ishlatiladi.
  * **`$conn->errno == 1062`**: MySQL xato kodi 1062 "Duplicate entry" ni bildiradi, ya'ni `username` allaqachon mavjud.