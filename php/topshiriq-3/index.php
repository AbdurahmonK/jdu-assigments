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

<?php

    echo "<h2>Ko'paytirish jadvali (`while` operatori yordamida)</h2>";

    $i = 1;
    while ($i <= 10) {
        $j = 1;
        while ($j <= 10) {
            echo $j . " x " . $i . " = " . ($i * $j) . "&nbsp;&nbsp;&nbsp;&nbsp;";
            $j++;
        }
        echo "<br>";
        $i++;
    }

    echo "<hr>";

?>

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