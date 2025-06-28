<?php
    session_start();

    if (!isset($_SESSION["admin"])) {
        header("Location: /dev-web-2/Bibliotheque/auth/login.php");
        exit();
    }
?>