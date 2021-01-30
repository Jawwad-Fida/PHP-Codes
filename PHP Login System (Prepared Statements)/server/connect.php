<?php
//always check for errors first when writing php code 

//Varibales for connection - XAMPP (Offline server)
$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "loginsystem";

//Connection to database
$conn = mysqli_connect($dbServername,$dbUsername,$dbPassword,$dbName);

/*
//check the connection. TIP: - check for error first
if(!$conn){
    die("Connection failed " .mysqli_connect_error());
}
else{
    echo "Connection established succesfully";
}
*/

//make sure to change the database information when you are uploading it to an online server (depending on the hosting company)


?>