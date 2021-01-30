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

if (isset($_POST['submit'])) {

    $id = $_POST['id'];

    $first = validate($_POST['first']);
    $first = mysqli_real_escape_string($conn, $first);

    $username = validate($_POST['uid']);
    $username = mysqli_real_escape_string($conn, $username);

    $email = validate($_POST['email']);
    $email = mysqli_real_escape_string($conn, $email);

    $password = validate($_POST['pwd']);
    $password = mysqli_real_escape_string($conn, $password);

    //Hashing the password
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    //Update Database using oop procedural
    $sql = "UPDATE users
    SET user_first=?, user_pwd=?
    WHERE user_id=?";

    //prepare statement
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        //Bind variables to the prepared statements
        $stmt->bind_param("ssi",$first,$passwordHash,$id);

        //execute the prepared statement
        $stmt->execute();

        header("Location: updateDB.php?update=success");
        $stmt->close();
    } else {
        echo "Error in deleting record " . $conn->connect_error;
    }
}

$conn->close();
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

<?php
    //messages
    if (isset($_GET['update'])) {
        if ($_GET['update'] == 'success') {
            echo "<p style='color:green;font-size:30px'>Record Updated Successfully!</p>";
        }
    }
    ?>


    <form action="updateDB.php" method="post">
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

        <select name='id'>
            <?php
            include "showDB.php";
            ?>
        </select>

        <button type="submit" name="submit">Update Account</button>
    </form>

</body>

</html>