<?php

// spl_autoload_register() - pass the function inside
spl_autoload_register('myAutoLoader');

function myAutoLoader($className){
    //$className - the variable is a placeholder whenever we create an object from a class
    
    //create the path to where our classess are saved
    $path="classess/";
    
    //get extension of the file
    $extension = ".class.php";
    
    //write full path name
    $fullPath = $path .$className .$extension;
    
    //check for errors - if file is not found
    if(!file_exists($fullPath)){
        return false;
    }

    include_once $fullPath;
}

//we dont need to touch this file anymore