<?php

class Validate{

    public function validate_data($data){
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);

        return $data;
    }
    
    //checking for errors
    public function checkEmpty($username,$password){
        if(empty($username) || empty($password)){
            header("Location: insert.php?error=emptyfields&uid=".$username); 
            exit(); //stop script from running
        }
    }

    public function checkEmpty_Update($username,$password){
        if(empty($username) || empty($password)){
            header("Location: update.php?error=emptyfields&uid=".$username); 
            exit(); //stop script from running
        }
    }



}