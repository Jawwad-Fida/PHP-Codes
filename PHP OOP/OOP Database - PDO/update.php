<?php
ob_start();
include "classess/crud.class.php";
include "classess/valid.class.php";

$valid = new Validate(); //for validation class
$db = new Crud();

if (isset($_POST['submit'])) {
    //mysqli_real_escape_string() is not needed in PDO. PDO is very strong
    $id = $valid->validate_data($_POST['id']);
    $username = $valid->validate_data($_POST['uid']);
    $password = $valid->validate_data($_POST['pwd']);

    //Hashing the password
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    //checking for errors
    echo $valid->checkEmpty_Update($username, $password);

    //call the query in insert class--------
    echo $db->updateUsers($username, $passwordHash, $id);
}

echo $db->closeConnection(); //close the connection
ob_end_flush();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Update</title>
    <link rel="stylesheet" href="style2.css" type="text/css">
</head>

<body>

    <form action="update.php" method="post">
        <p>Username
            <input type="text" name="uid" placeholder="Enter your username">
        </p>
        <p>Password
            <input type="password" name="pwd" placeholder="Enter your password">
        </p>

        <select name='id'>
            <?php
            $db->showAllId();
            ?>
        </select>

        <button type="submit" name="submit">Update Account</button>
    </form>

    <?php
    //error messages
    if (isset($_GET['error'])) {
        if ($_GET['error'] == 'emptyfields') {
            echo "<p style='color:red;font-size:30px'>Please fill in all the fields!</p>";
        }
    }
    ?>

    <?php
    //success messages
    if (isset($_GET['update'])) {
        if ($_GET['update'] == 'success') {
            echo "<p style='color:green;font-size:30px'>Record Updated Successfully!</p>";
        }
    }
    ?>

</body>

</html>