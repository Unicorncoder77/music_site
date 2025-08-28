<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'articleConn.php';
require 'creatorConn.php';

$article = new Article();
$newCreator = new CreatorAccount();
//$authorId = $article->getByCreator($article['creator_id']);

$allArticles = $article->fetchall();

/*foreach ($allArticles as $article) {
    $creator = $newCreator->getCreator($article['creator_id']);
}*/
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Articles </title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
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
        <h1> Welcome to Our Article Site! Read Our Various Articles Below!</h1>
        <?php 
            foreach ($articles as $article):
                $creator = $newCreator->getCreator($article['creator_id']);
        ?>
        <article>
            <h2> <?= htmlspecialchars($article['title']) ?></h2>

            <p>by <?= htmlspecialchars($creator['creator_penname'])?></p>
            <p><?= nl2br(htmlspecialchars($article['content']))?></p>
        </article>

        <?php endforeach ?>
    </body>
</html>