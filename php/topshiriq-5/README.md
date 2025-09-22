## 1\. `chiqarish()` nomli funksiya yaratish

Birinchi topshiriq uchun, "Funksiya ishladi" matnini chiqaradigan oddiy funksiya yaratamiz.

```php
<?php

    echo "<h2>Oddiy funksiya</h2>";

    function chiqarish() {
        echo "Funksiya ishladi<br>";
    }

    // Funksiyani chaqirish
    chiqarish();

    echo "<hr>";

?>
```

  * **`function chiqarish() { ... }`**: Bu yerda `chiqarish` nomli funksiya aniqlanadi. Funksiya ichidagi kod, funksiya chaqirilganda ishga tushadi.
  * **`chiqarish();`**: Funksiyani ishga tushirish (chaqirish) uchun uning nomini va qavslarni yozish kerak.

-----

## 2\. `summa($a, $b)` nomli funksiya yaratish

Bu funksiya ikkita sonni qabul qiladi va ularning yig'indisini hisoblab qaytaradi.

```php
<?php

    echo "<h2>Summa hisoblovchi funksiya</h2>";

    function summa($a, $b) {
        $yigindi = $a + $b;
        return $yigindi; // Hisoblangan yig'indini qaytarish
    }

    // Funksiyani chaqirish va natijani chiqarish
    $son1 = 15;
    $son2 = 25;
    $natija = summa($son1, $son2); // Funksiyadan qaytgan qiymatni o'zgaruvchiga saqlash
    echo "$son1 va $son2 sonlarining yig'indisi: " . $natija . "<br>";

    $son3 = 100;
    $son4 = 50;
    echo "$son3 va $son4 sonlarining yig'indisi: " . summa($son3, $son4) . "<br>"; // To'g'ridan-to'g'ri chiqarish

    echo "<hr>";

?>
```

  * **`function summa($a, $b) { ... }`**: `summa` nomli funksiya aniqlandi. `$a` va `$b` bu funksiyaning **parametrlari** bo'lib, ular funksiya chaqirilganda qiymatlarni qabul qiladi.
  * **`return $yigindi;`**: `return` kalit so'zi funksiya ishini tugatadi va undan qiymat qaytaradi. Bu qaytarilgan qiymatni boshqa o'zgaruvchiga saqlash yoki to'g'ridan-to'g'ri ishlatish mumkin.

-----

## 3\. Talabalarni guruh bo'yicha filterlab chiqaruvchi funksiya

Ushbu topshiriqda talabalarning assosiativ massivini yaratamiz va ularni guruhiga ko'ra filterlab, ekranga chiqaradigan `filterByGroup()` funksiyasini tuzamiz.

