<?php
include "server/connect.php";

//1st page of password recovery
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
        
         <!-- Here we create the form which starts the password recovery process -->

        <div class="">

            <h1>Reset your password</h1>

            <p>An email will be sent to you with instructions on how to reset your password</p>
            <br>
            
            <form action="server/reset-request.php" method="post">
               
               <input type="email" name="email" placeholder="Enter your email address">
               <button type="submit" name="reset-request-submit">Reset new password by email</button>
                
            </form>
            
            <a class="link-head" href="index.php">Login</a>
            <br>

        </div>
        
        <?php
        
        //error message
        if(isset($_GET['reset'])){
            
            if($_GET['reset'] == 'success'){
                echo '<p style="color:green">Password Recovery Success! Check your e-mail.</p>';
            }
        }
        
        
        ?>


    </body>
</html>