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

    //Delete From Database using oop procedural
    $sql = "DELETE FROM users WHERE user_id='$id'";
    if($conn->query($sql) === true){
        header("Location: deleteDB.php?delete=success");
    }
    else{
        echo "Error in creating record " .$conn->connect_error;
    }

}

$conn->close();
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

    <form action="deleteDB.php" method="post">
       
        <select name='id'>
            <?php
            include "showDB.php";
            ?>
        </select>

        <button type="submit" name="submit">Delete</button>
    </form>

    <?php
    //messages
    if(isset($_GET['delete'])){
        if($_GET['delete'] == 'success'){
            echo "<p style='color:green;font-size:30px'>Record Deleted Successfully!</p>";
        }
    }
    ?>

</body>
</html>