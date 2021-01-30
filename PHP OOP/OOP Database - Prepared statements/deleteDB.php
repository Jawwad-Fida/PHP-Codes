<?php
ob_start();
include "connect.php";

function validate($data)
{
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);

    return $data;
}

//id is initialized by clicking on button
if (isset($_POST['submit'])) {

    $id = $_POST['id'];

    //Delete From Database using oop procedural
    $sql = "DELETE FROM users WHERE user_id=?";

    //prepare statement
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        //Bind variables to the prepared statements
        $stmt->bind_param("i", $id);

        //execute the prepared statement
        $stmt->execute();

        header("Location: deleteDB.php?delete=success");
        $stmt->close();
    } else {
        echo "Error in deleting record " . $conn->connect_error;
    }
}

//$conn->close();
ob_end_flush();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Delete</title>
    <link rel="stylesheet" href="style2.css" type="text/css">
</head>

<body>

    <?php
    //messages
    if (isset($_GET['delete'])) {
        if ($_GET['delete'] == 'success') {
            echo "<p style='color:green;font-size:30px'>Record Deleted Successfully!</p>";
        }
    }
    ?>

    <?php

    $sql = "SELECT * FROM users";
    $result = $conn->query($sql); //run a query
    $rowNumber = $result->num_rows; //fetch no. of data from database

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

        //we will delete by pressing a button
        while ($row = $result->fetch_assoc()) {
            //echo $row['user_id'] ." " .$row['user_first'] ." " .$row['user_name'] ." " .$row['user_email'] ." " .$row['user_pwd'] ."<br>";

            echo "  <tbody>
        <tr>
            <td>{$row['user_id']}</td>
            <td>{$row['user_first']}</td>
            <td>{$row['user_uid']}</td>
            <td>{$row['user_email']}</td>
            <td>{$row['user_pwd']}</td>

           <td><form action='deleteDB.php' method='post'>
        <input type='hidden' name='id' value='{$row['user_id']}'>
        <button type='submit' name='submit'>Delete</button>
    </form></td> 

        </tr>
    </tbody>";
        }
        echo "</table>";
        echo "</div>";
    } else {
        echo "<h1>There is no data in table</h1>";
    }

    //id is initialized by clicking on button

    $conn->close();

    ?>

</body>

</html>