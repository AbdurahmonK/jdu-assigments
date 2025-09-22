<?php
    // 'user' nomli cookie ni o'chirish
    // Cookie ni o'chirish uchun uning amal qilish muddatini o'tmishga o'rnatish kerak
    setcookie('user', '', time() - 3600, "/");

    // Foydalanuvchini login sahifasiga yo'naltirish
    header("Location: index.php");
    exit();
?>