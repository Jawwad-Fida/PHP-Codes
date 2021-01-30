<?php

session_start();

//end the session
session_unset(); //all sessions variables are deleted
session_destroy();

header("Location: ../index.php");

?>