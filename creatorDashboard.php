<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

require __DIR__ . '/../hiphop_website/private/config.php';

require 'creatorConn.php';
require 'articleConn.php';
//include 'header.php';

// Should merge creatorConn and loginConn at some point or figure out if it would be the best option


$penName = strtolower($_SESSION['creator']);
$creatorAccount = new CreatorAccount();

$creator = $creatorAccount->getCreatorInfo($penName);
$creatorID = $creator['creator_id'];

$_SESSION['creator_id'] = $creator['creator_id'];

$newArticle = new Article($config);
$categories = $newArticle->fetchCategories();


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
<!-- Add in the Javascript code to generate the nav bar automatically -->
    <body>
        <script src="script.js"> </script>
        <div id="header"></div>

        
        <h1 class="userWelcome"> Welcome Back <?php echo htmlspecialchars($_SESSION['creator']);?></h1>
        <hr>
<!-- Add dynamic route to adding the categories-->
        <h2> Submit your new article below: </h2>
        <div class="formCenter">
            <form action="articleProcess.php"class="newArticle" method="POST">
                <label for="articleTitle">Article Title Name: </label> 
                <input type="text" id="articleTitle" name="articleTitle"> <br/>
                <label for="articleCategory"> Choose your category: </label> <br />
                <select id="category" name="category">
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= htmlspecialchars($category['category_id']) ?>">
                            <?= htmlspecialchars($category['category_name']) ?>
                        </option>

                    <?php endforeach; ?>
                
                </select> <br>
        <!-- Add tinymce-->
                <label for="articleContent"> Content:</label> <br />
                <textarea name="articleContent"></textarea> <br />
                <input type="submit" name="contentSubmit" value="Submit">
            </form> 
        </div>
    </body>
</html> 
