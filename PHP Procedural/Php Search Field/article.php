<?php
include "connect.php";

?>


<!DOCTYPE html> <!-- -->
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Article</title>
        <link rel="stylesheet" href="style.css" type="text/css">
    </head>

    <body>

        <h1>Article page</h1>

        <div class="article-container">

            <?php

            function validate($data){
                $data = trim($data);
                $data = stripcslashes($data);
                $data = htmlspecialchars($data);

                return $data;
            }

            $title=$date="";
            
            //check if we are getting data from url
            if(isset($_GET['id'])){
                
                //get data from url
                $title = validate($_GET['title']);
                $title = mysqli_real_escape_string($conn,$title);

                $date = validate($_GET['date']);
                $date = mysqli_real_escape_string($conn,$date);

                //get only one article from database
                $sql="SELECT * from article WHERE a_title='$title' AND a_date='$date'";
                $result = mysqli_query($conn,$sql);
                $queryResults = mysqli_num_rows($result);

                if($queryResults > 0){
                    while($row = mysqli_fetch_assoc($result)){

                        //get data from database
                        echo "
                    <div class='article-box'>

                    <h3>".$row['a_title']."</h3>
                    <p>".$row['a_text']."</p>
                    <p>".$row['a_date']."</p>
                    <p>".$row['a_author']."</p>

                    </div>
                    ";
                    }
                }
            }

            ?>

        </div>


    </body>

</html>





