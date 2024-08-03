<?php
session_start();
include "../php/database.php";

if (isset($_SESSION["login"]) && $_SESSION["password"]) {
    $id = null;
    $login = $_SESSION["login"];
    $tmpDBname = "table_".$login;

    if (isset($_POST["numDeletedSkin"])) {
        $id = htmlentities($_POST["numDeletedSkin"]);
    } else {
        echo "Данные не переданы";
        die();
    }

$res = mysqli_query($connect, "SELECT * FROM `$tmpDBname` WHERE `id` = '$id'");

if(mysqli_num_rows($res) == 0) {
    echo "Вы ввели несуществующий номер скина";
    die();
} else if (mysqli_num_rows($res) == 1) {
    mysqli_query($connect, "DELETE FROM `$tmpDBname` WHERE `id` = $id;");

    $largNum = mysqli_query($connect, "SELECT * FROM `$tmpDBname` WHERE `id` > '$id'");
    while ($numRow = mysqli_fetch_assoc($largNum)) {
        $tmpIdNum = $numRow["id"] - 1;
        $tmpId = $numRow["id"];
        echo $tmpIdNum;
        echo "<br>";
        mysqli_query($connect, "UPDATE `$tmpDBname` SET `id` = $tmpIdNum WHERE `table_Name`.`id` = $tmpId");

    }
}


} else {
    header("Location:/mainPage/index.php");
    die();
}
header("Location:/skinsPage/index2.php");
mysqli_close($connect);

