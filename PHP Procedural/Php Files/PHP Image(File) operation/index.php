<?php
include "connect.php";
session_start(); //sessions needed for login and logout
?>

<!-- Uploading Profile Images to users-->

<!DOCTYPE html> <!-- -->
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title></title>
        <link rel="stylesheet" href="style.css" type="text/css">
    </head>

    <body>

        <?php
        //select users from database
        $sql = "SELECT * FROM users";
        // mysqli_query() - run inside database
        $result = mysqli_query($connection,$sql); 


        //check if users are available in db
        if(mysqli_num_rows($result) > 0){
            //fetch data from database
            while($row = mysqli_fetch_assoc($result)){

                $id = $row['id']; //get user id from table 1
                //now, check in table 2 whether the user has uploaded any profile image
                $sqlImg = "SELECT * FROM profileimg WHERE userid='$id'";
                $resultImg = mysqli_query($connection,$sqlImg);

                //now we have data from both tables in database
                while($rowImg = mysqli_fetch_assoc($resultImg)){
                    echo '<div class="user-container">';
                    //check status of image_type_to_extension
                    if($rowImg['status'] == 0){
                        $filename = "up/profile".$id."*"; 
                        $fileinfo = glob($filename); 
                        $fileext = explode(".",$fileinfo[0]); 
                        $fileactualext=$fileext[1];


                        //image uploaded
                        echo '<img src="up/profile'.$id.'.'.$fileactualext.'?'.mt_rand().'">';
                        //output image of person
                        //(---IMP---)'.$id.' = we cannot use variables directly inside a string, so we need to seperate php and string
                        //mt_rand() = get a random number. Browser remembers profile image. So if we want to upload another profile pic, we can change the existing one
                    }
                    else{
                        //image not uploaded, default image
                        echo '<img src="up/profiledefault.jpg">';
                    }
                    echo "</p>" .$row['username'] ."</p>"; //output username of person
                    echo '</div>';

                }


            }
        }
        else{
            echo "There are no users inside database";
            echo "<br>";
        }

        

        //------------------------------1st part------------------------------
        
        //check if we are logged in
        if(isset($_SESSION['id'])){

            //check if we are logged in as correct user
            if(isset($_SESSION['id']) == 1){
                echo "You are logged in as user 1 from database";
                echo "<br>";
            }

            //when logged in, only then we can upload a profile image

            //image upload form (seen only when logged in)
            echo '<form action="uploadImg.php" method="post" enctype="multipart/form-data">
            <input type="file" name="file">
            <button type="submit" name="submit">Upload</button>
            </form>';

            //delete files form
            echo '<form action="deleteImg.php" method="post">
            <button type="submit" name="submit">Delete profile Image</button>
            </form>';

        }
        else{
            echo "You are not logged in";
            echo "<br>";

            //sign up form 
            echo '<form action="signup.php" method="post">
            <input type="text" name="first" placeholder="First name">
            <input type="text" name="last" placeholder="Last name">
            <input type="text" name="uid" placeholder="Username">
            <input type="password" name="pwd" placeholder="Password">
            <button type="submit" name="submitSignup">Sign up</button>
            </form>';
        }

        ?>


        <p>Login as user!</p>
        <form action="login.php" method="post">
            <button type="submit" name="submitLogin">Login</button>
        </form>

        <p>Logout as user!</p>
        <form action="logout.php" method="post">
            <button type="submit" name="submitLogout">Logout</button>
        </form>


    </body>
</html>