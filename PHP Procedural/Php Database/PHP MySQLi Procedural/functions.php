<head>
    <meta charset="utf-8">
    <script src="https://code.jquery.com/jquery-3.0.0.js"></script> <!-- include jquery -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> <!-- include sweet alert -->
    <!-- 
a)You can download sweetalert and jquery files seperately, and then link the file path. OR
b)Keep updating the link from online
-->
</head>

<?php
//THIS FILE HAS MANY IMPORTANT FUNCTIONS: - (MYSQL and PHP)
//a)Insert form data into table in database (row creation)
//b)show all data - just like readDb.php
//c)update row in a table in database
//d)delete row in table in database(example done based on user id)
//e)form validation
//f)password encryption - hashing

//NOTE: - all the functions above have their own forms

include "connect.php";

$first=$last=$user=$email=$password="";

function validate($data){ //function to validate form data
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);

    return $data;

}

function InsertData(){

    //check if user has clicked submit button
    if(isset($_POST['submit'])){

        global $conn; //make sure the connection variable is global


        //prevent sql injection and form validation
        $first = validate($_POST['first']);
        $first = mysqli_real_escape_string($conn,$first);

        $last = validate($_POST['last']);
        $last = mysqli_real_escape_string($conn,$last);

        $email = validate($_POST['email']);
        $email = mysqli_real_escape_string($conn,$email);

        $user = validate($_POST['uid']);
        $user = mysqli_real_escape_string($conn,$user);

        $password = validate($_POST['pwd']);
        $password = mysqli_real_escape_string($conn,$password);

        //-------Error handling----
        //check if inputs are empty
        if(empty($first) || empty($last) || empty($email) || empty($user) || empty($password)){
            header("Location: form.php?signup=empty"); 
            exit(); 
        }
        else{ //not empty
            //Check if input characters are valid
            if(!preg_match("/^[a-zA-Z]*$/",$first) || !preg_match("/^[a-zA-Z]*$/",$last)){
                header("Location: form.php?signup=char");
                exit(); //completely terminates program(not like break)
            }
            else{
                //Check if email is valid
                if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                    header("Location: form.php?signup=email");
                    exit(); 
                }
            }
        }

        //-------Password Encryption (Hashing)----//
        $password = password_hash($password,PASSWORD_DEFAULT);

        //-----------MySQL AND PHP --------------------

        //Checking if a DUPLICATE email already exists
        $sql = "SELECT * FROM users WHERE user_email='$email';"; 
        $result = mysqli_query($conn,$sql);
        $resultCheck = mysqli_num_rows($result); //store number of rows

        if($resultCheck > 0){
            header("Location: form.php?emailexists");
            exit();    
        }

        //Checking if a DUPLICATE username exists
        $sql = "SELECT * FROM users WHERE user_uid='$user';"; 
        $result = mysqli_query($conn,$sql);
        $resultCheck = mysqli_num_rows($result); //store number of rows

        if($resultCheck > 0){
            header("Location: form.php?userexists");
            exit();    
        }


        //INSERT FORM DATA INTO TABLE IN DATABASE
        $sql = "INSERT INTO users(user_first,user_last,user_email,user_uid,user_pwd) VALUES('$first','$last','$email','$user','$password');";

        if(mysqli_query($conn,$sql)){ //QUERING THE CODE (IMP) - for database
            //sweet alert and jquery - successful message
            echo '
            <script type="text/javascript">
            $(document).ready(function(){

            swal({
            position: "top-end",
            title: "Created successfully",
            text: "You clicked the button!",
            icon: "success",
            button: "Done!",
            showConfirmButton: false,
            timer: 5000
            })
            });
            </script>';
        }
        else{
            die("Error updating record: " .mysqli_error($conn));
        }

    }
    
    mysqli_close($conn); //better to close the database connection (safe)
}


//Just like reading, we will show all data
function showAllData(){

    global $conn; //make sure the connection variable is global

    $sql = "SELECT * FROM users;"; 
    $result = mysqli_query($conn,$sql);
    $resultCheck = mysqli_num_rows($result); 

    //except,here we will pick id's from table in DB
    if($resultCheck > 0){
        while($row = mysqli_fetch_assoc($result)){
            $id = $row['user_id']; //pick ids
            echo "<option value='$id'>$id</option>";
        }
    }
}



