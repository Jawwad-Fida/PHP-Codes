<?php
include "server/connect.php";
session_start();

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
            <!-- <a class="" href="index.php">
<img src="images/Logo.png">
</a> -->
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="#">Portfolio</a></li>
                <li><a href="#">About Me</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>

        <div class="">
            <!-- Login and Logout forms -->

            <?php

            //check if we have the session variables available on the website (we have 2 session variables - check one of them)

            //we can change content over here
            if(isset($_SESSION['userId'])){

                //we want to see only the logout form once we sign in to the website
                echo '<form action="server/logout.php" method="post">

                    <button type="submit" name="logout-submit">Logout</button>
                     </form>';
                echo '<br>';
            }
            else{

                echo ' <h1>Login</h1>';

                ////we want to see only the login form once we signout of the website
                echo '<form action="server/login.php" method="post">

                    <label for="name">
                        <p>Username/E-mail</p>
                    </label>
                    <input type="text" name="mailuid" placeholder="Enter Username/E-mail">

                    <label for="password">
                        <p>Password</p>
                    </label>
                    <input type="password" name="pwd" placeholder="Enter Password">

                    <button type="submit" name="login-submit">Login</button>
                    </form>';

                echo '<a class="link-head" href="signup.php">Sign up</a>';

                echo '<a class="link-head" href="reset-password.php">Forgot password</a>';

            }

            ?>


        </div>

    </body>

</html>
