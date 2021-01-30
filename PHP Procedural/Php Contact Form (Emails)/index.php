<?php 

//PROBLEM: - sending mails wont work on local host(offline server)

//we need an online server -i.e. a hosting service where we can get web domains


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Contact Form</title>
        <link rel="stylesheet" href="style.css" type="text/css">
    </head>

    <body>

        <h1>Send E-MAIL</h1>

        <form action="contact.php" method="post">

            <p>Name
                <input type="text" name="name" placeholder="Full name">
            </p>

            <p>E-mail
                <input type="email" name="mail" placeholder="Your e-mail">
            </p>

            <p>Subject
                <input type="text" name="subject" placeholder="Subject">
            </p>

            <p>
                <textarea name="message" placeholder="Enter your message" rows="5" col="50"></textarea>
            </p>

            <button type="submit" name="submit">SEND MAIL</button>

        </form>

        <?php
        $fullUrl="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        //check position of string inside url
        if(strpos($fullUrl,"inputs=empty")){
            echo "<p style='color:red'>You did not fill in all the fields!</p>";
        }
        elseif(strpos($fullUrl,"inputs=invalid")){
            echo "<p style='color:red'>You used invalid characters!</p>";
        }
        elseif(strpos($fullUrl,"email=invalid")){
            echo "<p style='color:red'>You used an invalid email!</p>";
        }
        elseif(strpos($fullUrl,"mailsent")){
            echo "<p style='color:green'>Message sent!</p>";
        }


        ?>

    </body>

</html>