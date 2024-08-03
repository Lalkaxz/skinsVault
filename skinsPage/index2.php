<?php 
    ini_set("session.cookie_lifetime", 604800);
    session_start();
    

    include "../php/database.php";
    $tmpLogin;
    $tmppass;
    $tmpmail;

    if(isset($_SESSION["login"]) && isset($_SESSION["password"]) && isset($_SESSION["mail"])) {
        $tmpLogin = $_SESSION["login"];
        $tmppass = $_SESSION["password"];
        $tmpmail = $_SESSION["mail"];
        $tmpQuery = mysqli_query($conn, "SELECT * FROM `usersdb` WHERE `name` = '$tmpLogin' AND `password` = '$tmppass' ");
        if(mysqli_num_rows($tmpQuery) == 0) {
            header("Location:/mainPage/index.php");
            die();
        }
    } else {
        header("Location:/mainPage/index.php");
        die();
    }
    mysqli_close($conn);
    
    $request = "SELECT * FROM `table_$tmpLogin`";
    $reqNums = "SELECT * FROM `table_$tmpLogin`";
    
    $numsRes = mysqli_query($connect, $reqNums);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cabinet</title>
    <link rel="stylesheet" href="/skinsPage/style2.css" type="text/css">
    <link rel="stylesheet" href="/skinsPage/delSkinPopUp.css" type="text/css">
    <link rel="stylesheet" href="/skinsPage/profilePopUp.css" type="text/css">
</head>
<body>
  
    

<ul class="navigation">
<li><a href="#" class="active">Skins</a></li>
<li><a href="#" id="delSkinButton">RemoveSkin</a></li>
<li><a href="#" id="addSkinButton" style="background-color:rgb(30, 189, 136);">Add new skin</a></li>
<li class="dropdown"><a href="#" class="dropBtn"><?echo $_SESSION['login']?><img src="/other/icon-down.png" class="userIcon"></a>
        <div class="dropdown-content">
            <a href="#" id="ProfileButton">Profile <img src="/other/user_icon.png" class="userIcon"></a>
            <a href="/php/logout.php" class="logout">Log Out <img src="/other/log-out.png" class="logoutIcon"></a>
        </div>
    </li>
<?php 
    if(isset($_COOKIE["token"])) {
        if($_COOKIE["token"] != "null") {
            echo "<li style='float:right;'><a href='#'>Token entered!</a></li>";
    }
}
?>    

</ul>

<?php
    if(mysqli_num_rows($numsRes) > 0) {
    echo "<div class='divSkinTable'>";
    
?>


        <?php 
        $result = mysqli_query($connect, $request);
        while ($row = mysqli_fetch_array($result)) 
        {  
            if($row["id"] <= 9) {
            ?>
        
        <div class="item">
        <div class="NameItem"><? echo $row["name"]; ?></div>
        <hr class="hrSkin">
        <div class="divSkinImg"><div class="num"><? echo $row["id"]; ?></div>
        <?php 
            $srcType;
            if(str_starts_with($row["source"], "https://") || str_starts_with($row["source"], "http://")) {
                $srcType = true;
            } else {
                $srcType = false;
            }
        ?>

        <img alt="skin preview" class="skinImg" src=<? 
        if($srcType == true) {
            $sourceUrl = "https://starlightskins.lunareclipse.studio/render/ultimate/none/full?skinType=".$row["type"]."&skinUrl=".$row["source"];
            echo $sourceUrl;
        } else if ($srcType == false) {
            $sourceUrl = "https://starlightskins.lunareclipse.studio/render/ultimate/".$row["source"]."/full?skinType=".$row["type"];
            echo $sourceUrl;
        }
        ?> >

        </div>
        <hr class="hrSkin">
        <div class="InteractBtns">
        <?php 
            $linkByName = "https://mineskin.eu/skin/".$row["source"];
        ?>
        <button class="skinButtons copyUrl" data-title="click for copy url" onclick="copyUrl('<? echo $srcType ? $row['source'] : $linkByName ?>')" ><img class="InteractIcons" src="/other/link.png"></button>
        <? $tmpfname = str_replace(chr(39), "", str_replace(chr(34), "", $row['name'])) ?>
        <button class="skinButtons" data-title="click for download file" onclick="downUrl('<? echo $srcType ? $row['source'] : $linkByName ?>', '<?echo $tmpfname ?>')"><img  class="InteractIcons" src="/other/download_icon.png"></button>
        <button class="skinButtons" href="#" data-title='change skin on FrogDream' onclick="changeSkin('<? echo $srcType ? $row['source'] : $linkByName ?>')"> <img class='InteractIcons' src="/other/api.png"> </button>
        <button class="skinButtons" href="#" data-title="copy minecraft command" onclick="copyUrl('<? echo $srcType ? '/skin url '.$row['source'] : '/skin set '.$row['source'] ?>')"><img src="/other/code.png" class="InteractIcons"></button>

        </div>
        </div>
            <?php } ?>

       <?php } ?>
<?php
    echo "</div>";
    }
        ?>

