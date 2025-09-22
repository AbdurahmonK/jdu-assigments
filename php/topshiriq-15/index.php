<?php
    require_once 'config.php';

    $message = '';

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_staff'])) {
        $ismi = htmlspecialchars($_POST['ismi']);
        $familiyasi = htmlspecialchars($_POST['familiyasi']);

        if (empty($ismi) || empty($familiyasi)) {
            $message = "<p style='color: red;'>Iltimos, ism va familiyani to'ldiring.</p>";
        } else {
            if (!preg_match("/^[a-zA-Z\s'’ʻ]+$/u", $ismi)) {
                $message = "<p style='color: red;'>Ism faqat harflardan iborat bo'lishi kerak.</p>";
            } elseif (!preg_match("/^[a-zA-Z\s'’ʻ]+$/u", $familiyasi)) {
                $message = "<p style='color: red;'>Familiya faqat harflardan iborat bo'lishi kerak.</p>";
            } else {
                $stmt = $conn->prepare("INSERT INTO xodimlar (ismi, familiyasi) VALUES (?, ?)");
                $stmt->bind_param("ss", $ismi, $familiyasi);

                if ($stmt->execute()) {
                    $message = "<p style='color: green;'>Yangi xodim muvaffaqiyatli qo'shildi!</p>";
                } else {
                    $message = "<p style='color: red;'>Xodim qo'shishda xatolik: " . $stmt->error . "</p>";
                }
                $stmt->close();
            }
        }
    }


    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_staff'])) {
        $id_to_delete = (int)$_POST['xodim_id'];

        $stmt = $conn->prepare("DELETE FROM xodimlar WHERE id = ?");
        $stmt->bind_param("i", $id_to_delete);

        if ($stmt->execute()) {
            $message = "<p style='color: green;'>Xodim muvaffaqiyatli o'chirildi!</p>";
        } else {
            $message = "<p style='color: red;'>Xodimni o'chirishda xatolik: " . $stmt->error . "</p>";
        }
        $stmt->close();
    }
?>

<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Davomat Tizimi - Xodimlar</title>
    <style>
        body { font-family: sans-serif; margin: 20px; background-color: #f4f4f4; color: #333; }
        .container { background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); margin-bottom: 30px; }
        h1, h2 { color: #0056b3; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        form { margin-bottom: 20px; padding: 15px; border: 1px solid #eee; border-radius: 5px; background-color: #fafafa; }
        form label { display: block; margin-bottom: 5px; font-weight: bold; }
        form input[type="text"],
        form input[type="submit"] {
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            width: calc(100% - 16px);
        }
        form input[type="submit"] {
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
            width: auto;
            min-width: 120px;
            margin-right: 10px;
        }
        form input[type="submit"]:hover { background-color: #218838; }
        .delete-btn { background-color: #dc3545; }
        .delete-btn:hover { background-color: #c82333; }
        .edit-btn { background-color: #ffc107; color: #333; }
        .edit-btn:hover { background-color: #e0a800; }
        .message { margin-top: 10px; padding: 10px; border-radius: 5px; }
        .message p { margin: 0; }
        .error { background-color: #f8d7da; border-color: #f5c6cb; color: #721c24; }
        .success { background-color: #d4edda; border-color: #c3e6cb; color: #155724; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Davomat Tizimi - Xodimlar</h1>
        <?php if (!empty($message)): ?>
            <div class="message <?php echo strpos($message, 'xatolik') !== false ? 'error' : 'success'; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <h2>Yangi xodim qo'shish</h2>
        <form method="POST" action="">
            <label for="ismi">Ismi:</label>
            <input type="text" id="ismi" name="ismi" required><br>

            <label for="familiyasi">Familiyasi:</label>
            <input type="text" id="familiyasi" name="familiyasi" required><br><br>

            <input type="submit" name="add_staff" value="Xodim qo'shish">
        </form>
    </div>

    <div class="container">
        <h2>Xodimlar ro'yxati</h2>
        <?php
        $sql_select = "SELECT id, ismi, familiyasi FROM xodimlar ORDER BY id DESC";
        $result = $conn->query($sql_select);

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<thead>";
            echo "<tr><th>ID</th><th>Ismi</th><th>Familiyasi</th><th>Amallar</th></tr>";
            echo "</thead>";
            echo "<tbody>";

            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . htmlspecialchars($row["ismi"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["familiyasi"]) . "</td>";
                echo "<td>";
                echo "<form method='POST' action='' style='display:inline-block; margin-right: 5px;'>";
                echo "<input type='hidden' name='xodim_id' value='" . $row["id"] . "'>";
                echo "<input type='submit' name='delete_staff' value='O'chirish' class='delete-btn' onclick='return confirm(\"Haqiqatan ham " . htmlspecialchars($row["ismi"]) . " " . htmlspecialchars($row["familiyasi"]) . "ni o'chirmoqchimisiz?\")'>";
                echo "</form>";
                echo "<a href='edit.php?id=" . $row["id"] . "' class='edit-btn' style='text-decoration:none; padding:8px 15px; border-radius:4px;'>O'zgartirish</a>";
                echo "</td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
        } else {
            echo "<p>Hozircha hech qanday xodim mavjud emas.</p>";
        }
        ?>
    </div>

<?php $conn->close();?>
</body>
</html>