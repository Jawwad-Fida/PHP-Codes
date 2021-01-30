<?php
//creating a random key (unique string of characters)
//MANY USES (eg): - 
//1) sending a temporary key by mail to allow a user to reset their password on a website.
//2) randomly generated link when uploading videos on youtube
//etc

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
        //1st method
        //used for sending code to someone by email in order to reset their passwords inside a website 
       
        
        function generateKey(){
            
            //define how long the key will be
            $keyLength = 8;
            
            //create the characters we want to include inside our key
            //includes digits,characters,special characters,etc
            $str = "1234567890abcdefghijklmnopqrstuvwxyz()/$";
            
            //mix them together, shuffle them, and then cut off the tail
            
            $shuffleStr = str_shuffle($str); //shuffle
            
            //cut off tail
            //substr() - 3 paramters: - shuffled string, where we want to start cutting characters, how many characters to include before cutting off rest of characters
            $randStr = substr($shuffleStr,0,$keyLength);
            return $randStr;
        }
        
        echo generateKey();
        echo "<br>"
            
            
        
         //but in other examples where we want to create something unique, we can't do it this way

        ?>


    </body>
</html>