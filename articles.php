<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'articleConn.php';
require 'creatorConn.php';

require_once  __DIR__ . '/../hiphop_website/private/config.php';

try {
    $newArticle = new Article($config);
    $newCreator = new CreatorAccount();

    $allArticles = $newArticle->fetchall();

}
catch (PDOException $e) {
    echo "<pre>PDO Error: " . $e->getMessage() . "</pre>";
    exit;
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Articles </title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style>
            article {
                width: 80%;
                margin-left: auto;
                margin-right: auto;
                text-align: center;
            }
        </style>
    </head>
    <body>
        <script src="script.js"> </script>
        <div id="header"></div>
         
        

        
        <h1> Welcome to Our Article Site! Read Our Various Articles Below!</h1>
        <div class="article-grid">
        <?php 
            foreach ($allArticles as $article):
                $creator = $newCreator->getCreator($article['creator_id']);

                if (!$creator) {
                    $penName = "Unknown Author";
                } 
                else {
                    $penName = $creator['creator_penname'];
                }
        ?>
        <div class="article-card">

        
        <article>
           <h3>
                    <a href="oneArticle.php?id=<?= $article['article_id'] ?>">
                        <?= htmlspecialchars($article['article_title']) ?>
                    </a>
                </h3>
                <p> 
                    <?= nl2br(htmlspecialchars(substr($topArticles['article_contents'], 0, 150)))?>
                </p>
        </article>
        </div>

        <?php endforeach ?>
        </div>
    </body>
</html>