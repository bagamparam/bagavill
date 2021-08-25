<?php

    class Database {

        protected $host;
        protected $user;
        protected $pwd;
        protected $dbName;

        protected function __construct($host, $user, $pwd, $dbName){
            $this->host = $host;
            $this->user = $user;
            $this->pwd = $pwd;
            $this-> dbName = $dbName;
        }

        protected function connect(){
            $dbCon = new PDO("mysql:dbname=$this->dbName;host=$this->host", $this->user, $this->pwd);
            return $dbCon;

        }

    }

?>