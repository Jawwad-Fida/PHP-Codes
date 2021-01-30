<?php
//we use regular expressions with strings in order to go inside the string and see if we have a certain string of characters that exist in the string. (returns true or false)

//we can also use regular expressions to replace characters in strings.

//used commonly with error handlers (really useful)
?>


<!DOCTYPE html> <!-- -->
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Functions using regular expressions</title>
        <link rel="stylesheet" href="" type="text/css">
    </head>

    <body>

        <?php
        
        
        $string = "My name is Daniel, Daniel is my name"; //here is a string
        
        
        //Regular expressions are inserted in => "/.../" 
        
        
        //preg_match() - searches for a certain set of characters inside a string
        if(preg_match("/Daniel/",$string)){
            echo "It is a match";
        }
        echo "<br>";
        
        
        //preg_match_all() = get all results
        //3rd parameter array => not needed that much
        if(preg_match_all("/Daniel/",$string,$array)){
            print_r($array);
        }
        echo "<br>";
        
        
        //"/Da(ni)el/" = 2 searches in one expression. Daniel and ni
        if(preg_match_all("/Da(ni)el/",$string,$array)){
            echo $array[0][1];
        }  
        echo "<br>";
        
        
        //3 parameters = which String to replace, what to replace it with, and string variable
        $string2 = preg_replace("/Daniel/","John",$string);
        echo $string2;
        

        ?>


    </body>
</html>