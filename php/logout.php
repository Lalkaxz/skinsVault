<?php

session_start();

if(!isset($_SESSION["login"]) && !isset($_SESSION["password"]) && !isset($_SESSION["mail"])) {
    header("Location:/mainPage/index.php");
    die();
}

unset($_SESSION["login"]);
unset($_SESSION["password"]);
setcookie("token", "", time() - 3600, "/");
header("Location:/mainPage/index.php");