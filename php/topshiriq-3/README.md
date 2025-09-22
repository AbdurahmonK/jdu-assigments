## 1\. PHP da yangi "3-topshiriq" nomli proekt yaratish

Yangi dars uchun yangi loyiha papkasini yaratamiz va asosiy faylni joylashtiramiz.

1.  **Papka yaratish:** Kompyuteringizda **`3-topshiriq`** nomli yangi papka yarating.

      * **Windows:** O'ng tugmani bosing -\> "New" -\> "Folder" -\> `3-topshiriq` deb nomlang.
      * **macOS/Linux:** Terminalda: `mkdir 3-topshiriq`

2.  **`index.php` faylini yaratish:** `3-topshiriq` papkasi ichiga **`index.php`** nomli yangi fayl yarating. Bu fayl keyingi topshiriqlarning kodini o'z ichiga oladi.

      * **Windows:** `3-topshiriq` papkasini oching, o'ng tugmani bosing -\> "New" -\> "Text Document" -\> `index.php` deb nomlang. (Fayl kengaytmasi `.php` ekanligiga ishonch hosil qiling.)
      * **macOS/Linux:** Terminalda `cd 3-topshiriq` buyrug'i bilan papkaga o'ting, so'ng `touch index.php` buyrug'ini bering.

3.  **PHP built-in serverini ishga tushirish:**
    Terminalni oching va `cd` buyrug'i yordamida `3-topshiriq` papkasiga o'ting. So'ngra quyidagi buyruqni ishga tushiring:

    ```bash
    php -S localhost:8000
    ```

    Bu serverni `http://localhost:8000` manzilida ishga tushiradi. Brauzeringizda ushbu manzilga kirib, natijalarni ko'rishingiz mumkin.

-----

## 2\. `for` operatori yordamida 1 dan 100 gacha sonlarni ekranga chiqarish

Har bitta qatorda 10 tadan son chiqsin va 10 ga qoldiqsiz bo'lingan sonlar **qalin shriftda** chiqishi kerak.

`index.php` faylingizni oching va quyidagi kodni yozing:

```php
<?php

    echo "<h2>1 dan 100 gacha sonlar</h2>";

    for ($i = 1; $i <= 100; $i++) {
        // Agar son 10 ga qoldiqsiz bo'linsa, qalin shriftda chiqaramiz
        if ($i % 10 == 0) {
            echo "<b>" . $i . "</b> ";
            // Har 10 ta sondan keyin yangi qatorga o'tamiz
            echo "<br>";
        } else {
            echo $i . " ";
        }
    }

    echo "<hr>";

?>
```

  * **`for` sikli:** $i$ o'zgaruvchisi 1 dan boshlab 100 gacha bitta-bitta ortib boradi.
  * **`%` (modulus) operatori:** Bu operator qoldiqni hisoblaydi. `$i % 10 == 0` sharti `$i` soni 10 ga qoldiqsiz bo'linsa, `true` qiymat qaytaradi.
  * **`<b>` va `</b>` HTML teglari:** Matnni qalin qilish uchun ishlatiladi.
  * **`<br>` HTML tegi:** Yangi qatorga o'tish uchun ishlatiladi.

-----

## 3\. `while` operatori yordamida ko'paytirish jadvalini chiqarish

Ko'paytirish jadvalini, odatda 1 dan 10 gacha bo'lgan sonlar uchun chiqaramiz.

