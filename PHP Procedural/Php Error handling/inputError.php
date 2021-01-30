<?php
//error handling
//include database connection

$first=$last=$user=$email=$password="";

function validate($data){ //function to validate form data
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);

    return $data;
}

//check if user has clicked submit button
if(isset($_POST['submit'])){

    //prevent sql injection and form validation (get form data)
    $first = validate($_POST['first']);
    $last = validate($_POST['last']);
    $email = validate($_POST['email']);
    $user = validate($_POST['uid']);
    $password = validate($_POST['pwd']);

    //-------------ERROR HANDLERS------

    //check if inputs are empty
    if(empty($first) || empty($last) || empty($email) || empty($user) || empty($password)){
        header("Location: formError.php?signup=empty"); //go back to the front page //? = data is shown on url
        exit(); //break,close off the script
    }
    else{ //if not empty,then
        //Check if input characters are valid
        if(!preg_match("/^[a-zA-Z]*$/",$first) || !preg_match("/^[a-zA-Z]*$/",$last)){
            header("Location: formError.php?signup=char");
            exit();
        }
        else{
            //Check if email is valid
            if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                header("Location: formError.php?signup=email");
                exit(); 
            }
            else{
                header("Location: formError.php?signup=success");
                exit();
            }
        }  
    }
}
else{
    header("Location: formError.php");
    exit();
}



?>