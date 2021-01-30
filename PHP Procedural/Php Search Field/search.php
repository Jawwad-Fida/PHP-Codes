<?php
include "connect.php";

?>


<!DOCTYPE html> <!-- -->
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Search page</title>
        <link rel="stylesheet" href="" type="text/css">
    </head>

    <body>

        <h1>Search page</h1>
        <div class="article-container">

            <?php

            function validate($data){
                $data = trim($data);
                $data = stripcslashes($data);
                $data = htmlspecialchars($data);

                return $data;
            }

            $search = "";

            if(isset($_POST['submit-search'])){

                $search = validate($_POST['search']);
                $search = mysqli_real_escape_string($conn,$search);


                //SQL -> LIKE (search for keywords [rather than the whole sentence] [use with '% %' in mysqli] )


                //------checking everything inside databse using $search------
                $sql = "SELECT * FROM article WHERE a_title LIKE '%$search%' OR a_text LIKE '%$search%' OR a_author LIKE '%$search%' OR a_date LIKE '%$search%'";
                $result = mysqli_query($conn,$sql);
                $queryResult = mysqli_num_rows($result);

                //----Show how many search results are there----
                echo "There are " .$queryResult ." results!";

                if($queryResult > 0){
                    while($row = mysqli_fetch_assoc($result)){

                        //------after get search results of a list of articles from database, open the article u want to read by clicking it. Clicking it will open the article on another page.-----
                        echo "<a href='article.php?id=".$row['a_id']."&title=".$row['a_title']."&date=".$row['a_date']."'>

                            <div class='article-box'>

                            <h3>".$row['a_title']."</h3>
                            <p>".$row['a_text']."</p>
                            <p>".$row['a_date']."</p>
                            <p>".$row['a_author']."</p>

                           </div>

                           </a>";

                    }
                }
                else{
                    //No search results
                    echo "There are no results matching your search in database"; 
                }

            }


            ?>

        </div>


    </body>

</html>
