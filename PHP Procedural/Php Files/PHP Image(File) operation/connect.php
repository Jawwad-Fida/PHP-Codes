<?php

$dbServerName = "localhost";
$dbUsername = "root";
$dbPassword ="";
$dbName ="profileimage";

$connection = mysqli_connect($dbServerName,$dbUsername,$dbPassword,$dbName);

//In profileimage database, we will CREATE 2 tables.
//first table - user information
//second table - whether we have uploaded an image or not

/*
if(!$connection){
    die("Connection failed: " .mysqli_connect_error());
}
else{
    echo "Connection established successfully";
}
*/


?>