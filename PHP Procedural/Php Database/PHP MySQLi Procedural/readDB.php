<?php
include "connect.php";

//CHECKING FOR DATA and READING (PRINTING) DATA in Database
$sql = "SELECT * FROM users;"; //sql statement

//Query the code
$result = mysqli_query($conn,$sql);

$resultCheck = mysqli_num_rows($result); //store number of rows

if($resultCheck > 0){
    while($row = mysqli_fetch_assoc($result)){ //read information from table in database
        print_r($row) ."<br>";
        echo "<br>";
        echo "<br>";
        
    }
}

mysqli_close($conn);

?>