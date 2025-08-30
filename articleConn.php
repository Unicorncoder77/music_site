<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Article{
    private $dbconn = NULL;

    public function __construct($config) {
        require_once __DIR__ . '/../hiphop_website/private/config.php';
       // global $config;

        $this->dbconn = new PDO(
            $config['db']['dsn'],
            $config['db']['user'],
            $config['db']['pass']
        );

        $this->dbconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    }
     public function __destruct(){
        if(is_null($this->dbconn)) return;
        $this->dbconn = null;
        $this->dbconn = null;
    }

    // not implemented yet 
    // what is needed? creator_id, article_title, article_content, article_category
    // grab the creator_id from the given session going on 
    // insert into the database 
    // somehow get the publication date to insert into this as well
    // article id isn't needed because it's dynamically added (like the other ones)
    public function submitArticle($creator_id, $article_title, $article_contents, $category_id){
        $stmt = $this->dbconn->prepare("INSERT INTO articles (creator_id, article_title, article_contents, category_id, pub_date) 
        VALUES (:creator_id, :article_title, :article_contents, :category_id, NOW())");

        return $stmt->execute([
            ':creator_id' => $creator_id,
            ':article_title' => $article_title,
            ':article_contents' => $article_contents,
            ':category_id' => $category_id
        ]);
    }

    public function fetchAll(){
        // article.article_id ensures that its the correct table that it's being inserted into
        // can use it with or without if it works with the article.article_id thing then ill keep it

        $stmt = $this->dbconn->query("SELECT article_id, creator_id, article_title, article_contents, categories.category_name
        FROM articles
        JOIN categories ON articles.category_id = categories.category_id");

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // getting based on a creator
    public function getByCreator($creator_id){
        $stmt = $this->dbconn->prepare("SELECT article_id, article_title, article_contents, category_id, pub_date
        FROM articles
        WHERE creator_id = :creator_id
        ORDER BY creation_time DESC");

        $stmt->execute([':creator_id' => $creator_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function fetchCategories() {
        $stmt = $this->dbconn->query("SELECT category_id, category_name FROM categories ORDER BY category_name ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // may make it in ascending order perhaps
}


?>