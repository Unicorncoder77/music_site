<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

require __DIR__ . '/../hiphop_website/private/config.php';

require 'creatorConn.php';

// Should merge creatorConn and loginConn at some point or figure out if it would be the best option

$penName = $_SESSION['creator'];
$creatorAccount = new CreatorAccount();

$creator = $creatorAccount->getCreatorInfo($penName);
$creatorID = $creator['creator_id'];


?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> <?php echo htmlspecialchars($_SESSION['creator']);?>'s Page</title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style>
            h2{
                text-align: center;
            }

            .formCenter {
                padding: 30px;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            textarea {
                width: 100%;
                height: 150px;
                padding: 12px 20px;
                box-sizing: border-box;
                font-size: 16px;
                resize: none;
            }

            select {
                width: 100%;
                padding: 16px 20px;
                border: none;
            }

            input [type="submit"]{
                background-color: #588157;
                color: white;
                padding: 14px 20px;
                margin: 8px 0;
                border: none;
                cursor: pointer;
                width: 100%;
                opacity: 0.9;
            }
        </style>
    </head>
 Add in the Javascript code to generate the nav bar automatically
    <body>
        <header>
         <h1> The Experience </h1>
            <nav class="homeNav" id="navigation-bar">
                <a href="index.php">Home</a>
                <a href="#">About</a>
                <a href="#">Articles</a>
                <a href="#">Reviews</a>
                <a href="#">Contact</a>
                <a href="logout.php">Logout</a>
                <a href="dashboard.php"> Dashboard </a>
 your articles page
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
       
        <h1 class="userWelcome"> Welcome Back <?php echo htmlspecialchars($_SESSION['creator']);?></h1>
        <hr>
<!-- Add dynamic route to adding the categories-->
        <h2> If you're submitting a new article then submit below: </h2>
        <div class="formCenter">
            <form action="#"class="newArticle">
                <label for="articleTitle">Article Title Name: </label> 
                <input type="text" id="articleTitle" name="articleTitle"> <br/>
                <label for="articleCategory"> Choose your category: </label> <br />
                <select id="category" name="category">
                    <option value="1">Hip-Hop</option> 
                    <option value="2">Pop</option> 
                    <option value="3">Rock</option>
                    <option value="4">Alternative</option>
                    <option value="5">Spanish</option>
                    <option value="6">K-pop</option>
                </select> <br>

                <label for="articleContent"> Content:</label> <br />
                <textarea name="articleContent"></textarea> <br />
                <input type="submit" name="contentSubmit" value="Submit">
            </form> 
        </div>
    </body>
</html> 
