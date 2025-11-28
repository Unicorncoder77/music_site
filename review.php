<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'reviewConn.php';
require 'loginConn.php';

require_once  __DIR__ . '/../hiphop_website/private/config.php';

try {
    $newReview = new Review($config);
    $newUser = new UserAccount();

}
catch (PDOException $e){
    echo "<pre>PDO Error: " . $e->getMessage() . "</pre>";
    exit;
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">    
        <title>
            Reviews
        </title>
         <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <script src="script.js"> </script>
        <div id="header"></div>
        <h1 class="reviewHeader">Welcome to the Review Section!</h1>
        <hr>
        <h2 class="reviewMid">Check out the best reviewed songs</h2>

        <div class="article-grid">
<!-- generate the process for this-->
        </div>
    </body>
</html>
