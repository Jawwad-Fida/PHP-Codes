<?php
include "connect.php";
include "functions.php";

 if(isset($_POST['submit'])) {
DeleteRows();
 }
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Delete Form</title>
        <link rel="stylesheet" href="style.css" type="text/css">
    </head>

    <body>
        <h1>DELETE ROW </h1>

        <form method="post" action="deleteForm.php"> 

            <!-- (NEW) (select tag)  
          DROP DOWN MENU to pick up id from database-->
          
             <!-- name="id" in  select tag, because we need this value to pass from form -->
             
             <select name="id" id="">
                <?php 
                showAllData(); //in functions.php
                  ?>
             </select>

            <button type="submit" style='color:blue' name="submit">Delete</button>
        </form>

    </body>
</html>


