<?php
//2nd Method
//create a unique id based on the current timestap based on microseconds

?>


<!DOCTYPE html> <!-- -->
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Unique String</title>
        <link rel="stylesheet" href="" type="text/css">
    </head>

    <body>

        <?php

        //used for creating unique urls or file names.

        function generateKey(){

            //create a unique id by uniqid()
            $randStr = uniqid();

            //if we want to be more specific (unique)
            $randStr = uniqid('Jawwad',true); //use a prefix
            return $randStr;
        }
        echo generateKey();
        echo "<br>"



        //DONT use it in databases for securing data like passwords


        ?>


    </body>
</html>