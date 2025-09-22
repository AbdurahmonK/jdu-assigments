<?php

    $servername = "localhost";
    $username_db = "root"; // MySQL user name
    $password_db = "root";     // MySQL password
    $dbname = "texnomart"; // Oldingi darsda yaratilgan yoki yangi yaratilgan baza nomi

    // Ma'lumotlar bazasiga ulanish
    $conn = new mysqli($servername, $username_db, $password_db, $dbname);

    // Ulanishni tekshirish
    if ($conn->connect_error) {
        die("Ulanishda xatolik: " . $conn->connect_error);
    }

    // Xabar o'zgaruvchisi
    $message = '';

    /* YANGI MAHSULOT QO'SHISH (CREATE) */
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_product'])) {
        $nomi = htmlspecialchars($_POST['nomi']);
        $soni = (int)$_POST['soni']; // Sonni integerga o'tkazish
        $narxi = (float)$_POST['narxi']; // Narxni floatga o'tkazish

        if (empty($nomi) || $soni <= 0 || $narxi <= 0) {
            $message = "<p style='color: red;'>Iltimos, barcha maydonlarni to'g'ri to'ldiring (soni va narxi 0 dan katta bo'lsin).</p>";
        } else {
            $stmt = $conn->prepare("INSERT INTO mahsulotlar (nomi, soni, narxi) VALUES (?, ?, ?)");
            $stmt->bind_param("sid", $nomi, $soni, $narxi); // s: string, i: integer, d: double/float

            if ($stmt->execute()) {
                $message = "<p style='color: green;'>Yangi mahsulot muvaffaqiyatli qo'shildi!</p>";
            } else {
                $message = "<p style='color: red;'>Mahsulot qo'shishda xatolik: " . $stmt->error . "</p>";
            }
            $stmt->close();
        }
    }

    /* MAHSULOTNI O'CHIRISH (DELETE) */
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_product'])) {
        $id_to_delete = (int)$_POST['product_id'];

        $stmt = $conn->prepare("DELETE FROM mahsulotlar WHERE id = ?");
        $stmt->bind_param("i", $id_to_delete); // i: integer

        if ($stmt->execute()) {
            $message = "<p style='color: green;'>Mahsulot muvaffaqiyatli o'chirildi!</p>";
        } else {
            $message = "<p style='color: red;'>Mahsulot o'chirishda xatolik: " . $stmt->error . "</p>";
        }
        $stmt->close();
    }

    /* MAHSULOT MA'LUMOTLARINI O'ZGARTIRISH (UPDATE) */
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_product'])) {
        $id_to_update = (int)$_POST['product_id'];
        $new_nomi = htmlspecialchars($_POST['new_nomi']);
        $new_soni = (int)$_POST['new_soni'];
        $new_narxi = (float)$_POST['new_narxi'];

        if (empty($new_nomi) || $new_soni <= 0 || $new_narxi <= 0) {
            $message = "<p style='color: red;'>Iltimos, barcha maydonlarni to'g'ri to'ldiring (soni va narxi 0 dan katta bo'lsin).</p>";
        } else {
            $stmt = $conn->prepare("UPDATE mahsulotlar SET nomi = ?, soni = ?, narxi = ? WHERE id = ?");
            $stmt->bind_param("sidi", $new_nomi, $new_soni, $new_narxi, $id_to_update); // s: string, i: int, d: double, i: int

            if ($stmt->execute()) {
                $message = "<p style='color: green;'>Mahsulot ma'lumotlari muvaffaqiyatli yangilandi!</p>";
            } else {
                $message = "<p style='color: red;'>Mahsulot ma'lumotlarini yangilashda xatolik: " . $stmt->error . "</p>";
            }
            $stmt->close();
        }
    }
?>

