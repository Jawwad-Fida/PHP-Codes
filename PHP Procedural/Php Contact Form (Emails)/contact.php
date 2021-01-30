<?php

$name=$subject=$mailFrom=$message="";

function validate($data){
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);

    return $data;
}

if(isset($_POST['submit'])){

    $name = validate($_POST['name']);
    $subject = validate($_POST['subject']);
    $mailFrom = validate($_POST['mail']);
    $message = validate($_POST['message']);

    //--------Error handlers--------

    //check if inputs are empty
    if(empty($name) || empty($subject) || empty($mailFrom) || empty($message)){
        header("Location: index.php?inputs=empty");
        exit();
    }
    else{
        //not empty

        //check if input characters are valid
        if(!preg_match("/^[a-zA-Z]*$/",$name)){
            header("Location: index.php?inputs=invalid");
            exit();
        }
        else{
            //valid characters

            //check if e-mail is valid
            if(!filter_var($mailFrom,FILTER_VALIDATE_EMAIL)){
                header("Location: index.php?email=invalid");
                exit();
            }
        }
    }


    //-----------------NEW--------------
    //mail() - allows you to send emails directly from a script.
    //4 main parameters: - a)which mail to send to(us) b)subject of the mail  c)actual message of the mail d)headers - optional headers
    //there can be more parameters

    $mailTo = "fidajisa@hotmail.com";

    //add extra information to mail - e.g. who the mail is from
    $headers = "From: " .$mailFrom;
    $txt = "You have received an email from " .$name ."\n\n" .$message; 


    mail($mailTo,$subject,$txt,$headers);
    header("Location: index.php?mailsent");


}

?>