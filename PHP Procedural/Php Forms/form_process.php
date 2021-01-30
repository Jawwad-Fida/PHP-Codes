 <?php
//collecting data with a superglobal variable
 //$_POST = for picking up data sent by forms (in post format)
//data (from form) is collected as an associative array(data become values)

//$_POST is an associative array
//checking if a value in array is set
if(isset($_POST['submit'])){ 
    
    //echo "Yess "; //checking if the value received works
    
    //if form was submitted, lets grab the data and store it
    $username = $_POST['username'];
    $password = $_POST['password'];
    
   // echo "Hello" .$username ." ";
    //echo "Your password is " .$password;
    
    //topic - validating data (checking) e.g.
    $min=5; 
    if(strlen($username) < $min){
        echo "Username has to be longer";
    }
    
    $name=array("Edwin", "Student", "Peter", "Samid", "Mohad", "Maria", "James", "Tom");
    //instead of array, usually a database
    //check if user is inside (if inside-log in)
    if(!in_array($username,$name)){
        echo "sorry. u are not allowed";
    }
        else{
            echo "Welcome";
        }      
    
    
}

        
 ?>