```php
<?php

    echo "<h2>Ko'paytirish jadvali (`while` operatori yordamida)</h2>";

    $i = 1; // Birinchi ko'paytuvchi
    while ($i <= 10) {
        $j = 1; // Ikkinchi ko'paytuvchi
        while ($j <= 10) {
            echo $j . " x " . $i . " = " . ($i * $j) . "&nbsp;&nbsp;&nbsp;&nbsp;"; // &nbsp; bo'sh joy qo'yish uchun
            $j++;
        }
        echo "<br>"; // Har bir qator tugagandan so'ng yangi qatorga o'tish
        $i++;
    }

    echo "<hr>";

?>
```

  * Bu yerda ichma-ich joylashgan ikkita **`while`** siklidan foydalanilgan.
  * Tashqi `while` sikli `$i` (birinchi ko'paytuvchi) ni 1 dan 10 gacha o'zgartiradi.
  * Ichki `while` sikli `$j` (ikkinchi ko'paytuvchi) ni 1 dan 10 gacha o'zgartiradi va ko'paytmani hisoblab chiqaradi.
  * `&nbsp;` HTML belgisi bir nechta bo'sh joy yaratish uchun ishlatiladi, natijada jadval bir oz tartibliroq ko'rinadi.

-----

## 4\. `talabalar` massivi va `foreach` operatori yordamida ro'yxatni chiqarish

Talabalar ro'yxatini HTML **`<ul>`** (tartibsiz ro'yxat) va **`<li>`** (ro'yxat elementi) teglari yordamida brauzerda chiqaramiz.

```php
<?php

    echo "<h2>Talabalar ro'yxati (`foreach` operatori yordamida)</h2>";

    $talabalar = ["Ali", "Vali", "G'ani", "Salima", "Dilorom", "Akmal"];

    echo "<h3>Talabalar ro'yxati:</h3>";
    echo "<ul>"; // Tartibsiz ro'yxat boshlanishi

    foreach ($talabalar as $talaba) {
        echo "<li>" . $talaba . "</li>"; // Har bir talabani ro'yxat elementi sifatida chiqarish
    }

    echo "</ul>"; // Tartibsiz ro'yxat yakuni

    echo "<hr>";

?>
```

  * **`$talabalar` massivi:** Bir qator ismlarni saqlovchi massiv yaratilgan.
  * **`foreach` sikli:** Massivning har bir elementini birma-bir aylanib chiqish uchun ishlatiladi. `$talabalar as $talaba` sintaksisi har bir aylanishda massivdagi joriy elementni `$talaba` o'zgaruvchisiga o'zlashtiradi.
  * **`<ul>` va `<li>` HTML teglari:** Veb-sahifalarda ro'yxatlar yaratish uchun standart HTML teglari.

-----

## 5\. Berilgan son tub yoki tub emas ekanligini aniqlovchi dastur (`while` operatori yordamida)

Tub son — 1 dan katta bo'lgan, faqat 1 ga va o'ziga bo'linadigan natural sondir.

```php
<?php

    echo "<h2>Sonning tub yoki tub emasligini aniqlash (`while` operatori yordamida)</h2>";

    $son = 29; // Tekshiriladigan son
    echo "Tekshirilayotgan son: " . $son . "<br>";

    $tub_son_mi = true; // Boshida sonni tub deb hisoblaymiz

    // Agar son 1 dan kichik yoki teng bo'lsa, u tub emas
    if ($son <= 1) {
        $tub_son_mi = false;
    } else {
        $i = 2; // Bo'luvchi 2 dan boshlanadi
        // Bo'luvchi sonning kvadrat ildizigacha tekshiriladi, chunki undan keyingi bo'luvchilar allaqachon tekshirilgan bo'ladi
        while ($i * $i <= $son) {
            if ($son % $i == 0) {
                $tub_son_mi = false; // Agar qoldiqsiz bo'linsa, tub emas
                break; // Birorta bo'luvchi topilsa, tekshirishni to'xtatish
            }
            $i++;
        }
    }

    if ($tub_son_mi) {
        echo $son . " soni tub sondir.<br>";
    } else {
        echo $son . " soni tub son emas.<br>";
    }

    echo "<hr>";

?>
```

  * **`$son`:** Tub yoki tub emasligini tekshirmoqchi bo'lgan son.
  * **`$tub_son_mi`:** Mantiqiy o'zgaruvchi. Dastlab `true` (tub) deb o'rnatiladi, agar bo'luvchi topilsa `false` (tub emas) qilinadi.
  * **`while` sikli:** `$i` (bo'luvchi) ni 2 dan boshlab, `$son` ning kvadrat ildizigacha tekshiradi. Bu optimallashtirish hisoblanadi, chunki agar sonning bo'luvchisi bo'lsa, uning kvadrat ildizidan kichik bo'lgan birorta bo'luvchi albatta topiladi.
  * **`break`:** Agar sonning bo'luvchisi topilsa, `while` siklini to'xtatadi, chunki sonning tub emasligi allaqachon aniqlangan bo'ladi.