<?php

//create the connection class - using pdo object

class dbh
{
    private $dbHost = "localhost";
    private $dbUser = "root";
    private $dbPassword = "";
    private $dbName = "practice";
    private $charset = "utf8mb4";
    public $conn;

    //method 
    public function connect()
    {
        
        //set dsn - data source name

        //database type and database name
        $dsn = "mysql:host=$this->dbHost;dbname=$this->dbName;charset=$this->charset";

        //set the default attributes 
        $options = [
            PDO::ATTR_EMULATE_PREPARES   => false, // turn off emulation mode for "real" prepared statements
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, //turn on errors in the form of exceptions
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //make the default fetch be an associative array
        ];
        //check documentation for pdo set attribute

        try {
            //create new pdo connection
            //add dsn info,username, password and options
            $conn = new PDO($dsn, $this->dbUser, $this->dbPassword, $options);
            //echo "Connected successfully <br>";
            return $conn;
        } catch (Exception $ex) {
            die("Connection failed " . $ex->getMessage());
        }

    }

    //close off the database connection
    public function closeConnection(){
        return $this->conn = null; //initialize object to null
    }

}
