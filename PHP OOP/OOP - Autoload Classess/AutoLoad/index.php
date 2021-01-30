<?php
include 'includes/autoloader.inc.php'; //we just to include this one file once in very document

//automatically grabs the file that we need to use when we instantiate the class
$person1 = new Person("Fida",22);
echo $person1->getPerson() ."<br>";

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="" type="text/css">
</head>

<body>


</body>
</html>