<?php
session_start();
require_once "functions.php";
//require_once "createpoll.php";
$polls_json = fopen("polls.json", "r");
$pols = (array)(json_decode(fread($polls_json,filesize("polls.json"))));

//var_dump($pols);
usort($pols, function ($a, $b) {
    if (empty($a->createdAt)) $a->createdAt = time();
    if (empty($b->createdAt)) $b->createdAt = time();
    // Compare the creation time of each poll
    return strtotime($b->createdAt) - strtotime($a->createdAt);
});

// $active = get_ongoing_polls($pols);
// $expired = get_expired_polls($pols);
//fclose($polls_json);

$arr = ["aa","bb","cc","dd"];
$arr_files0 = ["aa.php","bb.php","cc.php"];
$arr_files = "aa.php";
// print_r($_POST);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <style>
        <?php
            if(!isset($_SESSION['logged'])){
                echo "#vote {pointer-events: none;}";
            }
        ?>
        #vote{
            width: 75px;
            height: 55px;
            margin: 0px;
            

        }
        
    </style>
    
    <title>Main</title>
</head>
<body>

    <!-- <?php print_r($pols["poll1"])?> -->
    <h1 data-text='Poll System'></h1>
   <!-- <?php
    foreach($pols as $pol){
        // var_dump(strtotime($pol->deadline)<time());
            if(strtotime($pol->deadline)<time()){
                echo $pol->id;
            }
        }?> -->
    <?php
        if(isset($_SESSION['logged'])){
            echo "<h3>Hello  ". $_SESSION['userid']."</h3>";
        } 
    ?>
    <table>
        <thead>
            <tr>
                <td>Open Polls</td>
                <td>Created on</td>
                <td>Ends on</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </thead>
        
        <tbody>

        <?php 
        foreach($pols as $pol){
            if(strtotime($pol->deadline)>time()){

            show_poll($pol);}

        }
        ?>
        </tbody>
    </table>
    <br>
    <table>
        <thead>
            <tr>
                <td>Expired Polls</td>
                <td>Created on</td>
                <td>Ended on</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </thead>
        
        <tbody>

        <?php 
        foreach($pols as $pol){
            if(strtotime($pol->deadline)<time()){

            show_ex_poll($pol);}
        }
        ?>
        </tbody>
    </table>
    <br>
    <form action="Authentication.php">
        <!-- <input type="hidden" name="origin" value="index.php"> -->
        <!-- UserName: <input name="uname">
        Password: <input name="pword" type="password"> -->
            <div id="btns">
            <?php
                if(isset($_SESSION['logged'])){
                    echo '<a href="logout.php">Logout</a>';
                } 
            ?>
            <input type="submit" value="Login">
            
            <!-- <h4> Register if you do not have an account</h4>
            <input type="submit" name="act" www="reg" value="Register"> -->
        </div>
    </form>
    <?php
    if(isset($_SESSION['userid']) && $_SESSION["userid"]=="admin"){
        echo '<form action="createpoll.php">';
        echo'<input type="submit" value="create Poll">';
        echo '</form>';
    }?>
        

    <h6>By: Hozifa Wasfy  <br> <span>IX54ET</span></h6>
</body>

</html>

