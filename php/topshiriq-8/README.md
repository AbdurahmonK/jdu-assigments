## 1\. MySQL da `asaxiy` maʼlumotlar bazasini va `foydalanuvchilar` jadvalini yaratish

Bu qismni PHP kodidan oldin, bevosita MySQL serverida (masalan, phpMyAdmin orqali) bajaramiz.

**1.1. phpMyAdmin ga kirish:**
Brauzeringizda `http://localhost:8888/phpMyAdmin5/` manziliga kirib, phpMyAdmin boshqaruv panelini oching.

**1.2. `asaxiy` maʼlumotlar bazasini yaratish:**

  * phpMyAdmin interfeysida chap tomondagi menyudan **"New"** (yoki "Yangi") tugmasini bosing.
  * "Create database" (yoki "Maʼlumotlar bazasini yaratish") maydoniga **`asaxiy`** deb yozing va **"Create"** (yoki "Yaratish") tugmasini bosing.

**1.3. `foydalanuvchilar` jadvalini yaratish:**

  * Endi chap menyudan yangi yaratilgan **`asaxiy`** maʼlumotlar bazasini tanlang.
  * Oʻng tomondagi asosiy maydonda "Create table" (yoki "Jadval yaratish") qismida "Name" (yoki "Nomi") maydoniga **`foydalanuvchilar`** deb yozing.
  * "Number of columns" (yoki "Ustunlar soni") ni **`5`** ga oʻrnating va **"Create"** (yoki "Yaratish") tugmasini bosing.

**1.4. `foydalanuvchilar` jadvalining ustunlarini sozlash:**
Jadval yaratish sahifasida quyidagi ustunlarni kiriting:

| Nomi          | Turi        | Uzunligi/Qiymatlari | Null | Indeks    | A\_I   |
| :------------ | :---------- | :------------------ | :--- | :-------- | :---- |
| `id`          | `INT`       | `11`                |      | `PRIMARY` | (belgilash) |
| `ismi`        | `VARCHAR`   | `255`               |      |           |       |
| `familiyasi`  | `VARCHAR`   | `255`               |      |           |       |
| `tel_raqami`  | `VARCHAR`   | `20`                |      |           |       |
| `viloyati`    | `VARCHAR`   | `100`               |      |           |       |

  * `id` ustuni uchun **`A_I` (Auto Increment)** belgisini qoʻying. Bu har bir yangi yozuv uchun avtomatik ravishda unikal ID yaratadi. `PRIMARY` indeksini tanlaganingizda, u avtomatik ravishda `id` ni asosiy kalit (primary key) qiladi.
  * Barcha ustunlarni kiritib boʻlgach, pastdagi **"Save"** (yoki "Saqlash") tugmasini bosing.

-----

## 2\. PHP da `asaxiy` proektini yaratish va maʼlumotlar bazasiga bogʻlanish

Endi PHPda `asaxiy` maʼlumotlar bazasiga bogʻlanish va `foydalanuvchilar` jadvalidan maʼlumotlarni olib, veb-sahifaga jadval koʻrinishida chiqarish dasturini tuzamiz.

**2.1. `asaxiy` nomli proekt papkasini yaratish:**

  * Kompyuteringizda **`asaxiy`** nomli yangi papka yarating.
      * **Windows:** O'ng tugma -\> "New" -\> "Folder" -\> `asaxiy`
      * **macOS/Linux:** Terminalda: `mkdir asaxiy`

**2.2. `index.php` faylini yaratish:**

  * `asaxiy` papkasi ichiga **`index.php`** nomli fayl yarating.

**2.3. PHP built-in serverini ishga tushirish:**

  * Terminalni oching, `asaxiy` papkasiga o'ting: `cd asaxiy`
  * Serverni ishga tushiring: `php -S localhost:8000`
  * Brauzerda `http://localhost:8000` manziliga kiring.

**2.4. `index.php` fayliga kod yozish:**
`index.php` fayliga quyidagi kodni yozing:

