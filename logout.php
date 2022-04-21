<?php

    session_start();
    session_destroy();

    unset($_COOKIE["username"]);
    setcookie("username", "", -1);

    header("Location: login.php");
    exit;

?>