<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Article{
    private $dbconn = NULL;

    public function __construct(){
        require_once __DIR__ . '/../hiphop_website/private/config.php';
        global $config;
        $this->dbconn = new PDO($config['db']['dsn'],
        $config['db']['user'],
        $config['db']['pass']
        );
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
    public function submitArticle($creator_id, $article_title, $article_content, $article_category){
        $stmt = $this->dbconn->prepare("INSERT INTO articles (creator_id, title, content, category, creation_time) 
        VALUES (:creator_id, :article_title, :article_content, :article_category, NOW())");

        return $stmt->execute([
            ':creator_id' => $creator_id,
            ':title' => $article_title,
            ':content' => $article_content,
            ':category' => $article_category
        ]);
    }

    public function fetchAll(){
        // article.article_id ensures that its the correct table that it's being inserted into
        // can use it with or without if it works with the article.article_id thing then ill keep it

        $stmt = $this->dbconn->query("SELECT article.article_title, article.article_content, article.article_category
        FROM articles");

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // getting based on a creator
    public function getByCreator($creator_id){
        $stmt = $this->dbconn->prepare("SELECT article_id, title, content, category, creation_time
        FROM articles
        WHERE creator_id = :creator_id
        ORDER BY creation_time DESC");

        $stmt->execute([':creator_id' => $creator_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // may make it in ascending order perhaps
}

?>