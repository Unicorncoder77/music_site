<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'articleConn.php';
require 'creatorConn.php';

require_once  __DIR__ . '/../hiphop_website/private/config.php';


session_start();

try {
    $newArticle = new Article($config);
    $newCreator = new CreatorAccount();

    

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
        <title> The Experience Home </title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

   </head>
    <body>
        <script src="script.js"> </script>
        <div id="header"></div>

<!-- If I still like the vine idea, add vines here-->

    <section class="mission">
        <h2> Are you Experienced? - Jimi Hendrix</h2>
        <p> Do you wish to have access to a site where you can read reviews on different songs?
            Well, welcome to The Experience! The Experience is a site that allows those to create, read,
            or learn something new about your favorite music!
        </p>
    </section>

    <section class="articles">
        <h2> Our Featured Articles</h2>
        <div class="article-grid">
          
            <?php 
                $topArticles = $newArticle->topThree();
                foreach ($topArticles as $article): 
            ?>
                <div class="article-card">
                <h3>
                    <a href="oneArticle.php?id=<?= $article['article_id'] ?>">
                        <?= htmlspecialchars($article['article_title']) ?>
                    </a>
                </h3>
                <p> 
                    <?= nl2br(htmlspecialchars(substr($topArticles['article_contents'], 0, 150)))?>
                </p>
                </div>
            <?php endforeach ?>
                </div>
                <div class="article-card">
                <h3> The Evolution of the 808 Beat</h3>
                <p>
                    It is a beat nearly as old as hip-hop itself.
                    The 808 beat is a beat that is as classic as the songs that they are tied to.
                    The 808 has been transformed into something that many different genres use to convey a specific sound but it has stayed overall synonymous with Hip-Hop.
                </p>
                <a href="#"> Read More </a>
            </div>
            <div class="article-card">
                <h3> Cuco: LA’s trippy Latin lover</h3>
                <p>


                </p>
                <a href="#"> Read More </a>
            </div>
        </div>
    </section>

<!-- Add a want to create button?-->
        <section class="creator">
                <h2> Want to Create? </h2>
                <a href="creatorLoginPage.php"><button>Click Here!</button></a>
        </section>
    <!-- May add this part back if it looks odd
    <section class="about">
        <h2> About Us</h2>

    </section> -->

    <footer>
        <p>&copy; The Experience. All rights reserved :p</p>
    </footer>
    <script>

        const articleCard = document.querySelector('.article-card-read')
        const btn = document.querySelector('.readMore')

        btn.addEventListener('click', () => {
            articleCard.classList.toggle('toggle')
        })
        function darkModeToggle () {
                var body = document.body;
                body.classList.toggle("darkMode");
        }


    </script>
    </body>
</html>