```php
<?php
  echo "<h1>Asaxiy.uz foydalanuvchilari</h1>";

  // Ma'lumotlar bazasi ulanish parametrlari
  $servername = "localhost";
  $username = "root";
  $password = "root";
  $dbname = "asaxiy";

  // Ma'lumotlar bazasiga ulanish
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Ulanishni tekshirish
  if ($conn->connect_error) {
      die("Ulanishda xatolik: " . $conn->connect_error);
  }

  echo "<h2>Foydalanuvchilar ro'yxati</h2>";

  // SQL so'rovini tayyorlash (foydalanuvchilar jadvalidagi barcha ma'lumotlarni olish)
  $sql_select = "SELECT id, ismi, familiyasi, tel_raqami, viloyati FROM foydalanuvchilar";
  $result = $conn->query($sql_select);

  // Natijalarni tekshirish va chiqarish
  if ($result->num_rows > 0) {
      echo "<table border='1' cellpadding='10' cellspacing='0'>";
      echo "<thead>";
      echo "<tr><th>ID</th><th>Ismi</th><th>Familiyasi</th><th>Telefon Raqami</th><th>Viloyati</th></tr>";
      echo "</thead>";
      echo "<tbody>";

      // Har bir qator ma'lumotini olish va jadvalga chiqarish
      while($row = $result->fetch_assoc()) {
          echo "<tr>";
          echo "<td>" . $row["id"] . "</td>";
          echo "<td>" . $row["ismi"] . "</td>";
          echo "<td>" . $row["familiyasi"] . "</td>";
          echo "<td>" . $row["tel_raqami"] . "</td>";
          echo "<td>" . $row["viloyati"] . "</td>";
          echo "</tr>";
      }
      echo "</tbody>";
      echo "</table>";
  } else {
      echo "<p>Jadvalda hech qanday foydalanuvchi topilmadi.</p>";
  }

?>

<hr>
```

**Kod tushuntirishi:**

  * Yuqoridagi kod `mysqli` orqali MySQL maʼlumotlar bazasiga ulanadi.
  * `SELECT` SQL soʻrovi yordamida `foydalanuvchilar` jadvalidan barcha maʼlumotlarni oladi.
  * Natijalar `while` sikli yordamida HTML jadvaliga joylashtiriladi.
  * `connect_error` orqali ulanishdagi xatolar tekshiriladi va `die()` orqali skript toʻxtatiladi.

-----

## 3\. `foydalanuvchilar` jadvaliga maʼlumot qoʻshuvchi HTML forma va PHP skripti

Bu topshiriqda foydalanuvchidan maʼlumotlarni qabul qilish va ularni `foydalanuvchilar` jadvaliga kiritish uchun forma va PHP skripti yaratamiz. Ushbu qismni ham `index.php` fayliga qoʻshishimiz mumkin.

