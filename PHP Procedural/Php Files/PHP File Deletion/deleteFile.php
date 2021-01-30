<?php

//DELETE FILES

//--------Deleting multiple files-----------

$fileNames="";

if(isset($_POST['submit'])){

    $fileNames=$_POST['filename'];
    $removeSpaces = str_replace(" ", "",$fileNames);//3 parameters
    /*
    1st para = what we are searching for. " "=space
    2nd para = what to replace it with. ""=no space
    3rd para = which string to check.
    */

    //seperate each thing we typed in using commas. use explode() to seperate strings using specific characters
    $allFileNames = explode(",",$removeSpaces); 

    $countAllNames = count($allFileNames);//size of array
    
    //loop out each time we have a data in array
    for($i=0; $i<$countAllNames; $i++){
        
        //check all types of files, with various names and extensions, in folder
        if(file_exists("/images/".$allFileNames[$i]) == false){
            header("Location: delForm.php?deleteerror");
            exit(); //terminate script (prevent anything else from running)
        }
    } 

    for($i=0; $i,$countAllNames; $i++){

        $path = "/images/".$allFileNames[$i];
        
        if(!unlink($path)){   //delete each file
            echo "You have an error";
            exit();
        }
        else{
            header("Location: delForm.php?deletesuccess");
        }

    }
    

}


/*
//--------------Delete a single file from root folder-----------

$path="/images/design*"; //since we dont know the extension of the file, we place *(all)

$fileinfo = glob($path); //glob() - get all information of a file having a certain string (search any kind of file)
//glob() returns an array

$fileactualname = $fileinfo[0]; //get first inforamtion of file at index 0


//unlink() - to delete file
if(!unlink($fileactualname)){
    echo "You have an error";
}
else{
    header("Location: delForm.php?deletesuccess");
}
*/

?>
