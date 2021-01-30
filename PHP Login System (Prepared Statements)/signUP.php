<?php
include "server/connect.php";

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

        <div class="">

            <h1>Signup</h1>

            <!--Signup Form -->
            <form action="server/signup.php" method="post">

                <label for="name">
                    <p>Username</p>
                </label>
                <input type="text" name="uid" placeholder="Enter Username">
                <small style='color:grey'>We'll never share your username.</small>

                <label for="email">
                    <p>E-mail</p>
                </label>
                <input type="email" name="mail" placeholder="Enter E-mail">
                <small style='color:grey'>We'll never share your email.</small>

                <label for="password">
                    <p>Password</p>
                </label>
                <input type="password" name="pwd" placeholder="Enter Password">

                <label for="repeat-password">
                    <p>Repeat Password</p>
                </label>
                <input type="password" name="pwd-repeat" placeholder="Repeat Password">

                <button type="submit" name="signup-submit">Signup</button>

                <button type="reset" name="reset">Reset</button>
            </form>


            <a class="link-head" href="index.php">Login</a>
            <br>

        </div>
        
        <!-- Here we create the form which starts the password recovery process -->

        <?php

        //creating error messages

        //check if an error is set on the url
        if(isset($_GET['error'])){

            //check for a cerain kind of error
            if($_GET['error'] == "emptyfields"){
                echo "<p style='color:red'>Fill in all the Fields!</p>";
            }
            elseif($_GET['error'] == "invalidmailuid"){
                echo "<p style='color:red'>Invalid Username and e-mail!</p>";
            }
            elseif($_GET['error'] == "invalidmail"){
                echo "<p style='color:red'>Invalid E-mail!</p>";
            }
            elseif($_GET['error'] == "invaliduid"){
                echo "<p style='color:red'>Invalid Username!</p>";
            }
            elseif($_GET['error'] == "passwordcheck"){
                echo "<p style='color:red'>Your passwords do not match!</p>";
            }
            elseif($_GET['error'] == "usertaken"){
                echo "<p style='color:red'>Username already taken!</p>";
            }

        }

        //success messages
        if(isset($_GET['signup'])){
            if($_GET['signup'] == "success"){
                echo "<p style='color:green'>Signup Successfull!</p>";
            }
        }


        ?>




        <?php
        //link footer
        include "footer.php";
        ?>

    </body>

</html>
