<?php
include "connect.php";

$sql = "SELECT * FROM users;";
$result = mysqli_query($conn,$sql);
$resultCheck = mysqli_num_rows($result);

if($resultCheck > 0){
    //fetch data from table in database
    while($row = mysqli_fetch_assoc($result)){
        //$row becomes an associative array
        print_r($row) ."<br>";
        echo "<br>";
        echo "<br>";
    }
}

mysqli_close($conn);


?>