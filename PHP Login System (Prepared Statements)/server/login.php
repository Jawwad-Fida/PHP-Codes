<?php
include "connect.php";

function validate($data){

    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);

    return $data;
}


//check if user has pressed the button
if(isset($_POST['login-submit'])){

    $mailuid = validate($_POST['mailuid']);
    $password = validate($_POST['pwd']);

    //Error handlers

    //check if inputs are empty
    if(empty($mailuid) || empty($password)){
        header("Location: ../index.php?error=emptyfields");
        exit();
    }
    
    //Now, we will check the database to see if a username or email exits for login, and get password from database to see if it matches the password entered by the user to login

    $sql = "SELECT * FROM users WHERE uidUsers=? OR emailUsers=?;";
    $stmt = mysqli_stmt_init($conn);

    //check database
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("Location: ../index.php?error=sqlerror");
        exit();
    }

    mysqli_stmt_bind_param($stmt,"ss",$mailuid,$mailuid);
    mysqli_stmt_execute($stmt);

    //get result from database
    $result = mysqli_stmt_get_result($stmt);

    //check if there is a result
    if($row = mysqli_fetch_assoc($result)){

        //grab the password from user if username/email exists. Then match the passwords

        //de-hash password from database (returns 0=false or 1=true)
        $pwdCheck = password_verify($password,$row['pwdUsers']);
        //$password - entered by the user in login page
        //$row['pwdUsers'] = password from database

        if($pwdCheck == false){

            //if password is false, then don't log in the user
            header("Location: ../index.php?error=wrongpwd");
            exit();
        }
        elseif($pwdCheck == true){
            
            //if password is true, and username/email is also true, then log in the user
            
            //start a session
            session_start();
            
            //store information of the user from database in the global session variable
            //$_SESSION['name of session variable']
            $_SESSION['userId'] = $row['idUsers']; //we can refer the data is $row (associative array) by column names
            $_SESSION['userUid'] = $row['uidUsers'];
            
            //to check if the global session variable is available, session_start() should be on all web pages.
            
            header("Location: ../index.php?login=success");
            exit();
            
        }
        else{
            //if a mistake occurs, such that $pwdCheck is not a true or false value
            header("Location: ../index.php?error=wrongpwd");
            exit();
        }
        
        



    }
    else{
        //no such username/email enetered by user exists in database 
        header("Location: ../index.php?error=nouser");
        exit();
    }





}
else{
    header("Location: ../index.php");
    exit();
}







?>





<!--
//success
header("Location: ../signUP.php?signup=success"); 
exit();


<!DOCTYPE html>  
<html lang="en">

<head>
<meta charset="utf-8">
<meta name="description" content="This is an example of a meta description. This will show up in search results">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Page</title>
<link rel="stylesheet" href="style2.css" type="text/css">
</head>

<body>

<img src="../index.php"
-->