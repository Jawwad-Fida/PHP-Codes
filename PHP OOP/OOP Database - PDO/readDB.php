<?php
include "classess/crud.class.php";
//include "includes/autoloader.inc.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Information in users table</title>
    <link rel="stylesheet" href="" type="text/css">
</head>

<body>
    <h1 style='text-align:center'>Information in users Table</h1>

    <?php

    $db = new Crud;
    $rowNumber = $db->rowNumber();

    //check if table has any data
    if ($rowNumber > 0) {
        //if true, then fetch the data in the form of an associative array

        //fetch data from the database and display them as a table (e.g.)
        echo "<div class='col-xs-6'>";
        echo "<table class='table table-bordered table-hover'>";
        echo ' <thead>
    <tr>
        <th>ID</th>
        <th>FIRST NAME</th>
        <th>USERNAME</th>
        <th>E-mail</th>
        <th>Password</th>  
    </tr>
    </thead>';

        echo $db->getUsers();

        echo "</table>";
        echo "</div>";
    } else {
        echo "<h1>There is no data in table</h1>";
    }

    echo $db->closeConnection(); //close off the connection
    ?>

</body>

</html>