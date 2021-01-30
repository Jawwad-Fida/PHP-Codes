<?php

include "connect.php";
session_start();

//get session id from currently logged in user
$sessionid=$_SESSION['id']; //works only when logged in

//--------delete file(profile image)-----

//------imp code--------

//pinpoint the location of the file and its extension
$filename = "up/profile".$sessionid."*"; //get file name  //"*" means all

$fileinfo = glob($filename); //glob() - searches for file
//glob() returns an array

$fileext = explode(".",$fileinfo[0]); //2 parameters - where to explode, which string to explode. explode yields an =array
//$fileext now contains the extension
//$fileinfo[0] - file name
//$fileinfo[1] - file extension (e.g. jpg)

$fileactualext=$fileext[1]; //place extension here

$file = "up/profile".$sessionid.".".$fileactualext; //join the extension, and NOW WE HAVE THE ACTUAL FILE NAME

//------NOW TO DELETE THE FILE-----

//unlink() - delete file
if(!unlink($file)){
    echo "File was not deleted";
}
else{
    echo "File deleted successfully";
    //these errors wont show if we go back to front page using header
}


//go inside database and update profileimage table
//at the moment = (session=0)true. change it to false(session=1) because of deletion
$sql = "UPDATE profileimg SET status=1 WHERE userid='$sessionid';";
mysqli_query($connection,$sql);
header("Location: index.php?deletesuccess");



?>