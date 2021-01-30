<?php
$db_host = "localhost"; //will change for online server
$db_user = "root";   //will change for online server
$db_password = "";    //will change for online server
$db_name = "practice";

//create connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);


//check connection
if($conn->connect_error){
    die("Connection Failed");
}
else{
    echo "Connection established successfully";
}

