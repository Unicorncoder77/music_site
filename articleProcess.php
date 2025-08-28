<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require __DIR__ . '/../hiphop_website/private/config.php';
require 'articleConn.php';

$newArticle = new Article();

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(!isset($_SESSION['user_id'])){
        exit("You're not logged into your creator account.");
    }

    $creator_id = $_SESSION['creator_id'];

    if(isset($_POST['articleTitle'])){
        $title = $_POST['articleTitle'];
    }
    if(isset($_POST['category'])){
        $category = $_POST['category'];
    }
    if(isset($_POST['articleContent'])){
        $content = $_POST['articleContent'];
    }

    if ($title && $content){
        $newArticle->submitArticle($creator_id, $title, $content, $category);
        echo "<script>alert('Article submitted successfully');</script>";
    }
    else {
        echo "<script>alert('Something went wrong :|');</script>";
    }
}