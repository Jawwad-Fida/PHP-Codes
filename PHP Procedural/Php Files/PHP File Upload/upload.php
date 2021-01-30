<?php

//UPLOADING A FILE 

if(isset($_POST['submit'])){
    
     //$_FILES = gets information from the files that we will use as input to upload from a form
    $file = $_FILES['file']; 

    print_r($file); //upload a file and find out its contents. The contents of the file will be an associative array

    //---These 5 are important contents of a file
    //[file][content to extract from file]
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    //--------------PROCEDURE TO UPLOAD-------------

    $fileExt = explode('.',$fileName); //remove '.' dot extension from file name
    //use explode() to seperate strings using specific characters. explode() creates an index array
    //doing so, we get 2 parts: - name of file and extension
    
    $fileActualExt = strtolower(end($fileExt)); //convert to lowercase 
    //end() = get last piece of data (e.g JPEG)

    $allowed = array('jpg','jpeg','png','pdf');  //type of files to allow in website

    //check if file is allowed to be uploaded(if it has proper extensions)
    if(in_array($fileActualExt,$allowed)){

        //check for errors during upload
        if($fileError === 0){

            //check for file size
            if($fileSize < 500000){   //500000 kb = 500 mb

                //-------Finally,upload the file--------

                //make sure the file has a unique(random) name (to prevent overridden)
                $fileNameNew = uniqid('',true).".".$fileActualExt; //make sure to add the extension to the new file name
                

                //-----now, where to upload the file inside root folder------
                
                //------we can upload to another folder or database----------
                $fileDestination = 'up/'.$fileNameNew; //location, plus, name of file
                
                //function to upload file
                move_uploaded_file($fileTmpName,$fileDestination);
                //param - temp location of file,upload location of file
                
                header("Location: fileIm.php?uploadsuccess");             

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