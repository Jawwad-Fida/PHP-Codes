<?php
//declared on top (Global)
//flag variables declared for required field (errors)
$errname = $errmail = $errweb = $errgender = "";

//IMPORTANT Tip: - It is better to keep php block above html block  
$name = $email = $website = $comment = $gender = "";

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    
    //we will check the required field
    if(empty($_POST["name"])) //if name is empty, print error msg
    {
        $errname = "<span style='color:red'>Name is required</span>";
    }
    else
    {
        //variable is not empty, then validate data
        $name = validate($_POST["name"]);
    }
    

    if(empty($_POST["email"]))
    {
        $errmail = "<span style='color:red'>E-mail is required</span>";
    }
    elseif(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))
    {
        // safest way to check whether an email address is well-formed is to use PHP's filter_var() function
       $errmail = "<span style='color:red'>Invalid email format</span>";  
    }
    else
    {
        $email = validate($_POST["email"]);
    }
    

    if(empty($_POST["website"]))
    {
        $errweb = "<span style='color:red'>Website is required</span>";
    }
    elseif(!filter_var($_POST["website"], FILTER_VALIDATE_URL))
    {
        // same way to check format of url //correct - http://....
       $errweb = "<span style='color:red'>Invalid URL format</span>";  
    }
    else
    {
        $website = validate($_POST["website"]);
    }
    

    $comment = validate($_POST["comment"]);

    
    if(empty($_POST["gender"]))
    {
        $errgender = "<span style='color:red'>Gender is required</span>";
    }
    else
    {
        $gender = validate($_POST["gender"]);
    }

}


function validate($data)
{
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data); 
    return $data;
}

?>


<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Work Session</title>
    </head>

    <body>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">

            <table>

                <!-- making a required field-->
                <!-- using * -->

                <p style="color:red">* required field</p>

                <tr>
                    <td>Name</td>
                    <td><input type="text" name="name" >*<?php echo $errname; ?></td> <!-- show output by php (required field) -->
                </tr>

                <tr>
                    <td>Email</td>
                    <td><input type="email" name="email">*<?php echo $errmail; ?></td>
                </tr>

                <tr>
                    <td>Website</td>
                    <td><input type="text" name="website">*<?php echo $errweb; ?></td>
                </tr>

                <tr>

                    <td>Comment</td>
                    <td><textarea name="comment" rows="5" cols="50"></textarea></td>
                </tr>

                <tr>

                    <td>Gender</td>
                    <td>
                        <input type="radio" name="gender" value="female">Female
                        <input type="radio" name="gender" value="male">Male
                        *<?php echo $errgender; ?>
                    </td>
                </tr>

                <tr>
                    <td></td>
                    <td><input type="submit" name="submit" value="Submit"></td>

                </tr>

            </table>

        </form>

    </body>


</html>