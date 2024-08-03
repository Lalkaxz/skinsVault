<?php 
    include "../php/database.php";
    
    ini_set("session.cookie_lifetime", 604800);
    session_start();
    
    if(isset($_SESSION["login"]) && isset($_SESSION["password"]) && isset($_SESSION["mail"])) {
        $tmpLogin = $_SESSION["login"];
        $tmppass = $_SESSION["password"];
        
        $tmpQuery = mysqli_query($conn, "SELECT * FROM `usersdb` WHERE `name` = '$tmpLogin' AND `password` = '$tmppass' ");
        if(mysqli_num_rows($tmpQuery) != 0) {
            header("Location:/skinsPage/index2.php");
            die();
        }
        mysqli_close($conn);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/mainPage/style.css">
    <title>khs</title>
</head>
<body>

<div id="mainDiv">
    
    <div class="SignUp">
        <h1>Sign up here</h1>
        <form action="/php/register.php" method="post" id="signUpForm">

            <label for="inputname" class="labels">UserName</label>
            <input type="text" class="first-two-inputs" name="username" id="inputname" placeholder="UserName" signUpInput >
            
            <p id="NameErr">Измените или Заполните это поле!</p>

            <label for="inputemail" class="labels">Email</label>
            <input type="email" class="first-two-inputs" name="email" id="inputemail" placeholder="E-mail" signUpInput >
            
            <p id="mailErr">Измените или Заполните это поле!</p>
            
            <label for="inputpass" class="labels">Password</label>
           
            <input type="password" class="passwordInputs" name="password" id="inputpass" placeholder="Password" signUpInput >
            
            <p id="PassErr">Измените или Заполните это поле!</p>
            
            <input type="password" class="passwordInputs" name="repeatpassword" id="repeatpass" placeholder="Repeat ur password" signUpInput disabled>
            
            <p id="repeatPassErr">Пароли не совпадают!</p>
    
            
        
        <hr>
            <button type="submit" id="submitButton">Sign up</button>
        </form>
        <nav>Already have account? <a id="LoginAccount" href="#">Login</a></nav>
    </div>
    
    <div class="LogIn">
        <h1>Log in here</h1>
        <form action="/php/login.php" method="post" id="loginForm">
            <label class="labels" for="loginname">Username</label>
            
            <input type="text" name="Lusername" id="loginname" placeholder="UserName" LoginInput >
            
            <p id="LoginErrValidName">Измените или Заполните это поле!</p>

            <label class="labels" for="loginpass">Password</label>
            
            <input type="password" name="Lpassword" id="loginpass" placeholder="Password" LoginInput >
            
            <p id="LoginErrValidPass">Измените или Заполните Это Поле</p>

            <hr>
            <button id="LsubmitButton" type="submit">Log In</button>
            <nav>Dont have account? <a id="SignUpAccount" href="#">Sign Up</a></nav>
        </form>

    </div>

</div>

</body>
<script src="/js/main.js"></script>
<script src="/js/loginValidation.js"></script>
<script src="/js/signUpValidation.js"></script>
</html>