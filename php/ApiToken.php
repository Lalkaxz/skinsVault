<?php
session_start();

if(!isset($_SESSION["login"]) && !isset($_SESSION["password"]) && !isset($_SESSION["mail"])) {
    header("Location:/mainPage/index.php");
    die();
}

if(isset($_POST["Ftoken"])) {
    $userToken = $_POST["Ftoken"];
    setcookie("token", $userToken, time() + 604800, "/");
    header("Location:/skinsPage/index2.php");
} else {
    echo "Данные не заполнены";
    die();
}


