<?php
include "connect.php";

$first=$last=$uid=$pwd="";

function validate($data){
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);

    return $data;

}

if(isset($_POST['submitSignup'])){
    global $connection;

    $first = validate($_POST['first']);
    $first = mysqli_real_escape_string($connection,$first);

    $last = validate($_POST['last']);
    $first = mysqli_real_escape_string($connection,$first);

    $uid = validate($_POST['uid']);
    $first = mysqli_real_escape_string($connection,$first);

    $pwd = validate($_POST['pwd']);
    $first = mysqli_real_escape_string($connection,$first);

    $pwd = password_hash($pwd,PASSWORD_DEFAULT);

    $sql = "INSERT INTO users(first,last,username,password) VALUES('$first','$last','$uid','$pwd');";    
    mysqli_query($connection,$sql);

    
    //---------------NEW--------------------
    
    //select the user in database
    $sql = "SELECT * FROM users WHERE username='$uid' AND first='$first'"; //name is required to prevent overriden of profiles   

    $result = mysqli_query($connection,$sql);
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            
            $userid=$row['id']; //get id
            
            //now, insert row in profile image column
            $sql = "INSERT INTO profileimg(userid,status) VALUES('$userid',1);"; //check status
            //1 = no profile image yet
            //0 = show the user's profile image
            
            mysqli_query($connection,$sql);
            header("Location: index.php?signup=success");

        }
    }
    else{
        echo "You have an error";
    }



}




?>