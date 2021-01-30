<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Demo Session</title>
    </head>

    <body>
        <!--action keyword sends data in form to another page -->
        <!--sends data in the form of post(post is for forms) -->
        <!--data sent will be received by post superglobal (defined above) -->
        <!--dont forget that without keyword 'name', u can't send data -->
        <form action="form_process.php" method="post">
            
            <input type="text" placeholder="Enter username" name="username"> 
            <input type="password" placeholder="Enter password" name="password"> <br>
            <input type="submit" name="submit">
                       
        </form>
        

    </body>
</html>