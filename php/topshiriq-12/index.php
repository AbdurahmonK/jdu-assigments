<?php
    echo "<h2>Emailni tekshirish</h2>";

    $email_error = '';
    $email_success_message = '';

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['check_email'])) {
        $email = $_POST['email'] ?? ''; // Kiritilgan emailni olish

        // filter_var() funksiyasi yordamida email formatini tekshirish
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_error = "Kiritilgan email manzili noto'g'ri formatda!";
        } else {
            $email_success_message = "Email manzili to'g'ri formatda: <b>" . htmlspecialchars($email) . "</b>";
        }
    }
?>

<form method="POST" action="">
    <label for="email">Email manzilingizni kiriting:</label><br>
    <input type="text" id="email" name="email" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" required><br><br>
    <input type="submit" name="check_email" value="Tekshirish">
</form>

<?php
    if (!empty($email_error)) {
        echo "<p style='color: red;'>" . $email_error . "</p>";
    } elseif (!empty($email_success_message)) {
        echo "<p style='color: green;'>" . $email_success_message . "</p>";
    }
?>
<hr>

<?php
    echo "<h2>Ism va Yoshni tekshirish</h2>";

    $name_error = '';
    $age_error = '';
    $name_age_success_message = '';

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['check_name_age'])) {
        $name = $_POST['name'] ?? '';
        $age = $_POST['age'] ?? '';

        // Ism faqat harflardan iborat ekanligini tekshirish
        // preg_match() bilan faqat harflar (bo'sh joy ham ruxsat etiladi) va apostrof
        if (!preg_match("/^[a-zA-Z\s']+$/u", $name) || empty($name)) {
            $name_error = "Ism faqat harflardan iborat bo'lishi kerak!";
        }

        // Yosh son ekanligini tekshirish
        if (!is_numeric($age) || $age <= 0 || $age > 120) { // Yosh 1 dan 120 gacha bo'lishini ham tekshirish
            $age_error = "Yosh son bo'lishi va 1-120 oralig'ida bo'lishi kerak!";
        }

        // Agar xatoliklar bo'lmasa
        if (empty($name_error) && empty($age_error)) {
            $name_age_success_message = "Ism: <b>" . htmlspecialchars($name) . "</b>, Yosh: <b>" . htmlspecialchars($age) . "</b>. Ma'lumotlar to'g'ri.";
        }
    }
?>

<form method="POST" action="">
    <label for="name">Ismingizni kiriting:</label><br>
    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>" required><br><br>

    <label for="age">Yoshingizni kiriting:</label><br>
    <input type="number" id="age" name="age" value="<?php echo htmlspecialchars($_POST['age'] ?? ''); ?>" required><br><br>

    <input type="submit" name="check_name_age" value="Tekshirish">
</form>

<?php
    if (!empty($name_error)) {
        echo "<p style='color: red;'>" . $name_error . "</p>";
    }
    if (!empty($age_error)) {
        echo "<p style='color: red;'>" . $age_error . "</p>";
    }
    if (empty($name_error) && empty($age_error) && !empty($name_age_success_message)) {
        echo "<p style='color: green;'>" . $name_age_success_message . "</p>";
    }
?>
<hr>

<?php
    echo "<h2>Talaba ma'lumotlarini tekshirish</h2>";

    $student_id_error = '';
    $student_name_error = '';
    $student_surname_error = '';
    $student_success_message = '';

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['check_student'])) {
        $student_id = $_POST['student_id'] ?? '';
        $student_name = $_POST['student_name'] ?? '';
        $student_surname = $_POST['student_surname'] ?? '';

        // ID ni son ekanligini tekshirish
        if (!is_numeric($student_id) || $student_id <= 0) {
            $student_id_error = "ID raqam bo'lishi va 0 dan katta bo'lishi kerak!";
        }

        // Ismni faqat harflardan iborat ekanligini tekshirish (ctype_alpha() faqat harflarni tekshiradi, bo'sh joyni emas!)
        // ctype_alpha() faqat alifbo belgilarini (faqat harflar) tekshiradi, bo'sh joylarga ruxsat bermaydi.
        // Agar bo'sh joylarga ruxsat berish kerak bo'lsa, preg_match() dan foydalanish afzal.
        // Bu topshiriqda ctype_alpha() so'ralganligi uchun shuni ishlatamiz va bo'sh joy bo'lsa xato beramiz.
        if (!ctype_alpha($student_name) || empty($student_name)) {
            $student_name_error = "Ism faqat harflardan iborat bo'lishi kerak (bo'sh joylarsiz)!";
        }

        // Familiyani faqat harflardan iborat ekanligini tekshirish
        if (!ctype_alpha($student_surname) || empty($student_surname)) {
            $student_surname_error = "Familiya faqat harflardan iborat bo'lishi kerak (bo'sh joylarsiz)!";
        }

        // Agar xatoliklar bo'lmasa
        if (empty($student_id_error) && empty($student_name_error) && empty($student_surname_error)) {
            $student_success_message = "Talaba ma'lumotlari to'g'ri kiritildi:<br>" .
                                    "ID: <b>" . htmlspecialchars($student_id) . "</b><br>" .
                                    "Ism: <b>" . htmlspecialchars($student_name) . "</b><br>" .
                                    "Familiya: <b>" . htmlspecialchars($student_surname) . "</b>";
        }
    }
?>

<form method="POST" action="">
    <label for="student_id">Talaba ID:</label><br>
    <input type="number" id="student_id" name="student_id" value="<?php echo htmlspecialchars($_POST['student_id'] ?? ''); ?>" required min="1"><br><br>

    <label for="student_name">Ism:</label><br>
    <input type="text" id="student_name" name="student_name" value="<?php echo htmlspecialchars($_POST['student_name'] ?? ''); ?>" required><br><br>

    <label for="student_surname">Familiya:</label><br>
    <input type="text" id="student_surname" name="student_surname" value="<?php echo htmlspecialchars($_POST['student_surname'] ?? ''); ?>" required><br><br>

    <input type="submit" name="check_student" value="Ma'lumotlarni tekshirish">
</form>

<?php
    if (!empty($student_id_error)) {
        echo "<p style='color: red;'>" . $student_id_error . "</p>";
    }
    if (!empty($student_name_error)) {
        echo "<p style='color: red;'>" . $student_name_error . "</p>";
    }
    if (!empty($student_surname_error)) {
        echo "<p style='color: red;'>" . $student_surname_error . "</p>";
    }
    if (empty($student_id_error) && empty($student_name_error) && empty($student_surname_error) && !empty($student_success_message)) {
        echo "<p style='color: green;'>" . $student_success_message . "</p>";
    }
?>
<hr>