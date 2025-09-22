## 1\. HTML formasidan ma'lumotlarni qabul qilish va chiqarish

**1.1. `index.php` faylini yaratish:**
`6-topshiriq` nomli papka yarating (agar yaratilmagan bo'lsa) va uning ichiga `index.php` nomli fayl hosil qiling. Barcha kodlar shu faylga yoziladi.

**1.2. HTML forma va PHP kodi:**
`index.php` fayliga quyidagi kodni yozing:

```php
<?php
    echo "<h2>Ism va Familiyani qabul qilish</h2>";

    // POST so'rovi orqali ma'lumotlar yuborilganini tekshirish
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_task1'])) {
        $ismi = htmlspecialchars($_POST['ismi']);
        $familiyasi = htmlspecialchars($_POST['familiyasi']);

        echo "<h3>Kiritilgan ma'lumotlar:</h3>";
        echo "Ismi: <b>" . $ismi . "</b><br>";
        echo "Familiyasi: <b>" . $familiyasi . "</b><br>";
    }
?>

<form method="POST" action="">
    <label for="ismi">Ism:</label><br>
    <input type="text" id="ismi" name="ismi" required><br><br>

    <label for="familiyasi">Familiya:</label><br>
    <input type="text" id="familiyasi" name="familiyasi" required><br><br>

    <input type="submit" name="submit_task1" value="Ma'lumotlarni yuborish">
</form>

<hr>
```

**Tushuntirish:**

  * **`<form method="POST" action="">`**: `method="POST"` ma'lumotlarni serverga yashirincha yuborishni bildiradi. `action=""` esa formani shu sahifaning o'ziga qayta yuborishni anglatadi.
  * **`name="ismi"` va `name="familiyasi"`**: Bu atributlar input maydonlarining nomlari bo'lib, PHPda ularga `$ _POST['ismi']` kabi murojaat qilish imkonini beradi.
  * **`isset($_POST['submit_task1'])`**: Bu, forma yuborilganligini tekshirish uchun ishlatiladi (faqat "Ma'lumotlarni yuborish" tugmasi bosilgandagina kod ishlaydi).
  * **`$_SERVER["REQUEST_METHOD"] == "POST"`**: So'rovning turi POST ekanligini tekshiradi.
  * **`htmlspecialchars()`**: Xavfsizlik uchun ishlatiladi. Bu funksiya foydalanuvchi kiritgan ma'lumotlardagi maxsus HTML belgilarini konvertatsiya qilib, XSS (Cross-Site Scripting) hujumlarining oldini oladi.

-----

## 2\. HTML formasidan talaba ma'lumotlarini qabul qilish (shu jumladan `select` orqali viloyat)

```php
<?php

    echo "<h2>Talaba ma'lumotlarini qabul qilish</h2>";

    // POST so'rovi orqali ma'lumotlar yuborilganini tekshirish
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_task2'])) {
        $talaba_id = htmlspecialchars($_POST['talaba_id']);
        $talaba_ismi = htmlspecialchars($_POST['talaba_ismi']);
        $talaba_familiyasi = htmlspecialchars($_POST['talaba_familiyasi']);
        $viloyat = htmlspecialchars($_POST['viloyat']);

        echo "<h3>Kiritilgan talaba ma'lumotlari:</h3>";
        echo "Talaba ID: <b>" . $talaba_id . "</b><br>";
        echo "Ismi: <b>" . $talaba_ismi . "</b><br>";
        echo "Familiyasi: <b>" . $talaba_familiyasi . "</b><br>";
        echo "Viloyati: <b>" . $viloyat . "</b><br>";
    }
?>

<form method="POST" action="">
    <label for="talaba_id">Talaba ID:</label><br>
    <input type="text" id="talaba_id" name="talaba_id" required><br><br>

    <label for="talaba_ismi">Ismi:</label><br>
    <input type="text" id="talaba_ismi" name="talaba_ismi" required><br><br>

    <label for="talaba_familiyasi">Familiyasi:</label><br>
    <input type="text" id="talaba_familiyasi" name="talaba_familiyasi" required><br><br>

    <label for="viloyat">Viloyati:</label><br>
    <select id="viloyat" name="viloyat" required>
        <option value="">Viloyatni tanlang</option>
        <option value="Toshkent">Toshkent</option>
        <option value="Samarqand">Samarqand</option>
        <option value="Buxoro">Buxoro</option>
        <option value="Andijon">Andijon</option>
        <option value="Farg'ona">Farg'ona</option>
        <option value="Namangan">Namangan">Namangan</option>
        <option value="Xorazm">Xorazm</option>
        <option value="Qashqadaryo">Qashqadaryo</option>
        <option value="Surxondaryo">Surxondaryo</option>
        <option value="Jizzax">Jizzax</option>
        <option value="Sirdaryo">Sirdaryo</option>
        <option value="Navoiy">Navoiy</option>
        <option value="Qoraqalpog'iston">Qoraqalpog'iston</option>
    </select><br><br>

    <input type="submit" name="submit_task2" value="Ma'lumotlarni saqlash">
</form>

<hr>
```

**Tushuntirish:**

  * **`<select>` va `<option>`**: Bu teglardan dropdown (tanlash) ro'yxatlari yaratishda foydalaniladi. `name="viloyat"` selekt maydonining nomi bo'lib, tanlangan `option` ning `value` atributidagi qiymat PHPga yuboriladi.

-----

## 3\. Registratsiya formasi va shartli tekshiruv

```php
<?php

    echo "<h2>Registratsiya formasi</h2>";

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_task3'])) {
        $login = htmlspecialchars($_POST['login']);
        $parol = htmlspecialchars($_POST['parol']);

        // Talabaning haqiqiy ismi va IDsi (bu misol uchun qattiq kodlangan)
        $togri_ismi = "Ali"; // Talaba ismi
        $togri_id = "12345";  // Talaba IDsi (parol sifatida ishlatiladi)

        if ($login === $togri_ismi && $parol === $togri_id) {
            echo "<p style='color: green; font-weight: bold;'>Siz muvaffaqiyatli kirdingiz!</p>";
        } else {
            echo "<p style='color: red; font-weight: bold;'>Login yoki parol noto'g'ri!</p>";
        }
    }
?>

<form method="POST" action="">
    <label for="login">Login (Talaba ismi):</label><br>
    <input type="text" id="login" name="login" required><br><br>

    <label for="parol">Parol (Talaba ID):</label><br>
    <input type="password" id="parol" name="parol" required><br><br>

    <input type="submit" name="submit_task3" value="Tizimga kirish">
</form>

<hr>
```

**Tushuntirish:**

  * **`type="password"`**: Bu input maydonida kiritilgan belgilar yulduzcha (`*`) yoki doiracha (`•`) shaklida ko'rinadi, bu parollar uchun xavfsizlikni ta'minlaydi.
  * **`$togri_ismi` va `$togri_id`**: Bu yerda to'g'ri login va parol qiymatlari qattiq kodlangan. Haqiqiy ilovalarda bu ma'lumotlar ma'lumotlar bazasidan olinadi.
  * **`if ($login === $togri_ismi && $parol === $togri_id)`**: Foydalanuvchi kiritgan `login` va `parol` oldindan belgilangan to'g'ri qiymatlar bilan qat'iy tekshiriladi (`===`). Ikkala shart ham bajarilsagina tizimga kirishga ruxsat beriladi.
  * **`style='color: green; font-weight: bold;'`**: Natija xabarini rangli va qalin qilib chiqarish uchun inline CSS ishlatilgan.