<?php 
    session_start(); 

$LuserName = null;
$LuserPass = null;

$connect = mysqli_connect("localhost","root","","mydatabase");

if($connect == false) {
    die("Ошибка подключения: ".mysqli_connect_error());
}


if(empty($_POST["Lusername"]) && empty($_POST["Lpassword"])) {
    echo "Нет значений... <br>";
} else {
    if(isset($_POST["Lusername"])) {
        $LuserName = htmlentities($_POST["Lusername"]);
    } else {
        echo "Инпут Lusername пустой, данные не записаны <br>";
    }
    
    if(isset($_POST["Lpassword"])) {
        $LuserPass = htmlentities($_POST["Lpassword"]);
    } else {
        echo "Инпут Lpassword пустой, данные не записаны <br>";
    }
    $sqlrequest = "SELECT * FROM `usersdb` WHERE `name` = '$LuserName' ";
    $result = mysqli_query($connect, $sqlrequest);
    if(mysqli_num_rows($result) == 0) {
        echo "Пользователь не найден";
        die();
    } else {
        $sqlGetPass = "SELECT * FROM `usersdb` WHERE `name` = '$LuserName' AND `password` = '$LuserPass' ";
        $resultPass = mysqli_query($connect, $sqlGetPass);
        if(mysqli_num_rows($resultPass) == 0) {
            echo "Имя пользователя или пароль неверный <br>";
            die();
        } else {
            $user = mysqli_fetch_assoc($result);
            $_SESSION["login"] = $LuserName;
            $_SESSION["password"] = $LuserPass;
            $_SESSION["mail"] = $user["email"];
            if(!isset($_COOKIE["token"])) {
                setcookie("token", "null", time()+604800, "/");
            }
            

            header("Location:/skinsPage/index2.php");

        
        }
    }
}
mysqli_close($connect);