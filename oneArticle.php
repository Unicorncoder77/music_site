<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'articleConn.php';
require 'creatorConn.php';

require_once  __DIR__ . '/../hiphop_website/private/config.php';

$article = new Article($config);


if (!isset($_GET['id'])){
    die ("No Article Selected :(");
}

$article_id = (int) $_GET['id'];
$singleArticle = $article->getByArticleId($article_id);

if (!$singleArticle){
    die("Article not found :(");
}


?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Article </title>
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
        <div class="article-grid">
        <div class="article-card">
        <article>
            <h1><?= htmlspecialchars($singleArticle['article_title']) ?> </h1>
            <p><?= nl2br(htmlspecialchars($singleArticle['article_contents']))?></p>
        </article>
        </div>
        </div>

    </body>
</html>