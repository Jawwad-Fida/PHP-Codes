<?php
include "connect.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Information in users Table</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

</head>

<body>
<h1 style='text-align:center'>Information in users Table</h1>

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

    while ($row = $result->fetch_assoc()) {
        //echo $row['user_id'] ." " .$row['user_first'] ." " .$row['user_name'] ." " .$row['user_email'] ." " .$row['user_pwd'] ."<br>";

        echo "  <tbody>
        <tr>
            <td>{$row['user_id']}</td>
            <td>{$row['user_first']}</td>
            <td>{$row['user_uid']}</td>
            <td>{$row['user_email']}</td>
            <td>{$row['user_pwd']}</td>
        </tr>
    </tbody>";
    }
    echo "</table>";
    echo "</div>";
}
else {
    echo "<h1>There is no data in table</h1>";
}

$conn->close();

?>

</body>
</html>