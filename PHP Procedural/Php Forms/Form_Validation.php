<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Work Session</title>
    </head>

    <body>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">

            <table>
                <!-- Table = an organized form-->
                 <!-- required = 1 , shows a message if input field is empty-->

                <tr>
                    <td>Name</td>
                    <td><input type="text" name="name" required="1"></td>
                </tr>

                <tr>
                    <td>Email</td>
                    <td><input type="email" name="email" required="1"></td>
                </tr>

                <tr>
                    <td>Website</td>
                    <td><input type="text" name="website" required="1"></td>
                </tr>

                <tr>
                    <!-- text area-->
                    <td>Comment</td>
                    <td><textarea name="comment" rows="5" cols="50"></textarea></td>
                </tr>

                <tr>
                    <!-- Radio button -->
                    <td>Gender</td>
                    <td>
                        <input type="radio" name="gender" value="female">Female
                        <input type="radio" name="gender" value="male">Male
                    </td>
                </tr>
                <!-- All button types should have a value -->
                <tr>
                    <td></td>
                    <td><input type="submit" name="submit" value="Submit"></td>
                    <!-- Value is displayed on website -->
                </tr>

            </table>

        </form>

        <!-- Now to validate with php, we will take a form-->

        <?php
        
        $name = $email = $website = $comment = $gender = "";

        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            //if the server request is post, catch the input data

            $name = validate($_POST["name"]);
            $email = validate($_POST["email"]);
            $website = validate($_POST["website"]);
            $comment = validate($_POST["comment"]);
            $gender = validate($_POST["gender"]);

            
            echo "Name: $name <br>";
            echo "E-mail: $email <br>";
            echo "Website: $website <br>";
            echo "Comment: $comment <br>";
            echo "Gender: $gender";
        }


        //function to validate data in 3 steps (will make form secure on website)
        function validate($data)
        {
            //1) trim() =  remove unnesscary empty space before data
            //2) stripslashes() = remove unnessary backlash
            //3)htmlspecialchars() = to protect data from xss

            $data = trim($data);
            $data = stripcslashes($data);
            $data = htmlspecialchars($data); 
            return $data;
        }






        ?>

    </body>


</html>