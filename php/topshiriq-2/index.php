<?php

    echo "<h2>5 ta turli tipdagi o'zgaruvchilar</h2>";

    // 1. Integer (Butun son)
    $yosh = 30;
    echo "Yosh: " . $yosh . " (Turi: " . gettype($yosh) . ")<br>";

    // 2. Double (O'nli son)
    $narx = 12.99;
    echo "Narx: " . $narx . " (Turi: " . gettype($narx) . ")<br>";

    // 3. String (Matn)
    $ism = "Ali";
    echo "Ism: " . $ism . " (Turi: " . gettype($ism) . ")<br>";

    // 4. Boolean (Mantiqiy qiymat)
    $aktiv = true; // Yoki false
    echo "Foydalanuvchi aktivmi: " . ($aktiv ? "Ha" : "Yo'q") . " (Turi: " . gettype($aktiv) . ")<br>";

    // 5. Array (Massiv)
    $mevalar = ["olma", "nok", "uzum"];
    echo "Sevimli mevalar: " . implode(", ", $mevalar) . " (Turi: " . gettype($mevalar) . ")<br>";

    // 6. Null (Qiymat yo'qligi) - Bonus
    $hech_narsa = null;
    echo "Hech narsa: " . ($hech_narsa === null ? "NULL" : $hech_narsa) . " (Turi: " . gettype($hech_narsa) . ")<br>";

    echo "<hr>";

?>

<?php

    echo "<h2>Eng katta va eng kichik sonni aniqlash</h2>";

    $A = 25;
    $B = 10;
    $C = 40;

    echo "A = $A, B = $B, C = $C <br>";

    // Eng katta sonni aniqlash
    if ($A >= $B && $A >= $C) {
        $eng_katta = $A;
    } elseif ($B >= $A && $B >= $C) {
        $eng_katta = $B;
    } else {
        $eng_katta = $C;
    }

    // Eng kichik sonni aniqlash
    if ($A <= $B && $A <= $C) {
        $eng_kichik = $A;
    } elseif ($B <= $A && $B <= $C) {
        $eng_kichik = $B;
    } else {
        $eng_kichik = $C;
    }

    echo "Eng katta son: " . $eng_katta . "<br>";
    echo "Eng kichik son: " . $eng_kichik . "<br>";

    echo "<hr>";

?>

<?php

    echo "<h2>Talaba fanidan o'tgan yoki o'tmaganligini aniqlash</h2>";

    $qatnashish_foizi = 75; // Talabaning darsga qatnashish foizi
    $baho_foizi = 80;      // Talabaning fandan olgan bahosi foizda

    echo "Darsga qatnashish foizi: " . $qatnashish_foizi . "%<br>";
    echo "Baho foizi: " . $baho_foizi . "%<br>";

    if ($qatnashish_foizi < 70) {
        echo "Talaba fandan yiqildi (darsga qatnashish 70% dan kam).<br>";
    } else {
        if ($baho_foizi >= 86 && $baho_foizi <= 100) {
            echo "Talaba bahosi: 5 (A'lo).<br>";
        } elseif ($baho_foizi >= 71 && $baho_foizi <= 85) {
            echo "Talaba bahosi: 4 (Yaxshi).<br>";
        } elseif ($baho_foizi >= 56 && $baho_foizi <= 70) {
            echo "Talaba bahosi: 3 (Qoniqarli).<br>";
        } else {
            echo "Talaba fandan yiqildi (baho 56% dan past).<br>";
        }
    }

    echo "<hr>";

?>

<?php

    echo "<h2>Foydalanuvchi tizimga kirishi</h2>";

    $togri_username = "jdu_talaba123"; // To'g'ri username
    $togri_parol = "Talaba123";      // To'g'ri parol

    // Foydalanuvchi kiritgan ma'lumotlar (sinov uchun)
    $kiritilgan_username = "jdu_talaba123";
    $kiritilgan_parol = "Talaba123";

    echo "Kiritilgan Username: " . $kiritilgan_username . "<br>";
    echo "Kiritilgan Parol: " . $kiritilgan_parol . "<br>";

    if ($kiritilgan_username === $togri_username && $kiritilgan_parol === $togri_parol) {
        echo "Siz muvaffaqiyatli kirdingiz!<br>";
    } elseif ($kiritilgan_username !== $togri_username && $kiritilgan_parol !== $togri_parol) {
        echo "Username va parol xato!<br>";
    } elseif ($kiritilgan_username !== $togri_username) {
        echo "Username xato!<br>";
    } else { // ($kiritilgan_parol !== $togri_parol)
        echo "Parol xato!<br>";
    }

    echo "<hr>";

?>