<?php
include "connect.php";

function validate($data){

    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);

    return $data;
}

if(isset($_POST['reset-password-submit'])){

    $selector = $_POST['selector'];
    $validator = $_POST['validator'];
    $password = validate($_POST['pwd']);
    $passwordRepeat = validate($_POST['pwd-repeat']);

    //Error handlers

    //check if input fields are empty
    if(empty($password) || empty($password)){
        header("Location: ../create-new-password.php?newpwd=empty");
        exit();
    }
    elseif($password != $passwordRepeat){
        //check if passwords match each other
        header("Location: ../create-new-password.php?newpwd=pwdnotsame");
        exit();
    }

    //check the tokens if it is the correct user

    //get current date in order to match the date inside database to check if token has expired or not
    $currentDate = date("U");

    //select the actual token inside database
    //the selector token will be used to run a SELECT sql statement inside database
    //the validator token is to validate the proper user

    $sql = "SELECT * FROM pwdReset WHERE pwdResetSelector=? AND pwdResetExpires >= ?;";

    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        echo "There was an error"; 
        exit();
    }

    mysqli_stmt_bind_param($stmt,"ss",$selector,$currentDate); 
    mysqli_stmt_execute($stmt);

    $result  = mysqli_stmt_get_result($stmt); //get row data from database (it will be 1 row - since one token per user)

    //check if we got data from database
    if(!$row = mysqli_fetch_assoc($result)){
        echo "You need to re-submit your reset request."; 
        exit();
    }
    else{
        //we can refer the data is $row (associative array) by column names

        //match token inside database with token sent from form (make sure both of them are in binary data) 

        //the token in form is in hexadecimal. convert it to binary

        $tokenBin = hex2bin($validator);
        $tokenCheck = password_verify($tokenBin,$row['pwdResetToken']);

        if($tokenCheck === false){
            echo "You need to re-submit your reset request."; 
            exit();
        }
        elseif($tokenCheck === false){

            //update the new passwords in database

            //grab the email of the user to pinpoint which user inside the database we want to change the password of

            $tokenEmail = $row['pwdResetEmail'];

            $sql = "SELECT * FROM users WHERE emailUsers=?;";

            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt,$sql)){
                echo "There was an error"; 
                exit();
            }

            mysqli_stmt_bind_param($stmt,"s",$tokenEmail); 
            mysqli_stmt_execute($stmt);

            $result  = mysqli_stmt_get_result($stmt); 
            if(!$row = mysqli_fetch_assoc($result)){
                echo "There was an error!"; 
                exit();
            }
            else{

                //update the user's password inside the users table
                //---choose specifically where to update using SET---
                $sql = "UPDATE users SET pwdUsers=? WHERE emailUsers=?;";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt,$sql)){
                    echo "There was an error"; 
                    exit();
                }

                //HASH the new password
                $newPwdHash = password_hash($password,PASSWORD_DEFAULT);

                mysqli_stmt_bind_param($stmt,"ss",$newPwdHash,$tokenEmail); 
                mysqli_stmt_execute($stmt);

                //make sure to delete the token that we created when the user wanted to reset his password - using the email that the user refered to

                $sql = "DELETE FROM pwdReset WHERE pwdResetEmail=?;";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt,$sql)){
                    echo "There was an error"; 
                    exit();
                }
                mysqli_stmt_bind_param($stmt,"s",$tokenEmail); 
                mysqli_stmt_execute($stmt);
                header("Location: ../index.php?newpwd=passwordupdated");


            }

        }
        else{
            //if an unexpected error occurs
        }



    }


}
else{
    header("Location: ../index.php");
    exit();
}


?>