```php
<?php

    echo "<h2>Talabalarni guruh bo'yicha filterlash</h2>";

    // 1. Talabalar nomli assosiativ massiv yaratish
    $talabalar = [
        [
            "id" => 1,
            "ismi" => "Ali",
            "guruhi" => "A-201"
        ],
        [
            "id" => 2,
            "ismi" => "Vali",
            "guruhi" => "B-202"
        ],
        [
            "id" => 3,
            "ismi" => "G'ani",
            "guruhi" => "A-201"
        ],
        [
            "id" => 4,
            "ismi" => "Dilorom",
            "guruhi" => "C-203"
        ],
        [
            "id" => 5,
            "ismi" => "Salima",
            "guruhi" => "B-202"
        ],
        [
            "id" => 6,
            "ismi" => "Akmal",
            "guruhi" => "A-201"
        ]
    ];

    // 2. filterByGroup funksiyasini yaratish
    function filterByGroup($students, $group) {
        $filteredStudents = []; // Filterlangan talabalarni saqlash uchun bo'sh massiv
        foreach ($students as $student) {
            // Agar talabaning guruhi berilgan guruhga mos kelsa
            if ($student['guruhi'] === $group) {
                $filteredStudents[] = $student; // Filterlangan massivga qo'shish
            }
        }
        return $filteredStudents; // Filterlangan talabalar massivini qaytarish
    }

    // 3. Funksiyadan foydalanish va natijani chiqarish

    echo "<h3>Barcha talabalar ro'yxati:</h3>";
    echo "<pre>";
    print_r($talabalar);
    echo "</pre>";

    echo "<h3>'A-201' guruhidagi talabalar:</h3>";
    $a201_guruhidagi_talabalar = filterByGroup($talabalar, "A-201");
    if (empty($a201_guruhidagi_talabalar)) {
        echo "Bu guruhda talaba topilmadi.<br>";
    } else {
        echo "<table border='1' cellpadding='5' cellspacing='0'>";
        echo "<thead><tr><th>ID</th><th>Ismi</th><th>Guruhi</th></tr></thead>";
        echo "<tbody>";
        foreach ($a201_guruhidagi_talabalar as $talaba) {
            echo "<tr>";
            echo "<td>" . $talaba['id'] . "</td>";
            echo "<td>" . $talaba['ismi'] . "</td>";
            echo "<td>" . $talaba['guruhi'] . "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    }

    echo "<h3>'B-202' guruhidagi talabalar:</h3>";
    $b202_guruhidagi_talabalar = filterByGroup($talabalar, "B-202");
    if (empty($b202_guruhidagi_talabalar)) {
        echo "Bu guruhda talaba topilmadi.<br>";
    } else {
        echo "<table border='1' cellpadding='5' cellspacing='0'>";
        echo "<thead><tr><th>ID</th><th>Ismi</th><th>Guruhi</th></tr></thead>";
        echo "<tbody>";
        foreach ($b202_guruhidagi_talabalar as $talaba) {
            echo "<tr>";
            echo "<td>" . $talaba['id'] . "</td>";
            echo "<td>" . $talaba['ismi'] . "</td>";
            echo "<td>" . $talaba['guruhi'] . "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    }

    echo "<h3>'X-999' guruhidagi talabalar:</h3>";
    $x999_guruhidagi_talabalar = filterByGroup($talabalar, "X-999");
    if (empty($x999_guruhidagi_talabalar)) {
        echo "Bu guruhda talaba topilmadi.<br>";
    } else {
        echo "<table border='1' cellpadding='5' cellspacing='0'>";
        echo "<thead><tr><th>ID</th><th>Ismi</th><th>Guruhi</th></tr></thead>";
        echo "<tbody>";
        foreach ($x999_guruhidagi_talabalar as $talaba) {
            echo "<tr>";
            echo "<td>" . $talaba['id'] . "</td>";
            echo "<td>" . $talaba['ismi'] . "</td>";
            echo "<td>" . $talaba['guruhi'] . "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    }

    echo "<hr>";

?>
```

  * **`$talabalar` massivi**: Har bir talaba uchun `id`, `ismi`, `guruhi` kalitlariga ega assosiativ massivlar to'plami.
  * **`filterByGroup($students, $group)` funksiyasi**:
      * Bu funksiya ikkita parametr qabul qiladi: `$students` (barcha talabalarni o'z ichiga olgan massiv) va `$group` (filterlash uchun guruh nomi).
      * **`$filteredStudents = [];`**: Natijalarni saqlash uchun bo'sh massiv yaratiladi.
      * **`foreach ($students as $student)`**: Berilgan talabalar massividagi har bir talabani aylanib chiqadi.
      * **`if ($student['guruhi'] === $group)`**: Joriy talabaning guruhi berilgan `$group`ga mos kelishini tekshiradi. **`===`** operatori qiymat va turning bir xilligini tekshiradi, bu esa aniqroq natija beradi.
      * **`$filteredStudents[] = $student;`**: Agar shart bajarilsa, joriy talaba `$filteredStudents` massiviga qo'shiladi.
      * **`return $filteredStudents;`**: Funksiya filterlangan talabalar massivini qaytaradi.
  * **`empty()` funksiyasi**: Massivning bo'sh ekanligini (ya'ni, hech qanday talaba topilmaganligini) tekshirish uchun ishlatiladi.
  * **HTML jadvali (`<table>`)**: Ma'lumotlarni tushunarli va tartibli ko'rinishda chiqarish uchun ishlatiladi.