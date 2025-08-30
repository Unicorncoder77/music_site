<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require __DIR__ . '/../hiphop_website/private/config.php';
require 'articleConn.php';
require 'creatorConn.php';

if(!isset($_SESSION['creator_id'])){
    exit("You're not logged into your creator account.");
}

$newArticle = new Article($config);

$creator_id = $_SESSION['creator_id'];



if($_SERVER['REQUEST_METHOD'] === 'POST'){
     //$creator_id = $_SESSION['creator_id'];
   
    if(isset($_POST['articleTitle'])){
        $title = $_POST['articleTitle'];
    }
    if(isset($_POST['category'])){
        $category = $_POST['category'];
    }
    if(isset($_POST['articleContent'])){
        $content = $_POST['articleContent'];
    }

    if ($title && $content && $category){
        $newArticle->submitArticle($creator_id, $title, $content, $category);
        echo "<script>alert('Article submitted successfully');</script>";
        header("Location: creatorDashboard.php");
        exit();
    }
    else {
        echo "<script>alert('Something went wrong :|');</script>";
        header("Location: creatorDashboard.php");
        exit();
    }
}