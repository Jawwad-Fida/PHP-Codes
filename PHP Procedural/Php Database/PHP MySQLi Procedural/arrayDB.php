<?php
include "connect.php";

//select data from database
$sql = "SELECT * FROM users;";

$result = mysqli_query($conn,$sql); //Query the code

$numOfRows = mysqli_num_rows($result); //store number of rows

$datas = array();

if($numOfRows > 0){
    while($row = mysqli_fetch_assoc($result)){ //read information from table in database
        
        //$row becomes an associative array
        $datas[] = $row; //insert data from database into array. (Array with array)
    }
}

//print_r($datas);

foreach($datas as $data){
    echo $data['user_pwd']; 
    //loops through the database to find a column called user_pwd and get all data
}

echo "<br>";

foreach($datas[0] as $data){ //loop through first row
    echo $data; 
    //loops through the database to find a column called user_pwd and get all data
}

echo "<br>";


?>