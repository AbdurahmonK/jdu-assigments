<?php
    echo "<h2>Telefonlar ro'yxati (MySQL dan)</h2>";

    // Ma'lumotlar bazasi ulanish parametrlari
    $servername = "localhost"; // MySQL server manzili (odatda localhost)
    $username = "root";        // MySQL foydalanuvchi nomi (XAMPP/WAMP da default)
    $password = "root";        // MySQL paroli (XAMPP/WAMP da default bo'sh)
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