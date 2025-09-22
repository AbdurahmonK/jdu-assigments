## 1\. MySQL da `texnomart` maʼlumotlar bazasini va `telefonlar` jadvalini yaratish

Bu qismni PHP kodidan oldin, bevosita MySQL serverida (masalan, phpMyAdmin orqali) bajaramiz.

**1.1. phpMyAdmin ga kirish:**
Brauzeringizda `http://localhost:8888/phpMyAdmin5/` manziliga kirib, phpMyAdmin boshqaruv panelini oching. Agar parolsiz kirilmasa, serveringiz konfiguratsiyasini tekshiring (odatda XAMPPda root foydalanuvchisi parolsiz boʻladi).

**1.2. `texnomart` maʼlumotlar bazasini yaratish:**

  * phpMyAdmin interfeysida chap tomondagi menyudan "New" (yoki "Yangi") tugmasini bosing.
  * "Create database" (yoki "Maʼlumotlar bazasini yaratish") maydoniga `texnomart` deb yozing va "Create" (yoki "Yaratish") tugmasini bosing.

**1.3. `telefonlar` jadvalini yaratish:**

  * Endi chap menyudan yangi yaratilgan `texnomart` maʼlumotlar bazasini tanlang.
  * Oʻng tomondagi asosiy maydonda "Create table" (yoki "Jadval yaratish") qismida "Name" (yoki "Nomi") maydoniga `telefonlar` deb yozing.
  * "Number of columns" (yoki "Ustunlar soni") ni `4` ga oʻrnating va "Create" (yoki "Yaratish") tugmasini bosing.

**1.4. `telefonlar` jadvalining ustunlarini sozlash:**
Jadval yaratish sahifasida quyidagi ustunlarni kiriting:

| Nomi   | Turi        | Uzunligi/Qiymatlari | Null   | Indeks | A\_I |
| :----- | :---------- | :------------------ | :----- | :----- | :-- |
| `id`   | `INT`       | `11`                | (belgilanmagan) | `PRIMARY` | (belgilash) |
| `nomi` | `VARCHAR`   | `255`               | (belgilanmagan) |        |     |
| `narxi`| `DECIMAL`   | `10,2`              | (belgilanmagan) |        |     |
| `soni` | `INT`       | `11`                | (belgilanmagan) |        |     |

  * `id` ustuni uchun **`A_I` (Auto Increment)** belgisini qoʻying. Bu har bir yangi yozuv uchun avtomatik ravishda unikal ID yaratadi. `PRIMARY` indeksini tanlaganingizda, u avtomatik ravishda `id` ni asosiy kalit (primary key) qiladi.
  * Barcha ustunlarni kiritib boʻlgach, pastdagi "Save" (yoki "Saqlash") tugmasini bosing.

**1.5. Jadvalga test maʼlumotlari kiritish (ixtiyoriy, lekin tavsiya etiladi):**

  * `telefonlar` jadvalini tanlang.
  * Yuqoridagi menyudan "Insert" (yoki "Kiritish") boʻlimiga oʻting.
  * Quyidagi kabi bir nechta telefon maʼlumotlarini kiriting va "Go" (yoki "Kiritish") tugmasini bosing:
      * **1-telefon:** nomi: `Samsung Galaxy S24`, narxi: `1200.00`, soni: `50`
      * **2-telefon:** nomi: `iPhone 15 Pro`, narxi: `1500.00`, soni: `30`
      * **3-telefon:** nomi: `Xiaomi 14`, narxi: `800.00`, soni: `70`

-----

## 2\. PHP da `texnomart` proektini yaratish va maʼlumotlar bazasiga bogʻlanish

Endi PHPda `texnomart` maʼlumotlar bazasiga bogʻlanish va `telefonlar` jadvalidan maʼlumotlarni olib, veb-sahifaga jadval koʻrinishida chiqarish dasturini tuzamiz.

**2.1. `texnomart` nomli proekt papkasini yaratish:**

  * Oldingi darslardagi kabi, `texnomart` nomli yangi papka yarating.
      * **Windows:** O'ng tugma -\> "New" -\> "Folder" -\> `texnomart`
      * **macOS/Linux:** Terminalda: `mkdir texnomart`

**2.2. `index.php` faylini yaratish:**

  * `texnomart` papkasi ichiga `index.php` nomli fayl yarating.

**2.3. PHP built-in serverini ishga tushirish:**

  * Terminalni oching, `texnomart` papkasiga o'ting: `cd texnomart`
  * Serverni ishga tushiring: `php -S localhost:8000`
  * Brauzerda `http://localhost:8000` manziliga kiring.

**2.4. `index.php` fayliga kod yozish:**
`index.php` fayliga quyidagi kodni yozing:

