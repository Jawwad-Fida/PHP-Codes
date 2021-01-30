<?php
include "connect.php";

//3rd Method

//This example you can use for creating secure data like passwords, if you want to create it for the users or allow them to "auto generate" a password.

//It is a bit completed.

?>

<?php

//function to check if similar keys exists in table in database: - 
//if same key exists, generate a new key (key has to be unique)
//if key does not exists, then the generated key is uniqyue and we can use it
function checkKeys($conn,$randStr){

    $sql = "SELECT * FROM keystring";
    $result = mysqli_query($conn,$sql);
    $resultCheck = mysqli_num_rows($result);
    
    //CHECKING LOOP (For keys in table in db)
    if($resultCheck>0){
        while($row = mysqli_fetch_assoc($result)){

            //check if we have rows or columns that matches with the random key

            //GOAL: - keys have to be unique inside database.If a match is found, then we have to change the key

            if($row['keystringKey'] == $randStr){

                //match found inside database
                echo "Match Found. Generate a new key";
                echo "<br>";
                $keyExists = true;
                break; //exit loop
            }
            else{

                //match not found
                $keyExists=false;
                //continue loop
            }
        }
    }

    return $keyExists;
}

//function to generate a unique(random) key
function generateKey($conn){

    $keyLength = 1;

    $str = "abcdefg";

    $shuffleStr = str_shuffle($str); 
    $randStr = substr($shuffleStr,0,$keyLength);

    $checkKey = checkKeys($conn,$randStr);

    while($checkKey == true){

        //create a new random key because something similar found inside database
        $shuffleStr = str_shuffle($str);
        $randStr = substr($shuffleStr,0,$keyLength);

        //loop continues to generate a new key and then checks it inside the database, until we get a key that does not exist inside database.
        $checkKey = checkKeys($conn,$randStr);
    }
    
    return $randStr;
}

echo generateKey($conn);

//as we refresh the browser, we never get a,b or c inside browser as these are already available in database.

//we can then assign these keys to specific users.
//e.g. helps us define from owner,admins,pro-users,members,newbies. each of them will have unique keys.
    
    
?>


