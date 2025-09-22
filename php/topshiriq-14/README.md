## 1\. `xodimlar` jadvalini yaratish va barcha xodimlarni jadvalda koʻrsatish


### 1.1. MySQLda `xodimlar` jadvalini yaratish:

1.  **phpMyAdmin ga kirish:** Brauzeringizda `http://localhost:8888/phpMyAdmin5/` manziliga kiring.

2.  **Ma'lumotlar bazasini tanlash/yaratish:**

      * Avvalgi darslarda yaratgan `texnomart` yoki `asaxiy` kabi ma'lumotlar bazalaridan birini tanlashingiz mumkin.
      * Yoki "New" (yoki "Yangi") tugmasini bosib, yangi baza yarating (masalan, **`davomat_tizimi`**). Biz shu nomdan foydalanamiz.

3.  **`xodimlar` jadvalini yaratish:**

      * Chap menyudan yangi yaratilgan **`davomat_tizimi`** maʼlumotlar bazasini tanlang.
      * "Create table" (yoki "Jadval yaratish") qismida "Name" (yoki "Nomi") maydoniga **`xodimlar`** deb yozing.
      * "Number of columns" (yoki "Ustunlar soni") ni **`3`** ga oʻrnating va "Create" (yoki "Yaratish") tugmasini bosing.

4.  **`xodimlar` jadvalining ustunlarini sozlash:**
    Jadval yaratish sahifasida quyidagi ustunlarni kiriting:

    | Nomi       | Turi        | Uzunligi/Qiymatlari | Null | Indeks    | A\_I         |
    | :--------- | :---------- | :------------------ | :--- | :-------- | :---------- |
    | `id`       | `INT`       | `11`                |      | `PRIMARY` | (belgilash) |
    | `ismi`     | `VARCHAR`   | `255`               |      |           |             |
    | `familiyasi`| `VARCHAR`   | `255`               |      |           |             |

      * `id` ustuni uchun **`A_I` (Auto Increment)** belgisini qoʻying.
      * **"Save"** (yoki "Saqlash") tugmasini bosing.

5.  **Test ma'lumotlari kiritish (ixtiyoriy, lekin tavsiya etiladi):**

      * `xodimlar` jadvalini tanlang.
      * "Insert" (yoki "Kiritish") boʻlimiga oʻting va 2-3 ta xodim maʼlumotini kiriting.
          * Misol: (id: 1, ismi: Ali, familiyasi: Aliyev), (id: 2, ismi: Botir, familiyasi: Valijonov)

### 1.2. PHPda xodimlarni jadvalda koʻrsatish:

1.  **`davomat_tizimi`** nomli yangi proekt papkasini yarating.
2.  Uning ichida **`index.php`** faylini yarating.
3.  PHP built-in serverini ishga tushiring:
    ```bash
    cd davomat_tizimi
    php -S localhost:8000
    ```
4.  **`index.php`** fayliga quyidagi kodni yozing:

```php
<?php
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

    // Xabar o'zgaruvchisi
    $message = '';

    // --- Xodim qo'shish logikasi (2-topshiriq uchun) ---
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_staff'])) {
        $ismi = htmlspecialchars($_POST['ismi']);
        $familiyasi = htmlspecialchars($_POST['familiyasi']);

        if (empty($ismi) || empty($familiyasi)) {
            $message = "<p style='color: red;'>Iltimos, ism va familiyani to'ldiring.</p>";
        } else {
            // Ism va familiyani faqat harflardan iborat ekanligini tekshirish (bo'sh joylarga ruxsat berilgan)
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
        }
        form input[type="submit"]:hover { background-color: #218838; }
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
            echo "<tr><th>ID</th><th>Ismi</th><th>Familiyasi</th></tr>";
            echo "</thead>";
            echo "<tbody>";

            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . htmlspecialchars($row["ismi"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["familiyasi"]) . "</td>";
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

-----

## 2\. Yangi xodim qoʻshish sahifasini yaratish va funksiyasini ishga tushirish

Bu qismni yuqoridagi `index.php` fayli ichida, allaqachon integratsiya qilib ketdik.

**Tushuntirish:**

  * **Maʼlumotlar bazasi ulanishi:** Script boshida `mysqli` obyektidan foydalanib maʼlumotlar bazasiga ulanish oʻrnatiladi. Ulanish parametrlari (server nomi, foydalanuvchi nomi, parol, baza nomi) oʻzingizning konfiguratsiyangizga mos kelishi kerak.
  * **Xodim qoʻshish logikasi:**
      * `if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_staff']))` sharti, forma POST metodi orqali yuborilganligini va "add\_xodim" nomli tugma bosilganligini tekshiradi.
      * **Maʼlumotlarni tekshirish (Validation):**
          * `empty($ismi) || empty($familiyasi)`: Maydonlarning boʻsh emasligini tekshiradi.
          * `!preg_match("/^[a-zA-Z\s'’ʻ]+$/u", $ismi)`: Ism va familiyani faqat harflardan (lotin alifbosidagi katta va kichik harflar), boʻsh joylar (`\s`) va baʼzi apostrof belgilardan (`'’ʻ`) iborat ekanligini tekshiradi. `u` modifikatori Unicode belgilarini ham qoʻllab-quvvatlaydi. Bu 12-darsdagi `ctype_alpha()` ga nisbatan boʻsh joylarga ruxsat beruvchi ancha mos yechim.
      * **Prepared Statements:** `INSERT INTO xodimlar (ismi, familiyasi) VALUES (?, ?)` koʻrinishidagi tayyorlangan iboralar (`prepare()`, `bind_param()`, `execute()`) **SQL Injection hujumlaridan himoya** qilish uchun ishlatilgan. `ss` harflari ikkita parametr ham string (matn) turida ekanligini bildiradi.
      * Operatsiya muvaffaqiyatli boʻlsa yoki xato yuz bersa, foydalanuvchiga tegishli xabar chiqariladi.
  * **Xodimlarni koʻrsatish logikasi:**
      * `SELECT id, ismi, familiyasi FROM xodimlar ORDER BY id DESC` SQL soʻrovi yordamida `xodimlar` jadvalidagi barcha maʼlumotlar olinadi. `ORDER BY id DESC` eng oxirgi qoʻshilgan xodimni birinchi koʻrsatadi.
      * `if ($result->num_rows > 0)`: Agar jadvalda maʼlumotlar mavjud boʻlsa, HTML jadval shaklida chiqariladi.
      * `while($row = $result->fetch_assoc())`: Natijalar massiv koʻrinishida olinib, har bir qator uchun jadval elementi yaratiladi.
      * `htmlspecialchars()`: Maʼlumotlarni ekranga chiqarishdan oldin XSS hujumlaridan himoya qilish uchun ishlatiladi.