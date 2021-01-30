<?php

//UPLOADING A FILE 

include "connect.php";
session_start();

//get session id from currently logged in user
$id = $_SESSION['id']; //note: - here, undefined index error will be shown. 
//The error will go away once u are logged in and the session id becomes available. Logging out will bring the same error again


if(isset($_POST['submit'])){

    $file = $_FILES['file']; 

    print_r($file); //upload a file and find out its contents

    //---5 important contents of a file
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    //-------------PROCEDURE TO UPLOAD---------

    $fileExt = explode('.',$fileName); //remove '.' dot extension from file name
    //doing so, we get 2 parts: - name of file and extension
    //explode() creates an array
    
    $fileActualExt = strtolower(end($fileExt)); //convert to lowercase
    //end() = get last piece of data (e.g JPEG)

    $allowed = array('jpg','jpeg','png','pdf'); //type of files to allow in website

    //--------check if file is allowed to be uploaded(if it has proper extensions)
    if(in_array($fileActualExt,$allowed)){

        //check for errors during upload
        if($fileError === 0){

            //check for file size
            if($fileSize < 500000){  //500000 kb = 500 mb
             
                //----------Finally,upload the file-------

                //make sure the file has a unique(random) name (to prevent overridden)
                $fileNameNew = "profile".$id.".".$fileActualExt; //make sure to add the extension to the new file name

                
                //-------now, where to upload the file inside root folder

                //we can upload to another folder or database
                $fileDestination = 'up/'.$fileNameNew; //location, plus, name of file
            
                //function to upload file
                move_uploaded_file($fileTmpName,$fileDestination);
                //param - temp location of file,upload location of file
                
                //in database, update profileimg table (status)
                $sql = "UPDATE profileimg SET status=0 WHERE userid='$id';";
                $result=mysqli_query($connection,$sql);
                header("Location: index.php?uploadsuccess");             

            }
            else{
                echo "Your file is too big";
            }

        }
        else{
            echo "There was an error uploading your file";
        }

    }
    else{
        echo "You cannot upload files of this type";
    }

}


?>