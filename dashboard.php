<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

require __DIR__ . '/../hiphop_website/private/config.php';

require 'loginConn.php';
//require 'loginPage.php';
//require 'userLoginProcess.php';


if (!isset($_SESSION['user'])){
    header("Location: loginPage.php");
    exit();
}

$username = $_SESSION['user'];
$userAccounts = new UserAccount();
$user = $userAccounts->getUserInfo($username);
$userID = $user['user_id'];
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> <?php echo htmlspecialchars($_SESSION['user']);?>'s Page</title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    </head>
    <body>
        <header>
         <h1> The Experience </h1>
            <nav class="homeNav" id="navigation-bar">
                <a href="index.php">Home</a>
                <a href="#">About</a>
                <a href="articles.php">Articles</a>
                <a href="#">Reviews</a>
                <a href="#">Contact</a>
                <a href="logout.php">Logout</a>
                <a href="dashboard.php"> Dashboard </a>
                <!--<a href="#">Your Reviews</a>
                <a href="#">Your Saved Articles</a>-->
                <div class="search">
                    <form action="#">
                        <input type="text" placeholder="Search" name="search">
                        <button type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </form>
                </div>
                <div class="settings">
                    <button class="darkModeToggle" id="darkModeToggle" onclick="darkMode()">
                        <i class="fa fa-moon-o fa-2x" ></i>
                    </button>
                </div>
            </nav>
        </header>
                

            <h1 class="userWelcome"> Welcome Back <?php echo htmlspecialchars($_SESSION['user']); ?></h1>
            <hr>
            <h2> Here are some <b> HOT </b> new articles for you: </h2>
            <section class="articles">
                <div class="article-grid">
                   <div class="article-card">
                        <h3> From The Grammy's To Gag City </h3>
                        <p>
                                Nicki Minaj is often seen as a legend in her own right.
                                She kicked in the door that was unlocked for her to open by her predecessors.
                                Her creativity and flow within the scene was something new and exciting that many
                                could endorse and support.
                        </p>
                        <a href="#"> Read More </a>
                </div>
                <div class="article-card">
                    <h3> The Evolution of the 808 Beat </h3>
                </div>
             </div>
          </section>
    </body>
</html>