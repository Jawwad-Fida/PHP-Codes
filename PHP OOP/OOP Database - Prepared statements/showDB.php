<?php
include "connect.php";

$sql = "SELECT * FROM users";
$result = $conn->query($sql);
$rowNumber = $result->num_rows;

if($rowNumber>0){
    while($row = $result->fetch_assoc()){
       // $id = $row['user_id'];
        echo "<option value='{$row['user_id']}'>{$row['user_id']}</option>";
    }
}
?>