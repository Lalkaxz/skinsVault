<?php
session_start();




$userName = null;
$userMail = null;
$userPassword = null;

$connect = mysqli_connect("localhost", "root", "", "mydatabase");
$conn = mysqli_connect("localhost", "root", "", "skinsDB");
if($connect == false) {
    die("Ошибка подключения: ".mysqli_connect_error());
}




if(empty($_POST["username"]) && empty($_POST["email"]) && empty($_POST["password"]) ) {
    echo "Нет значений... <br>";
    die();
} else {

    if(isset($_POST["username"])) {
        $userName = htmlentities($_POST["username"]);
    } else {
        echo "Инпут username пустой, данные не записаны <br>";
        die();
    }

    if(isset($_POST["email"])) {
        $userMail = htmlentities($_POST['email']);
    } else {
        echo "Инпут email пустой, данные не записаны <br>";
        die();
    }

    if(isset($_POST["password"])) {
        $userPassword = htmlentities($_POST["password"]);
    } else {
        echo "Инпут password пустой, данные не записаны <br>";
        die();
    }
}

$tmpReq = mysqli_query($connect, "SELECT * FROM `usersdb` WHERE `name` = '$userName'");
if(mysqli_fetch_assoc($tmpReq)) {
    die("Такой пользователь уже существует");
}


$sqldata = "INSERT INTO `usersdb` (`id`, `name`, `email`, `password`) VALUES (NULL, '$userName', '$userMail', '$userPassword')";





if(mysqli_query($connect, $sqldata)) {
    echo "Данные добавлены в БД <br>";
    if(!isset($_COOKIE["token"])) {
        setcookie("token", "null", time()+604800, "/");
    }
    $_SESSION["login"] = $userName;
    $_SESSION["password"] = $userPassword;
    $_SESSION["mail"] = $userMail; 
    $tmpDBname = "table_".$userName;
    $sqlUserDB = "CREATE TABLE `skinsDB`.`$tmpDBname` (`id` INT UNSIGNED NOT NULL AUTO_INCREMENT , `name` VARCHAR(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL , `type` VARCHAR(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL , `source` VARCHAR(512) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL , UNIQUE `id` (`id`) , UNIQUE `name` (`name`)) ENGINE = InnoDB CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;";
    
    mysqli_query($conn, $sqlUserDB);
    mysqli_close($conn);
    header("Location:/skinspage/index2.php");
} else {
    echo "Ошибка добавления данных: ".mysqli_error($connect)."<br>";
    die();
}

mysqli_close($connect);