```php
<?php
  echo "<h2>Telefonlar ro'yxati (MySQL dan)</h2>";

  // Ma'lumotlar bazasi ulanish parametrlari
  $servername = "localhost"; // MySQL server manzili (odatda localhost)
  $username = "root";        // MySQL foydalanuvchi nomi (XAMPP/WAMP da default)
  $password = "";            // MySQL paroli (XAMPP/WAMP da default bo'sh)
  $dbname = "texnomart";     // Yuqorida yaratgan ma'lumotlar bazasi nomi

  // Ma'lumotlar bazasiga ulanish
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Ulanishni tekshirish
  if ($conn->connect_error) {
      die("Ulanishda xatolik: " . $conn->connect_error);
  }

  echo "<p>Ma'lumotlar bazasiga muvaffaqiyatli ulandik!</p>";

  // SQL so'rovini tayyorlash (telefonlar jadvalidagi barcha ma'lumotlarni olish)
  $sql = "SELECT id, nomi, narxi, soni FROM telefonlar";
  $result = $conn->query($sql);

  // Natijalarni tekshirish va chiqarish
  if ($result->num_rows > 0) {
      echo "<table border='1' cellpadding='10' cellspacing='0'>";
      echo "<thead>";
      echo "<tr><th>ID</th><th>Nomi</th><th>Narxi</th><th>Soni</th></tr>";
      echo "</thead>";
      echo "<tbody>";

      // Har bir qator ma'lumotini olish va jadvalga chiqarish
      while($row = $result->fetch_assoc()) {
          echo "<tr>";
          echo "<td>" . $row["id"] . "</td>";
          echo "<td>" . $row["nomi"] . "</td>";
          echo "<td>" . $row["narxi"] . "</td>";
          echo "<td>" . $row["soni"] . "</td>";
          echo "</tr>";
      }
      echo "</tbody>";
      echo "</table>";
  } else {
      echo "Jadvalda hech qanday telefon topilmadi.";
  }

  // Ma'lumotlar bazasi ulanishini yopish
  $conn->close();

  echo "<hr>";
?>
```

**Kod tushuntirishi:**

1.  **Maʼlumotlar bazasi ulanish parametrlari:**

      * `$servername`, `$username`, `$password`, `$dbname` oʻzgaruvchilari MySQL serveriga ulanish uchun zarur boʻlgan maʼlumotlarni saqlaydi. Odatda XAMPP/WAMP/Laragon bilan `localhost`, `root`, bo'sh parol ishlatiladi.

2.  **Maʼlumotlar bazasiga ulanish (`mysqli` obyekti):**

      * `$conn = new mysqli($servername, $username, $password, $dbname);`
          * Bu qator **`mysqli`** obyektini yaratadi, bu obyekt yordamida PHPdan MySQL maʼlumotlar bazasi bilan aloqa qilamiz. `mysqli` PHPning MySQL bilan ishlash uchun eng tavsiya etilgan kengaytmasidir.
      * `$conn->connect_error`: Agar ulanishda xatolik yuz bersa, bu xususiyatda xato xabari boʻladi.
      * `die()`: Xatolik yuz berganda skriptni toʻxtatish uchun ishlatiladi.

3.  **SQL soʻrovini tayyorlash va bajarish:**

    * `$sql = "SELECT id, nomi, narxi, soni FROM telefonlar";`
        * Bu SQL soʻrovi `telefonlar` jadvalidan `id`, `nomi`, `narxi` va `soni` ustunlaridagi barcha maʼlumotlarni tanlashni buyuradi.
    * `$result = $conn->query($sql);`
        * `$conn->query()` funksiyasi SQL soʻrovini bajaradi va natijani `$result` oʻzgaruvchisiga qaytaradi. `SELECT` soʻrovlari uchun bu obyekt natijalar toʻplamini (result set) oʻz ichiga oladi.

4.  **Natijalarni tekshirish va chiqarish:**

    * `if ($result->num_rows > 0)`: Bu shart soʻrov natijasida birorta ham qator topilgan yoki topilmaganligini tekshiradi. `num_rows` xususiyati natijalar toʻplamidagi qatorlar sonini beradi.
    * **`while($row = $result->fetch_assoc())`**:
        * `fetch_assoc()` metodi natijalar toʻplamidan keyingi qatorni (row) assosiativ massiv sifatida oladi. Yaʼni, ustun nomlari massiv kalitlari sifatida ishlatiladi (masalan, `$row["nomi"]`).
        * `while` sikli natijalar toʻplamidagi barcha qatorlar tugaguncha davom etadi.
    * `echo "<td>" . $row["id"] . "</td>";` va boshqalar: Har bir qatorning maʼlumotlari HTML jadval katakchalariga chiqariladi.

5.  **Ulanishni yopish:**
    * `$conn->close();`: Maʼlumotlar bazasi bilan aloqani tugatish uchun ishlatiladi. Ish tugagandan soʻng ulanishni yopish yaxshi amaliyotdir.