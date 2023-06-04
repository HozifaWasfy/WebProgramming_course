<?php
require_once 'functions.php';
session_start();

if (isset($_POST['submit'])) {
    // $email = validate_inputs($_POST["email"]);
    // $username = validate_inputs($_POST["username"]);
    // $password = validate_inputs($_POST["password"]);
    // $confirm_password = validate_inputs($_POST["confirm_password"]);

    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];


    //check if inputs are empty
    if (empty($email) || empty($username) || empty($password) || empty($confirm_password)) {
        echo "Please fill in all the fields";
    } else {
        //check if email is valid
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Invalid email format";
        } else {
            //check if password and confirm password match
            if ($password != $confirm_password) {
                echo "Passwords do not match";
            } else {
                //save the user to the database
                add_a_user($username, $password, $email);
                //redirect to login page
                header("Location: login.php");
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Registration Page</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Welcome to our website</h1>
    <form method="post">
        <h2>Registration</h2>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" placeholder="Enter your email">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" placeholder="Enter your username">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" placeholder="Enter your password">
        <label for="confirm_password">Confirm Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm your password">
        <input type="submit" name="submit" value="Register">
    </form>
</body>

</html>
