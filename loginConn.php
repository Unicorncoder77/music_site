<?php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


class UserAccount {
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

    public function getUserInfo($username){
        $query = 'SELECT * FROM users WHERE username = :username';
        $stmt = $this->dbconn->prepare(($query));
        $stmt->bindValue(':username', $username);
        //$result = $stmt->execute();

        if (!$stmt->execute()) {
                return false;
        }
        $entry = $stmt->fetch(PDO::FETCH_ASSOC);
        if($entry){
           // $userInfo = array();
           return [
            'user_id' => $entry['user_id'],
            'username' => $entry['username'],
            'email' => $entry['email']
           ];
           // return $userInfo;
        }
        else {
            return false;
        }
    }


    public function createAccount($username, $email, $passwd){
        $user = $this->getUserInfo($username);
        //print_r($user);
        if($user)
            return false;


        $username = strtolower($username);
        $hashed = password_hash($passwd, PASSWORD_DEFAULT);
//        $hashed = password_hash($passwd, PASSWORD_ARGON2I);

        $query = 'INSERT INTO users (username, email) VALUES (:username, :email)';
        $stmt = $this->dbconn->prepare($query);

        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':email', $email);
        $result = $stmt->execute();
        if (!$result) {
                error_log("Failed to insert into users");
                return false;
        }

        //print_r($result);

        $user = $this->getUserInfo($username);
        $id = $user['user_id'];

        $query2 = "INSERT INTO passwords VALUES (:user_id, :password)";
        $stmt2 = $this->dbconn->prepare($query2);
        $createResult = $stmt2->execute([
                ':user_id' => $id,
                ':password' => $hashed
        ]);
        if (!$createResult){
                error_log("Failed to insert password");
                return false;
        }
        //$this->dbconn->execute($query2);
        return true;


    }

    public function removeUser($username){
        $user = $this->getUserInfo($username);

        if (!$user)
            return false;

        $id = $user['user_id'];
        $query1 = sprintf("DELETE FROM users WHERE user_id = %d", $id);
        $query2 = sprintf("DELETE FROM passwords WHERE user_id = %d", $id);

        $result1 = $this->dbconn->query($query1);
        $result2 = $this->dbconn->query($query2);

        return true;

    }

    public function verifyPassword($username, $passwd){
        $username = strtolower($username);
        $user = $this->getUserInfo($username);

        if(!$user)
            return false;

        $id = $user['user_id'];
        $query = sprintf("SELECT password FROM passwords WHERE user_id = %d", $id);
        $result = $this->dbconn->query($query);

        $entry = $result->fetch(PDO::FETCH_ASSOC);
//        if(!$entry)
//            return false;

//        $hashed = $entry['password'];
        if(!$entry || empty($entry['password']) || !is_string($entry['password'])){
           return false;
        }

        return password_verify($passwd, $entry['password']);
    }
}



?>