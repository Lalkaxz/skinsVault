<?php
session_start();


include "database.php";




$nameTable = "";
$typeSkin = "";
$skinSrc = "";

if(!isset($_SESSION["login"]) && !isset($_SESSION["password"])) {
    header("Location:/mainPage/index.php");
    die();
}




if(isset($_POST["name"]) && isset($_POST["selectForm"]) && ( isset($_FILES["skin"]) || isset($_POST["nickname"]) )) {

    $nameTable = mysqli_real_escape_string($connect, $_POST["name"]);
    $typeSkin = mysqli_real_escape_string($connect, $_POST["selectForm"]);

    if (isset($_FILES["skin"]) && is_file($_FILES["skin"]["tmp_name"])) {
        
        $ch = curl_init();
        
        $apiKey = "1e95965dd61333d0d4d75859a8a879df";
        $cfile = curl_file_create($_FILES["skin"]["tmp_name"], $_FILES["skin"]["type"]);
        $data = array(
            "key"=>$apiKey,
            "image" => $cfile
        );

        curl_setopt( $ch, CURLOPT_URL,"https://api.imgbb.com/1/upload");
        curl_setopt( $ch, CURLOPT_POST,1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: multipart/form-data'));
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER,1);

        $response = json_decode(curl_exec($ch));
        
        if ($response == false) {
            echo "cURL Error: " . curl_error($ch)."<br>";
            return;
        }
        $skinSrc = $response->data->display_url;
        curl_close($ch);

    } else if (isset($_POST["nickname"])){
        $skinSrc = mysqli_real_escape_string($connect, $_POST["nickname"]);
    }
    $tmpLogin = $_SESSION["login"];

    $rows = mysqli_query($connect, "SELECT * FROM `table_$tmpLogin`");
    $numrows = mysqli_num_rows($rows) + 1;
    mysqli_query($connect, "ALTER TABLE table_$tmpLogin AUTO_INCREMENT = $numrows;");

    if(mysqli_num_rows($rows) >= 18) {
        echo "Мы не поддерживаем больше 18 скинов, что ты за изверг который собирается хранить здесь столько скинов";
        die();
    }

    $request = "INSERT INTO `table_$tmpLogin` (`id`, `name`, `type`, `source`) VALUES (NULL, '$nameTable', '$typeSkin', '$skinSrc')";



    if(mysqli_query($connect, $request)) {
        echo "Данные добавлены в БД <br>";
        header("Location:/skinsPage/index2.php");
        
    } else {
        echo "Ошибка добавления данных: ".mysqli_error($connect)."<br>";
    }
    


} else {
    echo "Данные не переданы";
    die();
}



mysqli_close($connect);