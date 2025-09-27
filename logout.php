<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

require __DIR__ . '/../hiphop_website/private/config.php';

require 'loginConn.php';
$username = $_SESSION['user'];
$userAccounts = new UserAccount();
$user = $userAccounts->getUserInfo($username);
$userID = $user['user_id'];



if (isset($_POST['logout'])) {

        session_start();
        session_destroy();
        header("location: loginPage.php");
        exit();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title> Logout </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <script src="script.js"> </script>
        <div id="header"></div>

        
        <h1 class="userWelcome"> Are you sure you wish to log out? </h1>
        <section class="logout">
                <form method="post">
                        <input type="submit" name="logout" value="Log Out">
                </form>
        </section>
    </body>
</html>