<?php
include "connect.php";
session_start();

if(isset($_POST['submitLogin'])){
    
    //login the user
    $_SESSION['id'] = 1; //one user 
    header("Location: index.php"); //return to front page
}



?>