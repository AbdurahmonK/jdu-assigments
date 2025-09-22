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