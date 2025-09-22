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

    echo "<hr />";

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