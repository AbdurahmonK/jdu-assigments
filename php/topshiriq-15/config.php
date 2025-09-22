<?php
    $servername = "localhost";
    $username_db = "root";
    $password_db = "root";
    $dbname = "davomat_tizimi";

    $conn = new mysqli($servername, $username_db, $password_db, $dbname);

    if ($conn->connect_error) {
        die("Ulanishda xatolik: " . $conn->connect_error);
    }
?>