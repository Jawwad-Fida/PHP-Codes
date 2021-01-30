<?php
ob_start();
include "classess/crud.class.php";
include "classess/valid.class.php";

$valid = new Validate(); //for validation class
$db = new Crud();

if (isset($_POST['submit'])) {
    //mysqli_real_escape_string() is not needed in PDO. PDO is very strong
    $first = $valid->validate_data($_POST['first']);
    $username = $valid->validate_data($_POST['uid']);
    $email = $valid->validate_data($_POST['email']);
    $password = $valid->validate_data($_POST['pwd']);

    //Hashing the password
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    //checking for errors
    echo $valid->checkEmpty($username,$password);

    //call the query in insert class--------
    echo $db->insertUsers($first, $username, $email, $passwordHash);
}

echo $db->closeConnection(); //close the connection
ob_end_flush();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Insert</title>
    <link rel="stylesheet" href="style2.css" type="text/css">
</head>

<body>

    <form action="insert.php" method="post">
        <p>First Name
            <input type="text" name="first" placeholder="Enter your first name">
        </p>
        <p>Username
            <input type="text" name="uid" placeholder="Enter your username">
        </p>
        <p>E-mail
            <input type="email" name="email" placeholder="Enter your email">
        </p>
        <p>Password
            <input type="password" name="pwd" placeholder="Enter your password">
        </p>
        <button type="submit" name="submit">Create Account</button>
    </form>

    <?php
    //success messages
    if (isset($_GET['input'])) {
        if ($_GET['input'] == 'success') {
            echo "<p style='color:green;font-size:30px'>Record Created Successfully!</p>";
        }
    }
    ?>

    <?php
    //error messages
    if (isset($_GET['error'])) {
        if ($_GET['error'] == 'emptyfields') {
            echo "<p style='color:red;font-size:30px'>Please fill in all the fields!</p>";
        }
    }
    ?>

</body>

</html>