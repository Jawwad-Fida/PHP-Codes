<?php
//Main Page

?>


<!DOCTYPE html> <!-- -->
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="description" content="This is an example of a meta description. This will show up in search results">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login Page</title>
        <link rel="stylesheet" href="style2.css" type="text/css">
    </head>

    <body>

        <?php
        //link header
        include "header.php";
        ?>

        <main>
            <?php

            //check if we have the session variables available on the website (we have 2 session variables - check one of them)

            //we can change content over here
            if(isset($_SESSION['userId'])){

                //if exists, we are logged in
                echo "<br>";
                echo "<p>You are logged in!</p>";
            }
            else{
                echo "<br>";
                echo "<p>You are logged out!</p>";
            }

            ?>

        </main>

        <?php

        //creating error messages

        //check if an error is set on the url
        if(isset($_GET['error'])){

            //check for a certain kind of error
            if($_GET['error'] == "wrongpwd"){
                echo "<p style='color:red'>Password is incorrect!</p>";
            }
                     
        }

        ?>
        
        
        <?php

        //creating error messages for password reset

        //check if an error is set on the url
        if(isset($_GET['newpwd'])){

            //check for a certain kind of error
            if($_GET['newpwd'] == "passwordupdated"){
                echo "<p style='color:green'>Your password has been reset!</p>";
            }
                     
        }

        ?>
        

        <?php
        //link footer
        include "footer.php";
        ?>


    </body>

</html>
