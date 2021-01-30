<?php

//3 variables of server
$dbServername="localhost";
$dbUsername="root";
$dbPassword="";
//variable to hold database name
$dbName="fidasystem";

//Connection to database
$conn = mysqli_connect($dbServername,$dbUsername,$dbPassword,$dbName);

/*
//Check the connection
if(!$conn){
    die("Connection failed: " .mysqli_connect_error());
}
else{
    echo "Connection established successfully";
}
*/

//ALL FILES - PHP Procedural programming

//NOTE: - we can choose to close our sql statements with ; or not, both are correct.

?>