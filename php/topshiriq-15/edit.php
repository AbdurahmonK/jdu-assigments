<?php
    require_once 'config.php';

    $message = '';
    $xodim_data = null;

    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $xodim_id = (int)$_GET['id'];
        $stmt = $conn->prepare("SELECT id, ismi, familiyasi FROM xodimlar WHERE id = ?");
        $stmt->bind_param("i", $xodim_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $xodim_data = $result->fetch_assoc();
        } else {
            $message = "<p style='color: red;'>Xodim topilmadi.</p>";
        }
        $stmt->close();
    } else {
        $message = "<p style='color: red;'>Xodim ID si noto'g'ri yoki mavjud emas.</p>";
        header("Location: index.php");
        exit();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_staff'])) {
        $xodim_id = (int)$_POST['xodim_id'];
        $new_ismi = htmlspecialchars($_POST['new_ismi']);
        $new_familiyasi = htmlspecialchars($_POST['new_familiyasi']);

        if (empty($new_ismi) || empty($new_familiyasi)) {
            $message = "<p style='color: red;'>Iltimos, ism va familiyani to'ldiring.</p>";
        } else {
            if (!preg_match("/^[a-zA-Z\s'’ʻ]+$/u", $new_ismi)) {
                $message = "<p style='color: red;'>Ism faqat harflardan iborat bo'lishi kerak.</p>";
            } elseif (!preg_match("/^[a-zA-Z\s'’ʻ]+$/u", $new_familiyasi)) {
                $message = "<p style='color: red;'>Familiya faqat harflardan iborat bo'lishi kerak.</p>";
            } else {
                $stmt = $conn->prepare("UPDATE xodimlar SET ismi = ?, familiyasi = ? WHERE id = ?");
                $stmt->bind_param("ssi", $new_ismi, $new_familiyasi, $xodim_id);

                if ($stmt->execute()) {
                    $message = "<p style='color: green;'>Xodim ma'lumotlari muvaffaqiyatli yangilandi!</p>";
                    $xodim_data['ismi'] = $new_ismi;
                    $xodim_data['familiyasi'] = $new_familiyasi;
                } else {
                    $message = "<p style='color: red;'>Ma'lumotlarni yangilashda xatolik: " . $stmt->error . "</p>";
                }
                $stmt->close();
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xodim ma'lumotlarini o'zgartirish</title>
    <style>
        body { font-family: sans-serif; margin: 20px; background-color: #f4f4f4; color: #333; }
        .container { background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); max-width: 500px; margin: 50px auto; }
        h1, h2 { color: #0056b3; text-align: center; }
        form label { display: block; margin-bottom: 5px; font-weight: bold; }
        form input[type="text"],
        form input[type="submit"] {
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            width: 100%;
        }
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
        .back-link { display: block; text-align: center; margin-top: 20px; text-decoration: none; color: #007bff; }
        .back-link:hover { text-decoration: underline; }
        .message { margin-top: 10px; padding: 10px; border-radius: 5px; text-align: center; }
        .message p { margin: 0; }
        .error { background-color: #f8d7da; border-color: #f5c6cb; color: #721c24; }
        .success { background-color: #d4edda; border-color: #c3e6cb; color: #155724; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Xodim ma'lumotlarini o'zgartirish</h1>
        <?php if (!empty($message)): ?>
            <div class="message <?php echo strpos($message, 'xatolik') !== false ? 'error' : 'success'; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <?php if ($xodim_data): ?>
            <form method="POST" action="">
                <input type="hidden" name="xodim_id" value="<?php echo htmlspecialchars($xodim_data['id']); ?>">
                
                <label for="new_ismi">Ismi:</label>
                <input type="text" id="new_ismi" name="new_ismi" value="<?php echo htmlspecialchars($xodim_data['ismi']); ?>" required><br>

                <label for="new_familiyasi">Familiyasi:</label>
                <input type="text" id="new_familiyasi" name="new_familiyasi" value="<?php echo htmlspecialchars($xodim_data['familiyasi']); ?>" required><br><br>

                <input type="submit" name="update_staff" value="Yangilash">
            </form>
        <?php else: ?>
            <p>Xodim ma'lumotlarini yuklashda muammo yuz berdi.</p>
        <?php endif; ?>
        <a href="index.php" class="back-link">Barcha xodimlar ro'yxatiga qaytish</a>
    </div>

<?php $conn->close();?>
</body>
</html>