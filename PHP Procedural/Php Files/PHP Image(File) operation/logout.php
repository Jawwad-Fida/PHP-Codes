<?php
include "connect.php";
session_start();

//To log out, we must destroy the session
session_unset(); //unset session
session_destroy(); //then destroy it

header("Location: index.php");


?>