//UPDATE DATA IN TABLE IN DATABASE 
function UpdateTable() {

    if(isset($_POST['submit'])) {

        global $conn;

        //prevent sql injection and form validation
        $first = validate($_POST['first']);
        $first = mysqli_real_escape_string($conn,$first);

        $last = validate($_POST['last']);
        $last = mysqli_real_escape_string($conn,$last);

        $email = validate($_POST['email']);
        $email = mysqli_real_escape_string($conn,$email);

        $user = validate($_POST['uid']);
        $user = mysqli_real_escape_string($conn,$user);

        $password = validate($_POST['pwd']);
        $password = mysqli_real_escape_string($conn,$password);

        $id = validate($_POST['id']);
        $id = mysqli_real_escape_string($conn,$id);

        //-------Error handling----
        //check if inputs are empty
        if(empty($first) || empty($last) || empty($email) || empty($user) || empty($password)){
            header("Location: updateForm.php?signup=empty"); 
            exit(); 
        }
        else{ //not empty
            //Check if input characters are valid
            if(!preg_match("/^[a-zA-Z]*$/",$first) || !preg_match("/^[a-zA-Z]*$/",$last)){
                header("Location: updateForm.php?signup=char");
                exit(); //completely terminates program(not like break)
            }
            else{
                //Check if email is valid
                if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                    header("Location: updateForm.php?signup=email");
                    exit(); 
                }
            }
        }

        //-------Password Encryption (Hashing)----//
        $password = password_hash($password,PASSWORD_DEFAULT);

        //Checking if a DUPLICATE email already exists
        $sql = "SELECT * FROM users WHERE user_email='$email';"; 
        $result = mysqli_query($conn,$sql);
        $resultCheck = mysqli_num_rows($result); //store number of rows

        if($resultCheck > 0){
            header("Location: updateForm.php?emailexists");
            exit();    
        }

        //Checking if a DUPLICATE username exists
        $sql = "SELECT * FROM users WHERE user_uid='$user';"; 
        $result = mysqli_query($conn,$sql);
        $resultCheck = mysqli_num_rows($result); //store number of rows

        if($resultCheck > 0){
            header("Location: updateForm.php?userexists");
            exit();    
        }


        //UPDATE DATA IN TABLE
        $sql = "UPDATE users 
        SET user_first='$first', user_last='$last', user_email='$email', user_uid='$user', user_pwd='$password'
        WHERE user_id='$id';";

        if( mysqli_query($conn,$sql)){ //QUERING THE CODE (IMP) - for database
            //sweet alert and jquery - successful message
            echo '
            <script type="text/javascript">
            $(document).ready(function(){

            swal({
            position: "top-end",
            title: "Updated successfully",
            text: "You clicked the button!",
            icon: "success",
            button: "Done!",
            showConfirmButton: false,
            timer: 5000
            })
            });
            </script>';
        }
        else{
            die("Error updating record: " .mysqli_error($conn));
        }

    }
    mysqli_close($conn);
}


//DELETE ROWS IN TABLE IN DATABASE
function DeleteRows() {

    if(isset($_POST['submit'])) {

        global $conn;

        //prevent sql injection and form validation
        $id = validate($_POST['id']);
        $id = mysqli_real_escape_string($conn,$id);

    }


    //DELETE ROWS
    $sql = "DELETE FROM users 
    WHERE user_id='$id';";

    if( mysqli_query($conn,$sql)){ //QUERING THE CODE (IMP) - for database
        //sweet alert and jquery - successful message
        echo '
            <script type="text/javascript">
            $(document).ready(function(){

            swal({
            position: "top-end",
            title: "Deleted successfully",
            text: "You clicked the button!",
            icon: "success",
            button: "Done!",
            showConfirmButton: false,
            timer: 5000
            })
            });
            </script>';
    }
    else{
        die("Error deleting record: " .mysqli_error($conn));
    }
    
    mysqli_close($conn);

}



?>
