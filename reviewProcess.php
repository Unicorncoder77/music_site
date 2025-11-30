<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require __DIR__ . '/../hiphop_website/private/config.php';
require 'reviewConn.php';
require 'loginConn.php';

if(!isset($_SESSION['user_id'])){
    exit("You're not logged into your creator account.");
}

$newReview = new Review($config);

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['reviewTitle'])){
        $title = $_POST['reviewTitle'];
    }
}

?>
