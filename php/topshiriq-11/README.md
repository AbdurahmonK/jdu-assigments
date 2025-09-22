## 1\. MySQL da `mashinalar` jadvalini yaratish

**1.1. phpMyAdmin ga kirish:**
Brauzeringizda `http://localhost:8888/phpMyAdmin5/` manziliga kiring.

**1.2. Ma'lumotlar bazasini tanlash:**
Avvalgi darslarda yaratgan `texnomart` yoki `asaxiy` ma'lumotlar bazalaridan birini tanlashingiz mumkin. Bu yerda biz `texnomart` bazasini ishlatamiz.

**1.3. `mashinalar` jadvalini yaratish:**

  * Chap menyudan **`texnomart`** ma'lumotlar bazasini tanlang.
  * O'ng tomondagi asosiy maydonda "Create table" (yoki "Jadval yaratish") qismida "Name" (yoki "Nomi") maydoniga **`mashinalar`** deb yozing.
  * "Number of columns" (yoki "Ustunlar soni") ni **`5`** ga o'rnating va "Create" (yoki "Yaratish") tugmasini bosing.

**1.4. `mashinalar` jadvalining ustunlarini sozlash:**
Jadval yaratish sahifasida quyidagi ustunlarni kiriting:

| Nomi          | Turi        | Uzunligi/Qiymatlari | Null | Indeks    | A\_I   |
| :------------ | :---------- | :------------------ | :--- | :-------- | :---- |
| `id`          | `INT`       | `11`                |      | `PRIMARY` | (belgilash) |
| `nomi`        | `VARCHAR`   | `255`               |      |           |       |
| `soni`        | `INT`       | `11`                |      |           |       |
| `narxi`       | `DECIMAL`   | `10,2`              |      |           |       |
| `rasm_url`    | `VARCHAR`   | `255`               |      |           |       |

  * `id` ustuni uchun **`A_I` (Auto Increment)** belgisini qo'ying.
  * **"Save"** (yoki "Saqlash") tugmasini bosing.

-----

## 2-5. PHP da CRUD (Create, Read, Update, Delete) operatsiyalari va Rasm yuklash

Bu topshiriqlarni bitta PHP faylida (`index.php`) amalga oshiramiz. Bu sizga ma'lumotlar bazasi bilan ishlashning to'liq jarayonini tushunishga yordam beradi.

**2.1. `11-dars` nomli proekt papkasini yaratish:**

  * Kompyuteringizda **`11-dars`** nomli yangi papka yarating.
  * Shu papka ichida **`uploads`** nomli yana bir papka yarating. Bu papka yuklangan rasmlarni saqlash uchun ishlatiladi.

**2.2. `index.php` faylini yaratish:**

  * `11-dars` papkasi ichiga **`index.php`** nomli fayl yarating.

**2.3. PHP built-in serverini ishga tushirish:**

  * Terminalni oching, `11-dars` papkasiga o'ting: `cd 11-dars`
  * Serverni ishga tushiring: `php -S localhost:8000`
  * Brauzerda `http://localhost:8000` manziliga kiring.

**2.4. `index.php` fayliga kod yozish:**