```php
<?php
// ... (Yuqoridagi ulanish kodlari va foydalanuvchilar ro'yxati shu yerda tugaydi) ...

echo "<h2>Yangi foydalanuvchi qo'shish</h2>";

// POST so'rovi orqali ma'lumotlar yuborilganini tekshirish
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_user'])) {
    // Formadan kelgan ma'lumotlarni xavfsiz qabul qilish
    $ismi = htmlspecialchars($_POST['ismi']);
    $familiyasi = htmlspecialchars($_POST['familiyasi']);
    $tel_raqami = htmlspecialchars($_POST['tel_raqami']);
    $viloyati = htmlspecialchars($_POST['viloyati']);

    // SQL INSERT so'rovini tayyorlash
    // Prepared statements (tayyorlangan iboralar) SQL Injectiondan himoyalanish uchun juda muhim!
    $stmt = $conn->prepare("INSERT INTO foydalanuvchilar (ismi, familiyasi, tel_raqami, viloyati) VALUES (?, ?, ?, ?)");
    
    // Parametrlarni bog'lash (s - string, i - integer, d - double, b - blob)
    $stmt->bind_param("ssss", $ismi, $familiyasi, $tel_raqami, $viloyati);

    // So'rovni bajarish
    if ($stmt->execute()) {
        echo "<p style='color: green;'>Yangi foydalanuvchi muvaffaqiyatli qo'shildi!</p>";
        // Ma'lumotlar qo'shilgandan so'ng sahifani yangilash (foydalanuvchilar ro'yxati yangilanadi)
        echo "<meta http-equiv='refresh' content='0'>"; // Sahifani avtomatik yangilash
    } else {
        echo "<p style='color: red;'>Xatolik yuz berdi: " . $stmt->error . "</p>";
    }

    // Statementni yopish
    $stmt->close();
}
?>

<form method="POST" action="">
    <label for="new_ismi">Ismi:</label><br>
    <input type="text" id="new_ismi" name="ismi" required><br><br>

    <label for="new_familiyasi">Familiyasi:</label><br>
    <input type="text" id="new_familiyasi" name="familiyasi" required><br><br>

    <label for="new_tel_raqami">Telefon Raqami:</label><br>
    <input type="text" id="new_tel_raqami" name="tel_raqami" required><br><br>

    <label for="new_viloyati">Viloyati:</label><br>
    <select id="new_viloyati" name="viloyati" required>
        <option value="">Viloyatni tanlang</option>
        <option value="Toshkent">Toshkent</option>
        <option value="Samarqand">Samarqand</option>
        <option value="Buxoro">Buxoro</option>
        <option value="Andijon">Andijon</option>
        <option value="Farg'ona">Farg'ona</option>
        <option value="Namangan">Namangan</option>
        <option value="Xorazm">Xorazm</option>
        <option value="Qashqadaryo">Qashqadaryo</option>
        <option value="Surxondaryo">Surxondaryo</option>
        <option value="Jizzax">Jizzax</option>
        <option value="Sirdaryo">Sirdaryo</option>
        <option value="Navoiy">Navoiy</option>
        <option value="Qoraqalpog'iston">Qoraqalpog'iston</option>
    </select><br><br>

    <input type="submit" name="add_user" value="Foydalanuvchi qo'shish">
</form>

<?php
// Ma'lumotlar bazasi ulanishini yopish (faqat barcha operatsiyalar tugagandan so'ng)
$conn->close();
?>
```

**Kod tushuntirishi:**

  * **`if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_user']))`**: Forma yuborilganini tekshiradi.
  * **`htmlspecialchars()`**: Foydalanuvchi kiritgan ma'lumotlarni HTML xavfsizligi uchun tozlaydi.
  * **Prepared Statements (`$conn->prepare()`, `$stmt->bind_param()`, `$stmt->execute()`):**
      * **`$stmt = $conn->prepare("INSERT INTO foydalanuvchilar (ismi, familiyasi, tel_raqami, viloyati) VALUES (?, ?, ?, ?)");`**: Bu eng xavfsiz usul bo'lib, SQL Injection hujumlaridan himoya qiladi. `?` belgilari qiymatlar o'rniga joy tutuvchilar (placeholders) hisoblanadi.
      * **`$stmt->bind_param("ssss", $ismi, $familiyasi, $tel_raqami, $viloyati);`**: Bu qator joy tutuvchilarga qiymatlarni bog'laydi. "ssss" stringi to'rtta string (matn) turidagi parametr borligini bildiradi. Harflar tartibi parametrlarning turiga mos kelishi kerak.
      * **`$stmt->execute()`**: Tayyorlangan so'rovni bajaradi.
  * **`echo "<meta http-equiv='refresh' content='0'>";`**: Bu qator ma'lumotlar qo'shilgandan so'ng sahifani avtomatik ravishda yangilash uchun ishlatiladi. Bu yangi qo'shilgan foydalanuvchini jadvalda ko'rsatishga yordam beradi.
  * **`$stmt->close();`**: Tayyorlangan statement resursini yopish.
  * **`$conn->close();`**: Ma'lumotlar bazasi ulanishini yopish. Uni skript oxirida, barcha DB operatsiyalari tugaganidan keyin chaqirish kerak.

Barcha topshiriqlar bitta `index.php` faylida berilgan tartibda joylashtirilishi kerak. Serverni ishga tushirganingizdan so'ng, brauzerda natijalarni ko'rishingiz mumkin. Avval foydalanuvchilar ro'yxatini ko'rasiz, so'ngra yangi foydalanuvchi qo'shish formasini to'ldirib, ma'lumotlarni qo'shishingiz mumkin. Qo'shilganidan so'ng sahifa yangilanadi va yangi foydalanuvchi ro'yxatda paydo bo'ladi.