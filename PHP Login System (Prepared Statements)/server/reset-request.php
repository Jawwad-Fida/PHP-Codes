<?php
include "connect.php";

//we will create tokens here

function validate($data){

    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);

    return $data;
}

//check if user clicked the button
if(isset($_POST['reset-request-submit'])){

    $userEmail = validate($_POST['email']);

    //create a token
    //token has to be cryptography secure 
   
    //we will use 2 tokens

    $selector = bin2hex(random_bytes(8)); //selector token
    $token = random_bytes(32); //for authentication of user. It needs to be longer due to security

    //create the link to sent to user by email

    //NOTE:- $url will CHANGE depending on your WEBSITE
    //$url = "websiteLink/pageToReferTo?tokens"
    $url = "http://www.mmtuts.net/create-new-password.php?selector=" .$selector ."&validator=" .bin2hex($token);


    //create a expirary date for the token

    //U = Today's date in seconds since 1970
    $expires = date("U") + 1800;     //1 hour = 1800 seconds

    //-------set up the token inside database--------

    //1st step - delete existing tokens from the same user inside database (to avoid multiple tokens send to user)

    //using prepared statements
    $sql = "DELETE FROM pwdReset WHERE pwdResetEmail=?;";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql)){
        //if the sql statement fails
        echo "You have an error";
        exit();
    }

    mysqli_stmt_bind_param($stmt,"s",$userEmail);
    mysqli_stmt_execute($stmt);

    //2nd step - insert token into database
    $sql = "INSERT INTO pwdReset (pwdResetEmail,pwdResetSelector,pwdResetToken,pwdResetExpires) VALUES (?,?,?,?);";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt,$sql)){
        echo "You have an error";
        exit();
    }

    //hash the token - to prevent hackers from reading the token
    $hashToken = password_hash($token,PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt,"ssss",$userEmail,$selector,$hashToken,$expires);
    mysqli_stmt_execute($stmt);


    mysqli_stmt_close($stmt);

    //send the email
    $to = $userEmail;
    $subject = "Reset your password for mmtuts";
    $message = '
    <p>We received a password reset request. The link to reset you password is below. If you did not make this request, you can ignore this email</p>
    <p>Here is you password reset link : <br>
    <a href="'.$url.'">'.$url.'</a>
    
    </p>';

    //\r\n = new line in php
    //From: ourname <email> \r\n 
    $headers = "
    From: mmtuts <usemmtuts@gmail.com>\r\n
    Reply-to: usemmtuts@gmail.com\r\n
    Context-type: text/html\r\n";
    //if we dont include the last line, then html wont work in the email we send the user ******
    
    mail($to,$subject,$message,$headers);
    header("Location: ../reset-password.php?reset=success");
    

}
else{
    header("Location: ../reset-password.php");
}

mysqli_close($conn);


?>

