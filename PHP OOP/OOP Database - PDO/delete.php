<?php
ob_start();
include "classess/crud.class.php";
include "classess/valid.class.php";


$valid = new Validate(); //for validation class
$db = new Crud();

if (isset($_POST['submit'])) {
    //mysqli_real_escape_string() is not needed in PDO. PDO is very strong
    $id = $valid->validate_data($_POST['id']);

    //call the query in delete class--------
    echo $db->deleteUsers($id);
    //echo $db->insertUsers($first, $username, $email, $passwordHash);
}

echo $db->closeConnection(); //close the connection
ob_end_flush();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Delete</title>
    <link rel="stylesheet" href="" type="text/css">
</head>

<body>
    <h1 style='text-align:center'>Information in users Table</h1>

    <?php

    //$db = new Users();
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

        echo $db->Get_Users_Delete();

        echo "</table>";
        echo "</div>";
    } else {
        echo "<h1>There is no data in table</h1>";
    }

    echo $db->closeConnection(); //close off the connection
    ?>

<?php
    //success messages
    if (isset($_GET['delete'])) {
        if ($_GET['delete'] == 'success') {
            echo "<p style='color:green;font-size:30px'>Record Deleted Successfully!</p>";
        }
    }
    ?>

</body>

</html>
