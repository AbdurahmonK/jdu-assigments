<?php

    echo "<h2>Oddiy funksiya</h2>";

    function chiqarish() {
        echo "Funksiya ishladi<br>";
    }

    // Funksiyani chaqirish
    chiqarish();

    echo "<hr>";

?>

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