<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mahsulotlar Boshqaruvi (CRUD)</title>
    <style>
        body { font-family: sans-serif; margin: 20px; background-color: #f4f4f4; color: #333; }
        h1, h2 { color: #0056b3; }
        .container { background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); margin-bottom: 30px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        form { margin-bottom: 20px; padding: 15px; border: 1px solid #eee; border-radius: 5px; background-color: #fafafa; }
        form label { display: block; margin-bottom: 5px; font-weight: bold; }
        form input[type="text"],
        form input[type="number"],
        form input[type="submit"] {
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        form input[type="text"], form input[type="number"] { width: calc(100% - 16px); }
        form input[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            width: auto;
            min-width: 120px;
            margin-right: 10px;
        }
        form input[type="submit"]:hover { background-color: #0056b3; }
        .delete-btn { background-color: #dc3545; }
        .delete-btn:hover { background-color: #c82333; }
        .update-btn { background-color: #ffc107; color: #333; }
        .update-btn:hover { background-color: #e0a800; }
        .message { margin-top: 10px; padding: 10px; border-radius: 5px; }
        .message p { margin: 0; }
        .error { background-color: #f8d7da; border-color: #f5c6cb; color: #721c24; }
        .success { background-color: #d4edda; border-color: #c3e6cb; color: #155724; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Mahsulotlar boshqaruvi</h1>
        <?php if (!empty($message)): ?>
            <div class="message <?php echo strpos($message, 'xatolik') !== false ? 'error' : 'success'; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <h2>Yangi mahsulot qo'shish</h2>
        <form method="POST" action="">
            <label for="nomi">Nomi:</label>
            <input type="text" id="nomi" name="nomi" required><br><br>

            <label for="soni">Soni:</label>
            <input type="number" id="soni" name="soni" min="1" required><br><br>

            <label for="narxi">Narxi:</label>
            <input type="number" id="narxi" name="narxi" step="0.01" min="0.01" required><br><br>

            <input type="submit" name="add_product" value="Mahsulot qo'shish">
        </form>
    </div>

    <div class="container">
        <h2>Mavjud mahsulotlar</h2>
        <?php
        $sql_select = "SELECT id, nomi, soni, narxi FROM mahsulotlar ORDER BY id DESC";
        $result = $conn->query($sql_select);

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<thead>";
            echo "<tr><th>ID</th><th>Nomi</th><th>Soni</th><th>Narxi</th><th>Amallar</th></tr>";
            echo "</thead>";
            echo "<tbody>";

            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . htmlspecialchars($row["nomi"]) . "</td>";
                echo "<td>" . $row["soni"] . "</td>";
                echo "<td>" . number_format($row["narxi"], 2, '.', '') . "</td>"; // Narxni formatlash
                echo "<td>";
                // O'CHIRISH FORMASI
                echo "<form method='POST' action='' style='display:inline-block; margin-right: 5px;'>";
                echo "<input type='hidden' name='product_id' value='" . $row["id"] . "'>";
                echo "<input type='submit' name='delete_product' value=Ochirish' class='delete-btn' onclick='return confirm(\"Haqiqatan ham o'chirmoqchimisiz?\")'>";
                echo "</form>";

                // O'ZGARTIRISH FORMASI (har bir qator uchun alohida)
                echo "<form method='POST' action='' style='display:inline-block;'>";
                echo "<input type='hidden' name='product_id' value='" . $row["id"] . "'>";
                echo "<label for='new_nomi_" . $row["id"] . "' style='display:none;'>Nomi:</label>"; // Yashirin label
                echo "<input type='text' id='new_nomi_" . $row["id"] . "' name='new_nomi' value='" . htmlspecialchars($row["nomi"]) . "' required style='width:100px;'>";

                echo "<label for='new_soni_" . $row["id"] . "' style='display:none;'>Soni:</label>"; // Yashirin label
                echo "<input type='number' id='new_soni_" . $row["id"] . "' name='new_soni' value='" . $row["soni"] . "' min='1' required style='width:60px;'>";

                echo "<label for='new_narxi_" . $row["id"] . "' style='display:none;'>Narxi:</label>"; // Yashirin label
                echo "<input type='number' id='new_narxi_" . $row["id"] . "' name='new_narxi' value='" . number_format($row["narxi"], 2, '.', '') . "' step='0.01' min='0.01' required style='width:80px;'>";
                
                echo "<input type='submit' name='update_product' value='Yangilash' class='update-btn'>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
        } else {
            echo "<p>Hozircha hech qanday mahsulot mavjud emas.</p>";
        }
        ?>
    </div>

<?php $conn->close();?>
</body>
</html>