<?php
include "connect.php";

$username = $email = $password = $passwordRepeat = "";

function validate($data){

    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);

    return $data;
}


//check if user has pressed the button
if(isset($_POST['signup-submit'])){
    global $conn;

    //catch form data
    $username = validate($_POST['uid']);
    $username = mysqli_real_escape_string($conn,$username);

    $email = validate($_POST['mail']);
    $email = mysqli_real_escape_string($conn,$email);

    $password = validate($_POST['pwd']);
    $password = mysqli_real_escape_string($conn,$password);

    $passwordRepeat = validate($_POST['pwd-repeat']);
    $passwordRepeat = mysqli_real_escape_string($conn,$passwordRepeat);

    
    //Error handling 
    //Info: -  Correct Fields will remain untouched (We will use ? - adding information to url, & - add more information [join to existing url information] )

    
    //FOLLOW THE SEQUENCE OF ERROR HANDLERS

    //check if inputs are empty
    if(empty($username) || empty($email) || empty($password) || empty($passwordRepeat)){
        header("Location: ../signUP.php?error=emptyfields&uid=".$username."&mail=".$email); 
        exit(); //stop script from running
    }
    elseif(!filter_var($email,FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z]*$/",$username)){
        //if user did not write a proper email and username (check for valid email and username)
        header("Location: ../signUP.php?error=invalidmailuid"); 
        exit();
    }
    elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        //check if email is valid
        header("Location: ../signUP.php?error=invalidmail&uid=".$username); //sending back email (correct)
        exit();  
    }
    elseif(!preg_match("/^[a-zA-Z]*$/",$username)){
        //check if input characters are valid
        header("Location: ../signUP.php?error=invaliduid&mail=".$email); 
        exit();  
    }
    elseif($password !== $passwordRepeat){
        //check if the two passwords are identical to each other 
        header("Location: ../signUP.php?error=passwordcheck&uid=".$username."&mail=".$email); //sending back both username and password (correct)
        exit();
    }

    //Checking if a DUPLICATE username exists

    //Create a template
    $sql = "SELECT uidUsers FROM users WHERE uidUsers=?;";

    //mysqli_stmt_init() - initialize db connection (creating a prepared statement)
    $stmt = mysqli_stmt_init($conn);

    //mysqli_stmt_prepare() - prepare the prepared statement
    if(!mysqli_stmt_prepare($stmt,$sql)){
        //if the sql statement fails
        header("Location: ../signUP.php?error=sqlerror");  
        exit();
    }

    mysqli_stmt_bind_param($stmt,"s",$username);  //Bind the parameters to the placeholder

    //mysqli_stmt_execute() - execute statement (run parameters inside database)
    mysqli_stmt_execute($stmt);

    //Fetch information from database and store it in $stmt
    mysqli_stmt_store_result($stmt);

    //check how many rows(results) are there. (Result will be 0 or 1)
    $resultCheck  = mysqli_stmt_num_rows($stmt);

    if($resultCheck > 0){
        header("Location: ../signUP.php?error=usertaken&mail=".$email); 
        exit();
    }

  

    //---------INSERT DATA INTO DATABASE----------

    //Add these in the same order as they appear in the sql statement
    $sql = "INSERT INTO users(uidUsers,emailUsers,pwdUsers) VALUES(?,?,?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("Location: ../signUP.php?error=sqlerror"); 
        exit();

    }
    else{
        //Password hashing
        $passwordHash = password_hash($password,PASSWORD_DEFAULT);
        $passwordHashRepeat = $passwordHash;
        mysqli_stmt_bind_param($stmt,"sss",$username,$email,$passwordHash);
        mysqli_stmt_execute($stmt);
        header("Location: ../signUP.php?signup=success"); 
        exit();
    }


    mysqli_stmt_close($stmt); //close statements




}
else{
    header("Location: ../signUP.php"); 
    exit();
}

mysqli_close($conn); //close connection



?>


