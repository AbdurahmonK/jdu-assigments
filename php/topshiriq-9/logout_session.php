<?php
    session_start();
    $_SESSION = array();

    // Agar Session Cookieda ham ishlatilgan bo'lsa, Cookie ni ham o'chirish
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    // Sessionni to'liq tugatish
    session_destroy();

    // Foydalanuvchini registratsiya sahifasiga yo'naltirish
    header("Location: register.php");
    exit();
?>