```php
<?php
    // Ma'lumotlar bazasi ulanish parametrlari
    $servername = "localhost";
    $username_db = "root"; // MySQL user name
    $password_db = "";     // MySQL password
    $dbname = "texnomart"; // Avvalgi darsda yaratilgan baza nomi

    // Ma'lumotlar bazasiga ulanish
    $conn = new mysqli($servername, $username_db, $password_db, $dbname);

    // Ulanishni tekshirish
    if ($conn->connect_error) {
        die("Ulanishda xatolik: " . $conn->connect_error);
    }

    // Xabar o'zgaruvchisi
    $message = '';

    // Rasmlar yuklanadigan papka
    $upload_dir = 'uploads/';

    // Fayl yuklash funksiyasi
    function upload_image($file_input_name, $upload_dir) {
        if (isset($_FILES[$file_input_name]) && $_FILES[$file_input_name]['error'] == 0) {
            $file_name = $_FILES[$file_input_name]['name'];
            $file_tmp = $_FILES[$file_input_name]['tmp_name'];
            $file_size = $_FILES[$file_input_name]['size'];
            $file_type = $_FILES[$file_input_name]['type'];
            $file_ext_arr = explode('.', $file_name);
            $file_ext = strtolower(end($file_ext_arr));

            $extensions = array("jpeg", "jpg", "png", "gif");

            if (in_array($file_ext, $extensions) === false) {
                return ["error" => "Rasm turi noto'g'ri. Faqat JPEG, JPG, PNG, GIF ruxsat etiladi."];
            }

            if ($file_size > 2097152) { // 2MB
                return ["error" => "Fayl hajmi juda katta (2MB dan oshmasin)."];
            }

            // Unikal fayl nomi yaratish
            $new_file_name = uniqid('img_', true) . '.' . $file_ext;
            $upload_path = $upload_dir . $new_file_name;

            if (move_uploaded_file($file_tmp, $upload_path)) {
                return ["success" => $upload_path];
            } else {
                return ["error" => "Rasmni yuklashda xatolik yuz berdi."];
            }
        }
        return ["error" => "Rasm yuklanmadi yoki xatolik bor."];
    }


    /*  YANGI MASHINA QO'SHISH (CREATE) */
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_mashina'])) {
        $nomi = htmlspecialchars($_POST['nomi']);
        $soni = (int)$_POST['soni'];
        $narxi = (float)$_POST['narxi'];

        if (empty($nomi) || $soni <= 0 || $narxi <= 0) {
            $message = "<p style='color: red;'>Iltimos, barcha maydonlarni to'g'ri to'ldiring (soni va narxi 0 dan katta bo'lsin).</p>";
        } else {
            $upload_result = upload_image('rasm_url', $upload_dir);

            if (isset($upload_result['error'])) {
                $message = "<p style='color: red;'>Rasm yuklashda xatolik: " . $upload_result['error'] . "</p>";
            } else {
                $rasm_url = $upload_result['success'];

                $stmt = $conn->prepare("INSERT INTO mashinalar (nomi, soni, narxi, rasm_url) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("sids", $nomi, $soni, $narxi, $rasm_url);

                if ($stmt->execute()) {
                    $message = "<p style='color: green;'>Yangi mashina muvaffaqiyatli qo'shildi!</p>";
                } else {
                    $message = "<p style='color: red;'>Mashina qo'shishda xatolik: " . $stmt->error . "</p>";
                    // Agar DB ga saqlanmasa, yuklangan rasmni o'chirish
                    if (file_exists($rasm_url)) {
                        unlink($rasm_url);
                    }
                }
                $stmt->close();
            }
        }
    }

    /* MASHINANI O'CHIRISH (DELETE) */
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_mashina'])) {
        $id_to_delete = (int)$_POST['mashina_id'];

        // Rasmni o'chirishdan oldin DB dan rasm_url ni olish
        $stmt_select_img = $conn->prepare("SELECT rasm_url FROM mashinalar WHERE id = ?");
        $stmt_select_img->bind_param("i", $id_to_delete);
        $stmt_select_img->execute();
        $stmt_select_img->bind_result($old_image_url);
        $stmt_select_img->fetch();
        $stmt_select_img->close();

        $stmt = $conn->prepare("DELETE FROM mashinalar WHERE id = ?");
        $stmt->bind_param("i", $id_to_delete);

        if ($stmt->execute()) {
            $message = "<p style='color: green;'>Mashina muvaffaqiyatli o'chirildi!</p>";
            // Agar rasm mavjud bo'lsa, uni fayl tizimidan o'chirish
            if ($old_image_url && file_exists($old_image_url)) {
                unlink($old_image_url);
            }
        } else {
            $message = "<p style='color: red;'>Mashina o'chirishda xatolik: " . $stmt->error . "</p>";
        }
        $stmt->close();
    }

    /* MASHINA MA'LUMOTLARINI O'ZGARTIRISH (UPDATE) */
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_mashina'])) {
        $id_to_update = (int)$_POST['mashina_id'];
        $new_nomi = htmlspecialchars($_POST['new_nomi']);
        $new_soni = (int)$_POST['new_soni'];
        $new_narxi = (float)$_POST['new_narxi'];
        $current_rasm_url = $_POST['current_rasm_url'] ?? ''; // Joriy rasm URL

        $rasm_url_to_save = $current_rasm_url; // Default joriy rasm

        if (empty($new_nomi) || $new_soni <= 0 || $new_narxi <= 0) {
            $message = "<p style='color: red;'>Iltimos, barcha maydonlarni to'g'ri to'ldiring (soni va narxi 0 dan katta bo'lsin).</p>";
        } else {
            // Agar yangi rasm yuklansa
            if (isset($_FILES['new_rasm_url']) && $_FILES['new_rasm_url']['error'] == 0 && $_FILES['new_rasm_url']['size'] > 0) {
                $upload_result = upload_image('new_rasm_url', $upload_dir);
                if (isset($upload_result['error'])) {
                    $message = "<p style='color: red;'>Rasm yuklashda xatolik: " . $upload_result['error'] . "</p>";
                } else {
                    $rasm_url_to_save = $upload_result['success'];
                    // Eski rasmni o'chirish (agar mavjud bo'lsa va yangisi yuklangan bo'lsa)
                    if ($current_rasm_url && file_exists($current_rasm_url)) {
                        unlink($current_rasm_url);
                    }
                }
            }
            
            // Agar rasm yuklashda xato bo'lmasa, ma'lumotlarni yangilashni davom ettiramiz
            if (empty($message)) { // Agar rasm yuklashda xato bo'lmagan bo'lsa
                $stmt = $conn->prepare("UPDATE mashinalar SET nomi = ?, soni = ?, narxi = ?, rasm_url = ? WHERE id = ?");
                $stmt->bind_param("sidsi", $new_nomi, $new_soni, $new_narxi, $rasm_url_to_save, $id_to_update);

                if ($stmt->execute()) {
                    $message = "<p style='color: green;'>Mashina ma'lumotlari muvaffaqiyatli yangilandi!</p>";
                } else {
                    $message = "<p style='color: red;'>Mashina ma'lumotlarini yangilashda xatolik: " . $stmt->error . "</p>";
                    // Agar DB ga saqlanmasa, yangi yuklangan rasmni o'chirish
                    if ($rasm_url_to_save !== $current_rasm_url && file_exists($rasm_url_to_save)) {
                        unlink($rasm_url_to_save);
                    }
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
    <title>Mashinalar Boshqaruvi (CRUD + Rasm)</title>
    <style>
        body { font-family: sans-serif; margin: 20px; background-color: #f4f4f4; color: #333; }
        h1, h2 { color: #0056b3; }
        .container { background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); margin-bottom: 30px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; vertical-align: middle; }
        th { background-color: #f2f2f2; }
        td img { max-width: 80px; max-height: 80px; display: block; margin: auto; border-radius: 4px;}
        form { margin-bottom: 20px; padding: 15px; border: 1px solid #eee; border-radius: 5px; background-color: #fafafa; }
        form label { display: block; margin-bottom: 5px; font-weight: bold; }
        form input[type="text"],
        form input[type="number"],
        form input[type="file"] {
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            width: calc(100% - 16px);
        }
        form input[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            padding: 8px 15px;
            border-radius: 4px;
            margin-right: 10px;
        }
        form input[type="submit"]:hover { background-color: #0056b3; }
        .delete-btn { background-color: #dc3545; }
        .delete-btn:hover { background-color: #c82333; }
        .update-btn { background-color: #ffc107; color: #333; }
        .update-btn:hover { background-color: #e0a800; }
        .message { margin-top: 10px; padding: 10px; border-radius: 5px; }
        .message p { margin: 0; }
        .error { background-color: #f8d7da; border-color: #f5c6cb; color: #721c24; }
        .success { background-color: #d4edda; border-color: #c3e6cb; color: #155724; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Mashinalar boshqaruvi</h1>
        <?php if (!empty($message)): ?>
            <div class="message <?php echo strpos($message, 'xatolik') !== false ? 'error' : 'success'; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <h2>Yangi mashina qo'shish</h2>
        <form method="POST" action="" enctype="multipart/form-data">
            <label for="nomi">Nomi:</label>
            <input type="text" id="nomi" name="nomi" required><br>

            <label for="soni">Soni:</label>
            <input type="number" id="soni" name="soni" min="1" required><br>

            <label for="narxi">Narxi:</label>
            <input type="number" id="narxi" name="narxi" step="0.01" min="0.01" required><br>

            <label for="rasm_url">Rasm:</label>
            <input type="file" id="rasm_url" name="rasm_url" accept="image/*" required><br><br>

            <input type="submit" name="add_mashina" value="Mashina qo'shish">
        </form>
    </div>

    <div class="container">
        <h2>Mavjud mashinalar</h2>
        <?php
        $sql_select = "SELECT id, nomi, soni, narxi, rasm_url FROM mashinalar ORDER BY id DESC";
        $result = $conn->query($sql_select);

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<thead>";
            echo "<tr><th>ID</th><th>Nomi</th><th>Soni</th><th>Narxi</th><th>Rasm</th><th>Amallar</th></tr>";
            echo "</thead>";
            echo "<tbody>";

            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . htmlspecialchars($row["nomi"]) . "</td>";
                echo "<td>" . $row["soni"] . "</td>";
                echo "<td>" . number_format($row["narxi"], 2, '.', '') . "</td>";
                echo "<td>";
                if ($row["rasm_url"] && file_exists($row["rasm_url"])) {
                    echo "<img src='" . htmlspecialchars($row["rasm_url"]) . "' alt='" . htmlspecialchars($row["nomi"]) . "'>";
                } else {
                    echo "Rasm yo'q";
                }
                echo "</td>";
                echo "<td>";
                // O'CHIRISH FORMASI
                echo "<form method='POST' action='' style='display:inline-block; margin-right: 5px;'>";
                echo "<input type='hidden' name='mashina_id' value='" . $row["id"] . "'>";
                echo "<input type='submit' name='delete_mashina' value='Ochirish' class='delete-btn' onclick='return confirm(\"Haqiqatan ham o'chirmoqchimisiz?\")'>";
                echo "</form>";

                // O'ZGARTIRISH FORMASI (har bir qator uchun alohida)
                // Ma'lumotlarni edit qilish uchun modal/popup yoki alohida sahifaga o'tish afzalroq bo'ladi.
                // Bu yerda soddalik uchun inline form ishlatilgan, ammo real loyihalarda tavsiya etilmaydi.
                echo "<form method='POST' action='' enctype='multipart/form-data' style='display:block; margin-top: 10px; border-top: 1px dashed #ccc; padding-top: 10px;'>";
                echo "<input type='hidden' name='mashina_id' value='" . $row["id"] . "'>";
                echo "<input type='hidden' name='current_rasm_url' value='" . htmlspecialchars($row["rasm_url"]) . "'>";

                echo "<label>Yangi nomi:</label>";
                echo "<input type='text' name='new_nomi' value='" . htmlspecialchars($row["nomi"]) . "' required style='width:auto;'><br>";

                echo "<label>Yangi soni:</label>";
                echo "<input type='number' name='new_soni' value='" . $row["soni"] . "' min='1' required style='width:auto;'><br>";

                echo "<label>Yangi narxi:</label>";
                echo "<input type='number' name='new_narxi' value='" . number_format($row["narxi"], 2, '.', '') . "' step='0.01' min='0.01' required style='width:auto;'><br>";
                
                echo "<label>Yangi rasm:</label>";
                echo "<input type='file' name='new_rasm_url' accept='image/*' style='width:auto;'><br>";
                if ($row["rasm_url"] && file_exists($row["rasm_url"])) {
                    echo "<small>Joriy rasm: <img src='" . htmlspecialchars($row["rasm_url"]) . "' style='width:30px; height:30px; vertical-align:middle; margin-left:5px;'></small><br>";
                }
                echo "<input type='submit' name='update_mashina' value='Yangilash' class='update-btn'>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
        } else {
            echo "<p>Hozircha hech qanday mashina mavjud emas.</p>";
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

**Kod tushuntirishi va muhim jihatlar:**

  * **`enctype="multipart/form-data"`**: Fayl yuklash uchun formaga qo'shilishi shart bo'lgan atribut.
  * **`$_FILES` global massivi**: PHPda yuklangan fayllarga ushbu massiv orqali murojaat qilinadi. Unda fayl nomi, vaqtinchalik joylashuvi, turi, hajmi va yuklashdagi xatolar haqida ma'lumotlar mavjud.
  * **`upload_image()` funksiyasi**:
      * Rasmni serverga yuklash jarayonini markazlashtiradi.
      * Fayl turini (`jpeg`, `jpg`, `png`, `gif`) va hajmini (2MB) tekshiradi.
      * `uniqid('img_', true)`: Fayl nomlari takrorlanmasligi uchun unikal nom yaratadi. `_true` qo'shimcha tasodifiy belgilar qo'shadi.
      * `move_uploaded_file($file_tmp, $upload_path)`: Yuklangan faylni vaqtinchalik joydan belgilangan `uploads/` papkasiga ko'chiradi.
  * **Rasm URLini saqlash:** `rasm_url` ustuniga yuklangan rasmning serverdagi manzilini (masalan, `uploads/img_650a3b2d9f1e1.jpg`) saqlaymiz.
  * **Rasmlarni o'chirish/yangilashda eski rasmni o'chirish:**
      * **O'chirishda (`DELETE`)**: Mahsulot o'chirilganda, u bilan bog'liq rasm ham serverdan o'chirilishi kerak (`unlink($old_image_url)`). Aks holda, keraksiz fayllar to'planib qoladi.
      * **Yangilashda (`UPDATE`)**: Agar yangi rasm yuklansa, eski rasm serverdan o'chirilishi kerak.
  * **Xatoliklarni boshqarish:** Rasm yuklashda yuzaga kelishi mumkin bo'lgan xatolar (noto'g'ri tur, katta hajm) foydalanuvchiga xabar sifatida ko'rsatiladi.
  * **Ma'lumotlar bazasi ulanishini yopish:** Skript oxirida `$conn->close()` orqali ulanish yopiladi.