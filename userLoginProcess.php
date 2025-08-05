<?php
/*if (!defined('theExperienceWebApp')) exit();*/
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require __DIR__ . '/../hiphop_website/private/config.php';
require 'loginConn.php';

$userAccounts = new UserAccount();
$_SESSION['user'] = $username;

if(isset($_SESSION['user'])){
    header("Location: dashboard.php");
    exit();

}
else {
    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        if($userAccounts->verifyPassword($username, $password)){
            $_SESSION['user'] = $username;

//            print("Login complete!");
            header("Location: dashboard.php");
            exit();

        }
        else {

            print("Error");
        }
    }
    else if(isset($_POST['signup'])){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $passwd = $_POST['newPass'];
        if ($userAccounts->createAccount($username, $email, $passwd)){
            $_SESSION['user'] = $username;

//            print("Registration Complete!");
            header("Location: dashboard.php");
            exit();

        }
        else {
            header("Location: loginPage.php?error=user_exists");
            exit();

        }
    }
}

?>