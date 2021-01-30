<?php
include "server/connect.php";

//2nd page of password recovery-  this is page the user will be redirected to after clicking the link in the email. In this page, the user can give a new password
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

        <nav class="">

            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="#">Portfolio</a></li>
                <li><a href="#">About Me</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>


        <!-- form to allow user to reset his password inside the password -->

        <div class="">

            <?php

            //we need to check if the tokens are inside the url
            //and, after password is changed, we need to check the tokens inside database

            //grab the tokens
            if(isset($_GET['selector'])){

                $selector = $_GET['selector'];
                $validator = $_GET['validator'];

                if(empty($selector) || empty($validator)){
                    echo "Could not validate your request!";
                }
                else{
                    //check if the tokens are legit(correct) - that is, if they have the correct hexadecimals using ctype_xdigit() 

                    if(ctype_xdigit($selector) !== false && ctype_xdigit($true) !== false){

                        //type=hidden - hidden from browser, but is present as code

                        //form to change password 
                        echo '<form action="server/changePassword.php" method="post">

                    <input type="hidden" name="selector" value="<?php echo $selector; ?>">

                    <input type="hidden" name="validator" value="<?php echo $validator; ?>">

                    <input type="password" name="pwd" placeholder="Enter you new password">

                    <input type="password" name="pwd-repeat" placeholder="Repeat new password">

                    <button type="submit" name="reset-password-submit">Reset password</button>
                      </form>';

                    }

                }
            }

            ?>

        </div>

    </body>
</html>