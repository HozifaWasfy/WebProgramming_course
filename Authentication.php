<?php
session_start();
require_once "functions.php";
// $ids = array_column($users,"id");
// foreach($ids as $id){
// }
// foreach($polls as $poll){
//     //$poll_str = "Expires in ". date_diff(time(),strtotime($poll["deadline"]));
//     print_r(date_diff(time(),strtotime($poll["deadline"])));
// }
if(isset($_POST["act"])){
    //print_r($_POST['act']);
    if (empty($_POST['uname']) || empty($_POST['pword'])){
        echo '<span style="color:red;text-align:center;"> fill in all the fields </span>';
        //redirect("Authentication.php");
        
    }else{
        if(check_user($_POST['uname'],$_POST['pword'])){
        print_r("logged in");
        $_SESSION['logged'] = true;
        $_SESSION['userid'] = $_POST["uname"];
        if ($_SESSION['userid'] == "admin"){

        }
        redirect('index.php');
    }else{
        echo '<span style="color:red;text-align:center;"> either username or password is wrong </span>';
    }}
}elseif(isset($_GET["act"])){
    //print_r($_GET['act']);
    if (empty($_GET['email']) || empty($_GET['uname']) || empty($_GET['pword']) || empty($_GET['pword1'])) {
        echo '<span style="color:red;text-align:center;"> Please fill in all the fields </span>';
    } else {
        if (!filter_var($_GET['email'], FILTER_VALIDATE_EMAIL)) {
            echo '<span style="color:red;text-align:center;">Invalid email format</span>';
        } else {
            if ($_GET['pword'] != $_GET['pword1']) {
                echo '<span style="color:red;text-align:center;">Passwords do not match</span>';
            } else {
                save_user($_GET['email'],$_GET['uname'],$_GET['pword']);
                redirect("Authentication.php");
            }
        }
    }
   // print_r("registered succefuly");
}else{


}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loggingin page</title>
    <link rel="stylesheet" href="style.css">
    <style>
        div {
            display: flex;
            flex-direction: column;
            align-items: center;
        
        }
        input[type="text"]{
            width: 200px;
        }
        input[type="password"]{
            width: 200px;
        }
        #reg-area{
            width: 50%;
            margin: 0 auto;
            background-color: #fff;
            padding: 2em;
            border-radius: 5px;
            box-shadow: 2px 2px 5px #ccc;
        }
        #login-area{
            width: 50%;
            margin: 0 auto;
            background-color: #fff;
            padding: 5em;
            border-radius: 5px;
            box-shadow: 2px 2px 5px #ccc;
        }
        html {
  --s: 50px;
  --c: #191b22;
  --_s: calc(2*var(--s)) calc(2*var(--s));
  --_g: 35.36% 35.36% at;
  --_c: #0000 66%,#20222a 68% 70%,#0000 72%;
  background: 
    radial-gradient(var(--_g) 100% 25%,var(--_c)) var(--s) var(--s)/var(--_s), 
    radial-gradient(var(--_g) 0 75%,var(--_c)) var(--s) var(--s)/var(--_s), 
    radial-gradient(var(--_g) 100% 25%,var(--_c)) 0 0/var(--_s), 
    radial-gradient(var(--_g) 0 75%,var(--_c)) 0 0/var(--_s), 
    repeating-conic-gradient(var(--c) 0 25%,#0000 0 50%) 0 0/var(--_s), 
    radial-gradient(var(--_c)) 0 calc(var(--s)/2)/var(--s) var(--s) var(--c);
  background-attachment: fixed;
}
    .error{
        color: red;
    }
    </style>
</head>
<body>
<form method="POST">
        <!-- <input type="hidden" name="origin" value="index.php"> -->
        <div id="login-area"> 

        UserName: <input name="uname" type="text" placeholder="Enter username" value="<?php echo isset($_POST['uname']) ? $_POST['uname'] : '' ?>">
        Password: <input name="pword" type="password"placeholder="Enter password" value="<?php echo isset($_POST['pword']) ? $_POST['pword'] : '' ?>">
            <input type="submit" name="act" www="login" value="Login" logged="yes">
        </div>
        <br>
    </form>
    <form method="GET">
    <div id="reg-area">
            <h4> Register if you do not have an account</h4>
        E-mail: <input name="email" type="text"placeholder="Enter email" value="<?php echo isset($_GET['email']) ? $_GET['email'] : '' ?>">
        UserName: <input name="uname" type="text"placeholder="Enter username" value="<?php echo isset($_GET['uname']) ? $_GET['uname'] : '' ?>">
        Password: <input name="pword" type="password"placeholder="Enter password" value="<?php echo isset($_GET['pword']) ? $_GET['pword'] : ''?>">
        Confirm Password: <input name="pword1" type="password"placeholder="confirm password" value="<?php echo isset($_GET['pword1']) ? $_GET['pword1'] : '' ?>">
        <input type="submit" name="act" www="reg" value="Register">
    </div>
    </form>
</body>
</html>