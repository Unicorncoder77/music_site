<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class CreatorAccount {
    private $dbconn = NULL;
    public function __construct() {
        require_once __DIR__ . '/../hiphop_website/private/config.php';
        global $config;
        $this->dbconn = new PDO($config['db']['dsn'],
        $config['db']['user'],
        $config['db']['pass']);

        $this->dbconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    public function __destruct(){
        if(is_null($this->dbconn)) return;
        $this->dbconn = null;
        $this->dbconn = null;
    }
    public function getCreatorInfo($penName){
       // $penName = strtolower($penName);
        $query = 'SELECT * FROM creators WHERE LOWER(creator_penname) = :penName';
        $stmt = $this->dbconn->prepare($query);
        $stmt->bindValue(':penName', $penName);

        if (!$stmt->execute()){
            return false;
        }
        $entry = $stmt->fetch(PDO::FETCH_ASSOC);
        if($entry){
            return [
                'creator_id' => $entry['creator_id'],
                'creator_first' => $entry['creator_first'],
                'creator_last' => $entry['creator_last'],
                'creator_email' => $entry['creator_email'],
                'creator_penname' => $entry['creator_penname']
            ];
        }

        else {
            return false;
        }
        $this->dbconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    public function createAccount($firstName, $lastName, $penName, $email, $password){
        $creator = $this->getCreatorInfo($penName);
        $penName = strtolower($penName);

        if ($creator)
            return false;

        
        $hashed = password_hash($password, PASSWORD_DEFAULT);

        $query = 'INSERT INTO creators (creator_first, creator_last, creator_email, creator_penname)
        VALUES (:firstName, :lastName, :email, :penName)';
        $stmt = $this->dbconn->prepare($query);
        $stmt->bindValue(':firstName', $firstName);
        $stmt->bindValue(':lastName', $lastName);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':penName', $penName);

        $result = $stmt->execute();
        if(!$result){
            error_log("Failed to insert into creators");
            return false;
        }

        $creator = $this->getCreatorInfo($penName);
        $id = $creator['creator_id'];
        $query2 = 'INSERT INTO creatorPasswords (creator_id, creator_password) VALUES (:creator_id, :password)';
        $stmt2 = $this->dbconn->prepare($query2);
        $createResult = $stmt2->execute([
            ':creator_id' => $id,
            ':password' => $hashed
        ]);
        if(!$createResult){
            error_log("Failed to insert password");
            return false;
        }

        return true; 
    }

    public function removeCreator($penName){
        $creator = $this->getCreatorInfo($penName);

        if(!$creator){
            return false;
        }

        $id = $creator['creator_id'];
        $query1 = sprintf('DELETE FROM creators WHERE creator_id = %d', $id);
        $query2 = sprintf('DELETE FROM creatorPasswords WHERE creator_id = %d' , $id);

        $result1 = $this->dbconn->query($query1);
        $result2 = $this->dbconn->query($query2);

        return true;
    }
    public function verifyPassword($penName, $password){
        $penName = strtolower($penName);
        $creator = $this->getCreatorInfo($penName);

        if(!$creator)
            return false;

        $id = $creator['creator_id'];
        $query = sprintf('SELECT creator_password FROM creatorPasswords WHERE creator_id = %d', $id);
        $result = $this->dbconn->query($query);
        
        $entry = $result->fetch(PDO::FETCH_ASSOC);

        if(!$entry || empty($entry['creator_password']) || !is_string($entry['creator_password'])){
            return false;
        }

        return password_verify($password, $entry['creator_password']);
        
    }

    public function getCreator($creator_id){
        $stmt = $this->dbconn->prepare("SELECT creator_penname
        FROM creators
        WHERE creator_id = :creator_id");

        $stmt->execute([':creator_id' => $creator_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function creatorLogin(){
        session_start();

        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $penName = strtolower($_POST['penName']);
            $password = $_POST['password'];

            $creator = $this->getCreatorInfo($penName);
            if ($creator && $this->verifyPassword($penName, $password)) {
                $_SESSION['creator_id'] = $creator['creator_id'];
                $_SESSION['creator'] = $creator['creator_penname'];

                header("Location: creatorDashboard.php");
                exit();
            }
            else {
                echo "Invalid";
            }
        }
    }


}

?>