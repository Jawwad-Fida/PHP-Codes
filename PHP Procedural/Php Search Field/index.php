<?php
include "connect.php";

?>


<!DOCTYPE html> <!-- -->
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Search Field</title>
        <link rel="stylesheet" href="style.css" type="text/css">
    </head>

    <body>
        <form action="search.php" method="post">

            <input type="text" name="search" placeholder="search">
            <button type="submit" name="submit-search">Search</button>

        </form>

        <h1>Front page</h1>
        <h2>All articles:</h2>

        <!-------list all articles from database---------->
        <div class="article-container">

            <?php
            $sql="SELECT * from article";
            $result = mysqli_query($conn,$sql);
            $queryResults = mysqli_num_rows($result);

            if($queryResults > 0){
                while($row = mysqli_fetch_assoc($result)){

                    //get all data from database
                    echo "<div class='article-box'>
                    <h3>".$row['a_title']."</h3>
                    <p>".$row['a_text']."</p>
                    <p>".$row['a_date']."</p>
                    <p>".$row['a_author']."</p>
                    </div>";
                }
            }

            ?>

        </div>


    </body>

</html>
