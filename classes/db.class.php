<?php 

class Db {
    private $host = "localhost";
    private $user = "u216558363_Keyson";
    private $password = "Keyson200510021216";
    private $dbName = "u216558363_Keyson";

    public function connection(){
        $dsn = "mysql:host=".$this->host.";dbname=".$this->dbName;
        $pdo = new PDO($dsn, $this->user, $this->password);
        return $pdo;
    }
}