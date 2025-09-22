## 1\. Xodimlarni maʼlumotlar bazasidan oʻchirish funksiyasini ishga tushirish

## 2\. Oʻzgartirish sahifasini yaratib, xodimning maʼlumotlarini oʻzgartirish funksiyasini ishga tushirish

O'zgartirish funksiyasi uchun, har bir xodim qatori yoniga "O'zgartirish" tugmasini qo'shamiz. Bu tugma bosilganda, xodimning joriy ma'lumotlari bilan to'ldirilgan yangi forma (yoki shu sahifaning o'zidagi alohida bo'lim) ochiladi. Foydalanuvchi ma'lumotlarni o'zgartirib, yangilaganda, PHP skripti ma'lumotlar bazasini yangilaydi.

Bu ikki funksiyani ham oldingi darsdagi `index.php` faylida integratsiya qilamiz. Ba'zi yaxshilanishlar uchun `edit.php` nomli alohida fayl ham yaratishimiz mumkin, bu ayniqsa murakkab loyihalarda ma'lumotlarni yangilash uchun afzalroq usul.

### Kerakli fayllar:

1.  `index.php` (Xodimlarni ko'rsatish, qo'shish va o'chirish)
2.  `edit.php` (Xodim ma'lumotlarini o'zgartirish uchun alohida sahifa)
3.  `config.php` (DB ulanish sozlamalari, bu fayl barcha PHP fayllarida ishlatiladi)

**2.1. `davomat_tizimi` papkasiga `config.php` faylini qo'shish:**

```php
<?php
    // config.php
    // Ma'lumotlar bazasi ulanish parametrlari
    $servername = "localhost";
    $username_db = "root";     // MySQL foydalanuvchi nomi
    $password_db = "";         // MySQL paroli
    $dbname = "davomat_tizimi"; // Yuqorida yaratilgan DB nomi

    // Ma'lumotlar bazasiga ulanish
    $conn = new mysqli($servername, $username_db, $password_db, $dbname);

    // Ulanishni tekshirish
    if ($conn->connect_error) {
        die("Ulanishda xatolik: " . $conn->connect_error);
    }
?>
```

**2.2. `davomat_tizimi` papkasidagi `index.php` faylini o'zgartirish:**

```php
<?php
    // index.php
    require_once 'config.php'; // DB ulanish sozlamalarini chaqiramiz

    // Xabar o'zgaruvchisi
    $message = '';

    // --- Xodim qo'shish logikasi (14-darsdan) ---
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_staff'])) {
        $ismi = htmlspecialchars($_POST['ismi']);
        $familiyasi = htmlspecialchars($_POST['familiyasi']);

        if (empty($ismi) || empty($familiyasi)) {
            $message = "<p style='color: red;'>Iltimos, ism va familiyani to'ldiring.</p>";
        } else {
            if (!preg_match("/^[a-zA-Z\s'’ʻ]+$/u", $ismi)) {
                $message = "<p style='color: red;'>Ism faqat harflardan iborat bo'lishi kerak.</p>";
            } elseif (!preg_match("/^[a-zA-Z\s'’ʻ]+$/u", $familiyasi)) {
                $message = "<p style='color: red;'>Familiya faqat harflardan iborat bo'lishi kerak.</p>";
            } else {
                $stmt = $conn->prepare("INSERT INTO xodimlar (ismi, familiyasi) VALUES (?, ?)");
                $stmt->bind_param("ss", $ismi, $familiyasi);

                if ($stmt->execute()) {
                    $message = "<p style='color: green;'>Yangi xodim muvaffaqiyatli qo'shildi!</p>";
                } else {
                    $message = "<p style='color: red;'>Xodim qo'shishda xatolik: " . $stmt->error . "</p>";
                }
                $stmt->close();
            }
        }
    }

    // --- 1. Xodimni o'chirish logikasi ---
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_staff'])) {
        $id_to_delete = (int)$_POST['xodim_id'];

        $stmt = $conn->prepare("DELETE FROM xodimlar WHERE id = ?");
        $stmt->bind_param("i", $id_to_delete); // i: integer

        if ($stmt->execute()) {
            $message = "<p style='color: green;'>Xodim muvaffaqiyatli o'chirildi!</p>";
        } else {
            $message = "<p style='color: red;'>Xodimni o'chirishda xatolik: " . $stmt->error . "</p>";
        }
        $stmt->close();
    }
?>

<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Davomat Tizimi - Xodimlar</title>
    <style>
        body { font-family: sans-serif; margin: 20px; background-color: #f4f4f4; color: #333; }
        .container { background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); margin-bottom: 30px; }
        h1, h2 { color: #0056b3; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        form { margin-bottom: 20px; padding: 15px; border: 1px solid #eee; border-radius: 5px; background-color: #fafafa; }
        form label { display: block; margin-bottom: 5px; font-weight: bold; }
        form input[type="text"],
        form input[type="submit"] {
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            width: calc(100% - 16px);
        }
        form input[type="submit"] {
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
            width: auto;
            min-width: 120px;
            margin-right: 10px;
        }
        form input[type="submit"]:hover { background-color: #218838; }
        .delete-btn { background-color: #dc3545; }
        .delete-btn:hover { background-color: #c82333; }
        .edit-btn { background-color: #ffc107; color: #333; }
        .edit-btn:hover { background-color: #e0a800; }
        .message { margin-top: 10px; padding: 10px; border-radius: 5px; }
        .message p { margin: 0; }
        .error { background-color: #f8d7da; border-color: #f5c6cb; color: #721c24; }
        .success { background-color: #d4edda; border-color: #c3e6cb; color: #155724; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Davomat Tizimi - Xodimlar</h1>
        <?php if (!empty($message)): ?>
            <div class="message <?php echo strpos($message, 'xatolik') !== false ? 'error' : 'success'; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <h2>Yangi xodim qo'shish</h2>
        <form method="POST" action="">
            <label for="ismi">Ismi:</label>
            <input type="text" id="ismi" name="ismi" required><br>

            <label for="familiyasi">Familiyasi:</label>
            <input type="text" id="familiyasi" name="familiyasi" required><br><br>

            <input type="submit" name="add_staff" value="Xodim qo'shish">
        </form>
    </div>

    <div class="container">
        <h2>Xodimlar ro'yxati</h2>
        <?php
        $sql_select = "SELECT id, ismi, familiyasi FROM xodimlar ORDER BY id DESC";
        $result = $conn->query($sql_select);

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<thead>";
            echo "<tr><th>ID</th><th>Ismi</th><th>Familiyasi</th><th>Amallar</th></tr>";
            echo "</thead>";
            echo "<tbody>";

            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . htmlspecialchars($row["ismi"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["familiyasi"]) . "</td>";
                echo "<td>";
                // 1. O'chirish formasi
                echo "<form method='POST' action='' style='display:inline-block; margin-right: 5px;'>";
                echo "<input type='hidden' name='xodim_id' value='" . $row["id"] . "'>";
                echo "<input type='submit' name='delete_staff' value='O'chirish' class='delete-btn' onclick='return confirm(\"Haqiqatan ham " . htmlspecialchars($row["ismi"]) . " " . htmlspecialchars($row["familiyasi"]) . "ni o'chirmoqchimisiz?\")'>";
                echo "</form>";

                // 2. O'zgartirish sahifasiga yo'naltirish tugmasi
                // GET metodi orqali xodim ID sini yuborish
                echo "<a href='edit.php?id=" . $row["id"] . "' class='edit-btn' style='text-decoration:none; padding:8px 15px; border-radius:4px;'>O'zgartirish</a>";
                echo "</td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
        } else {
            echo "<p>Hozircha hech qanday xodim mavjud emas.</p>";
        }
        ?>
    </div>

<?php
// Ma'lumotlar bazasi ulanishini yopish
$conn->close();
?>
</body>
</html>
```

**2.3. `davomat_tizimi` papkasiga `edit.php` faylini qo'shish:**

```php
<?php
    // edit.php
    require_once 'config.php'; // DB ulanish sozlamalarini chaqiramiz

    $message = '';
    $xodim_data = null; // Xodimning ma'lumotlarini saqlash uchun

    // Xodim ID si mavjudligini tekshirish
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $xodim_id = (int)$_GET['id'];

        // Xodimning joriy ma'lumotlarini olish
        $stmt = $conn->prepare("SELECT id, ismi, familiyasi FROM xodimlar WHERE id = ?");
        $stmt->bind_param("i", $xodim_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $xodim_data = $result->fetch_assoc();
        } else {
            $message = "<p style='color: red;'>Xodim topilmadi.</p>";
        }
        $stmt->close();
    } else {
        $message = "<p style='color: red;'>Xodim ID si noto'g'ri yoki mavjud emas.</p>";
        // Noto'g'ri ID bo'lsa, asosiy sahifaga qaytarish
        header("Location: index.php");
        exit();
    }

    // --- Xodim ma'lumotlarini yangilash logikasi ---
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_staff'])) {
        $xodim_id = (int)$_POST['xodim_id'];
        $new_ismi = htmlspecialchars($_POST['new_ismi']);
        $new_familiyasi = htmlspecialchars($_POST['new_familiyasi']);

        if (empty($new_ismi) || empty($new_familiyasi)) {
            $message = "<p style='color: red;'>Iltimos, ism va familiyani to'ldiring.</p>";
        } else {
            // Ma'lumotlarni tekshirish (14-darsdagi kabi)
            if (!preg_match("/^[a-zA-Z\s'’ʻ]+$/u", $new_ismi)) {
                $message = "<p style='color: red;'>Ism faqat harflardan iborat bo'lishi kerak.</p>";
            } elseif (!preg_match("/^[a-zA-Z\s'’ʻ]+$/u", $new_familiyasi)) {
                $message = "<p style='color: red;'>Familiya faqat harflardan iborat bo'lishi kerak.</p>";
            } else {
                $stmt = $conn->prepare("UPDATE xodimlar SET ismi = ?, familiyasi = ? WHERE id = ?");
                $stmt->bind_param("ssi", $new_ismi, $new_familiyasi, $xodim_id);

                if ($stmt->execute()) {
                    $message = "<p style='color: green;'>Xodim ma'lumotlari muvaffaqiyatli yangilandi!</p>";
                    // Ma'lumotlar yangilangandan so'ng, formani yangi ma'lumotlar bilan to'ldirish
                    $xodim_data['ismi'] = $new_ismi;
                    $xodim_data['familiyasi'] = $new_familiyasi;
                } else {
                    $message = "<p style='color: red;'>Ma'lumotlarni yangilashda xatolik: " . $stmt->error . "</p>";
                }
                $stmt->close();
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xodim ma'lumotlarini o'zgartirish</title>
    <style>
        body { font-family: sans-serif; margin: 20px; background-color: #f4f4f4; color: #333; }
        .container { background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); max-width: 500px; margin: 50px auto; }
        h1, h2 { color: #0056b3; text-align: center; }
        form label { display: block; margin-bottom: 5px; font-weight: bold; }
        form input[type="text"],
        form input[type="submit"] {
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            width: 100%;
        }
        form input[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            width: auto;
            min-width: 120px;
            margin-right: 10px;
        }
        form input[type="submit"]:hover { background-color: #0056b3; }
        .back-link { display: block; text-align: center; margin-top: 20px; text-decoration: none; color: #007bff; }
        .back-link:hover { text-decoration: underline; }
        .message { margin-top: 10px; padding: 10px; border-radius: 5px; text-align: center; }
        .message p { margin: 0; }
        .error { background-color: #f8d7da; border-color: #f5c6cb; color: #721c24; }
        .success { background-color: #d4edda; border-color: #c3e6cb; color: #155724; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Xodim ma'lumotlarini o'zgartirish</h1>
        <?php if (!empty($message)): ?>
            <div class="message <?php echo strpos($message, 'xatolik') !== false ? 'error' : 'success'; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <?php if ($xodim_data): ?>
            <form method="POST" action="">
                <input type="hidden" name="xodim_id" value="<?php echo htmlspecialchars($xodim_data['id']); ?>">
                
                <label for="new_ismi">Ismi:</label>
                <input type="text" id="new_ismi" name="new_ismi" value="<?php echo htmlspecialchars($xodim_data['ismi']); ?>" required><br>

                <label for="new_familiyasi">Familiyasi:</label>
                <input type="text" id="new_familiyasi" name="new_familiyasi" value="<?php echo htmlspecialchars($xodim_data['familiyasi']); ?>" required><br><br>

                <input type="submit" name="update_staff" value="Yangilash">
            </form>
        <?php else: ?>
            <p>Xodim ma'lumotlarini yuklashda muammo yuz berdi.</p>
        <?php endif; ?>
        <a href="index.php" class="back-link">Barcha xodimlar ro'yxatiga qaytish</a>
    </div>

<?php
// Ma'lumotlar bazasi ulanishini yopish
$conn->close();
?>
</body>
</html>
```

-----

**Tushuntirish:**

### **`config.php` (Yangi)**

  * Bu fayl maʼlumotlar bazasi ulanish sozlamalarini oʻz ichiga oladi.
  * Buni alohida faylga ajratish kodning takrorlanishini oldini oladi va loyihaning yaxshi tuzilishiga yordam beradi.
  * **`require_once 'config.php';`** yordamida bu faylni boshqa scriptlarga kiritamiz.

### **`index.php` (Oʻzgarishlar)**

1.  **`require_once 'config.php';`**: Endi DB ulanish logikasi shu fayldan chaqiriladi.
2.  **Xodimni oʻchirish logikasi (1-topshiriq):**
      * `if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_staff']))`: Oʻchirish tugmasi bosilganligini tekshiradi.
      * `$id_to_delete = (int)$_POST['xodim_id'];`: POST orqali yuborilgan xodim ID sini oladi va butun songa oʻtkazadi.
      * **`DELETE FROM xodimlar WHERE id = ?`**: Xodimni ID boʻyicha oʻchirish uchun SQL soʻrovi.
      * **`$stmt->bind_param("i", $id_to_delete);`**: `i` (integer) tipi bilan ID ni bogʻlaydi.
      * Oʻchirishdan oldin JavaScript `confirm()` dialogi orqali foydalanuvchidan tasdiqlash soʻraladi.
3.  **Xodimni oʻzgartirish tugmasi (2-topshiriqqa oʻtish):**
      * `echo "<a href='edit.php?id=" . $row["id"] . "' class='edit-btn'>O'zgartirish</a>";`: Har bir xodim qatori yonida "O'zgartirish" havolasi yaratiladi.
      * Bu havola `edit.php` fayliga xodimning `id` sini **GET parametri** orqali yuboradi (`edit.php?id=123`).

### **`edit.php` (Yangi fayl, 2-topshiriq)**

1.  **`require_once 'config.php';`**: Bu sahifada ham DB ulanish sozlamalari chaqiriladi.
2.  **Xodim maʼlumotlarini yuklash:**
      * Sahifa yuklanganda, URL dan `id` GET parametridagi xodim ID si olinadi (`$_GET['id']`).
      * Ushbu ID boʻyicha `SELECT` soʻrovi orqali xodimning **joriy maʼlumotlari** maʼlumotlar bazasidan olinadi.
      * Maʼlumotlar topilsa, `$xodim_data` oʻzgaruvchisiga saqlanadi va forma maydonlariga `value` atributi orqali joylashtiriladi.
      * Agar ID notoʻgʻri boʻlsa yoki xodim topilmasa, xato xabari koʻrsatiladi yoki `index.php` ga qaytariladi.
3.  **Xodim maʼlumotlarini yangilash logikasi:**
      * `if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_staff']))`: Forma POST metodi orqali yuborilganligini tekshiradi.
      * Formadan yangi ism va familiya olinadi. `xodim_id` yashirin maydonda POST orqali qayta yuboriladi.
      * **Maʼlumotlarni tekshirish (Validation):** Xuddi qoʻshishdagi kabi tekshiruvlar amalga oshiriladi.
      * **`UPDATE xodimlar SET ismi = ?, familiyasi = ? WHERE id = ?`**: Xodim maʼlumotlarini yangilash uchun SQL soʻrovi.
      * **`$stmt->bind_param("ssi", $new_ismi, $new_familiyasi, $xodim_id);`**: String (ism), String (familiya), Integer (ID) tiplari bilan bogʻlanadi.
      * Yangilash muvaffaqiyatli boʻlsa, xabar koʻrsatiladi va forma maydonlari yangilangan maʼlumotlar bilan toʻldiriladi.