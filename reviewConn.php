<?php

// error handling
ini_set('display_erros', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// review class
class Review{
    // defining the db connection
    private $dbconn = NULL;

    public function __construct($config){
        require_once __DIR__ . '/../hiphop_website/private/config.php';

        $this->dbconn = new PDO(
            $config['db']['dsn'],
            $config['db']['user'],
            $config['db']['pass']
        );

        $this->dbconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    // deconstruction function 
    public function __destruct(){
        if(is_null($this->dbconn)) return;
        $this->dbconn = null;
        $this->dbconn = null; 
    }

    public function submitReview($review_title, $review_contents, $stars, $category_id, $user_id, $song_id){
        $stmt = $this->dbconn->prepare("INSERT INTO reviews(review_id, review_contents, user_id, pub_date,  category_id, stars, song_id))
        VALUES (:review_title, :review_contents, :user_id, NOW(), :category_id, :stars, :song_id");

        return $stmt->execute([
            ':review_title' => $review_title,
            ':review_contents' => $review_contents,
            ':user_id' => $user_id,
            ':category_id' => $category_id,
            ':stars' => $stars,
            ':song_id' => $song_id
        ]);
    }

    public function fetchCategories(){
        $stmt = $this->dbconn->query("SELECT category_id, category_name FROM categories ORDER BY category_name ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function fetchStars(){
        $stmt = $this->dbconn->query("SELECT review_title, review_content, stars FROM reviews");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function topRated(){
        $stmt = $this->dbconn->prepare("SELECT review_id, review_title, review_content, stars
        FROM reviews
        WHERE stars = 5
        LIMIT 5");

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function fetchAll(){
        $stmt = $this->dbconn->query("SELECT review_id, review_title, review_content, stars, categories.category_name
        FROM reviews
        JOIN categories ON reviews.category_id = categories.category_id");

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


}