<?php 
    if(mysqli_num_rows($numsRes) > 9) {
        echo "<div class='divSkinTable'>";
?>


<?php 
        $result = mysqli_query($connect, $request);
        while ($row = mysqli_fetch_array($result)) 
        {  
            if($row["id"] > 9 && $row["id"] <= 18) {
            ?>
        
        <div class="item">
        <div class="NameItem"><? echo $row["name"]; ?></div>
        <hr class="hrSkin">
        <div class="divSkinImg"><div class="num"><? echo $row["id"]; ?></div>
        <?php 
            $srcType;
            if(str_starts_with($row["source"], "https://") || str_starts_with($row["source"], "http://")) {
                $srcType = true;
            } else {
                $srcType = false;
            }
        ?>

        <img alt="skin preview" class="skinImg" src=<? 
        if($srcType == true) {
            $sourceUrl = "https://starlightskins.lunareclipse.studio/render/ultimate/none/full?skinType=".$row["type"]."&skinUrl=".$row["source"];
            echo $sourceUrl;
        } else if ($srcType == false) {
            $sourceUrl = "https://starlightskins.lunareclipse.studio/render/ultimate/".$row["source"]."/full?skinType=".$row["type"];
            echo $sourceUrl;
        }
        ?> >

        </div>
        <hr class="hrSkin">
        <div class="InteractBtns">
        <?php 
            $linkByName = "https://mineskin.eu/skin/".$row["source"];
        ?>
        <button class="skinButtons copyUrl" data-title="click for copy url" onclick="copyUrl('<? echo $srcType ? $row['source'] : $linkByName ?>')" ><img class="InteractIcons" src="/other/link.png"></button>
        <? $tmpfname = str_replace(chr(39), "", str_replace(chr(34), "", $row['name'])) ?>
        <button class="skinButtons" data-title="click for download file" onclick="downUrl('<? echo $srcType ? $row['source'] : $linkByName ?>', '<? echo $tmpfname ?>')"><img  class="InteractIcons" src="/other/download_icon.png"></button>
        <button class="skinButtons" href="#" data-title="change skin on FrogDream" onclick="changeSkin('<? echo $srcType ? $row['source'] : $linkByName ?>')"><img class="InteractIcons" src="/other/api.png"></button>
        <button class="skinButtons" href="#" data-title="copy minecraft command" onclick="copyUrl('<? echo $srcType ? '/skin url '.$row['source'] : '/skin set '.$row['source'] ?>')"><img src="/other/code.png" class="InteractIcons"></button>

        </div>
        </div>
            <?php } ?>

       <?php } ?>



<?php 
        echo "</div>";
    }
?>



    <div class="container">
        <div id="popUpContainer">
            <button class="close">✖</button>
            <h1 id="h1title">Add new skin</h1>
            <br>
            
        <form action="/php/skinPost.php" method="post" id="formAddSkin" enctype="multipart/form-data">
            <label for="nameSkin">Write name for table:</label>
            
            <input type="text" name="name" class="popUpInputs" id="nameSkin" placeholder="Table name" addSkinInputs>
            <h2>Select form</h2>
            <div class="divSelectForm">
            
                <div class="choiceForm" id="choiceSteve"><img src="/other/skins-classic.png" alt="steve"><input type="radio" name="selectForm" class="radioChoiceForm" id="radioSteve" addSkinInputs value="Classic"> Classic</div>
            
                <div class="choiceForm" id="choiceAlex"><img src="/other/skins-slim.png" alt="alex"> <input type="radio" name="selectForm" class="radioChoiceForm" id="radioAlex" addSkinInputs value="slim"> Slim</div>
                </div>
            
                <hr class="hrPopUp">
            <h2>Choose ur Skin or NickName</h2>
            
                <div id="uploadSkin">  
                    
                    <label class="input-file"><input type="file" name="skin" id="inputSkin" multiple accept="image/*" addSkinInputs><span>Upload skin</span>
                    </label>
                    <div id="divShowImg"><img id="showImg"><div class="clearFile">✖</div></div>

                </div>
            <div id="divOR">OR</div>
            <div id="WriteNickName"><input type="text" name="nickname" id="inputNick" placeholder="skin nickname" class="popUpInputs" addSkinInputs></div>
            <button type="submit" id="submitAddSkin">Add Skin!</button>
        </form>


        </div>
    </div>
    
    <div class="delSkinContainer">
        <div class="delSkinContent">
            <button type="button" class="delSkinClose">✖</button>

            <form action="/php/skinRemove.php" method="post" id="formDelSkin">
            <h1 id="h1DelSkin">Remove Ur skin</h1>
            <input type="number" name="numDeletedSkin" class="delSkinInputs" id="inputID" placeholder="write number of skin" min="1" max="<?echo mysqli_num_rows($numsRes);?>">
            <button type="submit" id="submitDelSkin">Submit</button>
            </form>
        </div>
    </div>

<div class="profileContainer">
    <div class="profileContent">

        <button type="button" class="profileClose">✖</button>

        <div class="divProfileTable">
            <div class="divIconProfile">
                <img src="/other/user.png" class="profileIcon">
            </div>
            <div class="divNameProfile">
                <h1 id="h1ProfileName"> <?echo $tmpLogin;?></h1>
                <h2 id="h2ProfileMail">Email:<?echo $tmpmail;?></h2>
        </div>
        </div>
        <h1>FrogDream API</h1>
        <form action="/php/ApiToken.php" method="post" id="formApi">
            <input type="text" class="inputApi" id="inputToken" name="Ftoken" placeholder="write ur FrogDream token">
            <button type="submit" class="submitApi">Submit</button>
        </form>
    </div>  
</div>

</body>
<script src="/js/apiHandler.js"></script>
<script src="/js/profileHandler.js"></script>
<script src="/js/skinRemover.js"></script>
<script src="/js/cboard.js"></script>
<script src="/js/skinsHandler.js"></script>
<script src="/js/skinPoster.js"></script>
</html>