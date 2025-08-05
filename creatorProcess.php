<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();


require __DIR__ . '/../hiphop_website/private/config.php';
require 'creatorConn.php';

$penName = null;
$creatorAccount = new CreatorAccount();
//$_SESSION['user'] = $penName;
//$creator = $creatorAccount->getCreatorInfo($penName);


if (isset($_SESSION['creator']) && !empty($_SESSION['creator'])) {
    header("Location: creatorDashboard.php");
    exit();
}
else {
   if (isset($_POST['login'])) {
        $penName = $_POST['penNameLog'];
        $password = $_POST['pswLog'];
        if ($creatorAccount->verifyPassword($penName, $password)) {
                $_SESSION['creator'] = $penName;
                header("Location: creatorDashboard.php");
                exit();
        }
        else {
                print ("Error");
        }
      }

      else if(isset($_POST['signup'])) {
                $firstName = $_POST['firstName'];
                $lastName = $_POST['lastName'];
                $penName = $_POST['penNameSign'];
                $email = $_POST['emailSign'];
                $password = $_POST['pswSign'];
                if ($creatorAccount->createAccount($firstName, $lastName, $penName, $email, $password)) {
                    $_SESSION['creator'] = $penName;

                    header("Location: creatorDashboard.php");
                    exit();
                }
                else {
                    header("Location: loginPage.php?error=user_exists");
                }
            }
    }
      

?>