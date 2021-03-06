<?php
include "connect.php";
include "functions.php";

if(isset($_POST['submit'])) {
    UpdateTable(); //call update table function
}
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Update Form</title>
        <link rel="stylesheet" href="style.css" type="text/css">
    </head>

    <body>
        <h1>UPDATE ROW (ID BASED)</h1>

        <form method="post" action="updateForm.php"> 

            <p>First Name
                <input type="text" name="first">
                <br>
                <small style='color:grey'>We'll never share your personal information.</small>
            </p>


            <p>Last name
                <input type="text" name="last">
                <br>
                <small style='color:grey'>We'll never share your personal information.</small>
            </p>

            <p>Email Address
                <input type="email" name="email">
                <br>
                <small style='color:grey'>We'll never share your email.</small>
            </p>

            <p>Username
                <input type="text" name="uid">
            </p>


            <p>Password
                <input type="password" name="pwd">
                <br>
                <small style='color:grey'>We'll never share your password.</small>
            </p>

            <!-- (NEW) (select tag)  
DROP DOWN MENU to pick up id from database-->

            <!-- name="id" in  select tag, because we need this value to pass from form -->
            <select name="id" id="">
                <?php 
                showAllData(); //in functions.php
                ?>
            </select>

            <button type="submit" style='color:blue' name="submit">Update</button>
        </form>

        <?php

        //get full url from browser
        $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        //checking for position of string inside url
        if(strpos($fullUrl, "signup=empty") == true){
            echo "<p style='color:red'>You did not fill in all fields!</p>";
            exit(); //if one of them is true, no need to run rest of script
        }
        elseif(strpos($fullUrl, "signup=char") == true){
            echo "<p style='color:red'>You used invalid characters!</p>";
            exit();
        }
        elseif(strpos($fullUrl, "signup=email") == true){
            echo "<p style='color:red'>You used an invalid email!</p>";
            exit();
        }
        elseif(strpos($fullUrl, "emailexists") == true){
            echo "<p style='color:red'>Email already exists! Enter a different email</p>";
            exit();
        }
        elseif(strpos($fullUrl, "userexists") == true){
            echo "<p style='color:red'>Username already exists! Enter a different name</p>";
            exit();
        }

        ?>

    </body>
</html>


