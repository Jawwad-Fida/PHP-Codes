<?php
//.class or .inc is just a normal extension for naming purposes
include "classess/connect.class.php";

//--------THIS CLASS contains all operations of (CRUD) - Read, Insert, Delete, Update and others for users table in database

class Crud extends dbh
{

    //-------------------READ DATA---------------------

    //get all data from users table
    public function getUsers()
    {
        try {
            $sql = "SELECT * FROM users";

            //$this is refering to pdo object in connect() method, and storing it in $stmt
            $stmt = $this->connect()->query($sql); //store query using pdo

            //fetch data in the form of associative array
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                //fetch gets only one row (so loop to get data one at a time)
                echo "  <tbody>
        <tr>
            <td>{$row['user_id']}</td>
            <td>{$row['user_first']}</td>
            <td>{$row['user_uid']}</td>
            <td>{$row['user_email']}</td>
            <td>{$row['user_pwd']}</td>
        </tr>
    </tbody>";
            }
            unset($stmt); //close off the statement
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    //get row number
    public function rowNumber()
    {
        $sql = "SELECT * FROM users";
        $stmt = $this->connect()->query($sql);
        $row = $stmt->fetchAll(); //fetch all the rows
        $rowNumber = count($row); //then count them
        return $rowNumber;
    }

    //--------------------INSERT -------------------

    //insert using prepared statements
    public function insertUsers($first, $username, $email, $password)
    {
        try {
            $sql = "INSERT INTO users(user_first,user_uid,user_email,user_pwd) VALUES(?,?,?,?)";

            //$this is refering to pdo object in connect() method, and storing it in $stmt
            $stmt = $this->connect()->prepare($sql);

            //Bind parameters to the statement (one at a time in PDO)
            $stmt->bindParam(1, $first, PDO::PARAM_STR);
            $stmt->bindParam(2, $username, PDO::PARAM_STR);
            $stmt->bindParam(3, $email, PDO::PARAM_STR);
            $stmt->bindParam(4, $password, PDO::PARAM_STR);

            //execute
            $stmt->execute();
            unset($stmt); //close off the statement
            header("Location: insert.php?input=success");
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    //------------------DELETE-------------------

    //Delete users by pressing button. user_id will be initialized once button is pressed
    public function Get_Users_Delete()
    {
        //has the form for delete
        try {
            $sql = "SELECT * FROM users";
            $stmt = $this->connect()->query($sql);

            //fetch data in the form of associative array
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                //fetch gets only one row (so loop to get data one at a time)
                echo "  <tbody>
        <tr>
            <td>{$row['user_id']}</td>
            <td>{$row['user_first']}</td>
            <td>{$row['user_uid']}</td>
            <td>{$row['user_email']}</td>
            <td>{$row['user_pwd']}</td>

            <td>
            <form action='delete.php' method='post'>
        <input type='hidden' name='id' value='{$row['user_id']}'>
        <button type='submit' name='submit'>Delete</button>
            </form>
            </td> 

        </tr>
    </tbody>";
            }
            unset($stmt); //close off the statement
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    //delete using prepared statements
    public function deleteUsers($id)
    {
        try {
            $sql = "DELETE FROM users WHERE user_id=?";

            //$this is refering to pdo object in connect() method, and storing it in $stmt
            $stmt = $this->connect()->prepare($sql);

            //Bind parameters to the statement
            $stmt->bindParam(1, $id, PDO::PARAM_INT);

            //execute
            $stmt->execute();
            unset($stmt); //close off the statement
            header("Location: delete.php?delete=success");
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    //-------------------UPDATE---------------

    //update using prepared statements
    public function updateUsers($username, $password,$id)
    {
        try {
            $sql = "UPDATE users
            SET user_uid=?, user_pwd=?
            WHERE user_id=?";
        
            //$this is refering to pdo object in connect() method, and storing it in $stmt
            $stmt = $this->connect()->prepare($sql);

            //Bind parameters to the statement (one at a time in PDO)
            $stmt->bindParam(1, $username, PDO::PARAM_STR);
            $stmt->bindParam(2, $password, PDO::PARAM_STR);
            $stmt->bindParam(3, $id, PDO::PARAM_INT);

            //execute
            $stmt->execute();
            unset($stmt); //close off the statement
            header("Location: update.php?update=success");
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }














    //---------------OTHER HELPFUL FUNCTIONS-----------------

    public function getUserId($id)
    {
        try {
            $sql = "SELECT * FROM users WHERE user_id=?";
            $stmt = $this->connect()->prepare($sql);

            //Bind parameters
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            $stmt->execute();

            //Another -> fetching is slightly different for prepared statements
            $row = $stmt->fetchAll();

            foreach ($row as $user_id) {
                echo $user_id['user_id'] . "<br>";
            }
            unset($stmt); //close off the statement
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    //get all id from users table - will create a dropdown menu selection
    public function showAllId()
    {
        try {
            $sql = "SELECT * FROM users";
            $stmt = $this->connect()->query($sql);
            $rowNumber = $stmt->rowCount(); //count no.of rows using pdo

            if ($rowNumber > 0) {
                //fetch data in the form of associative array
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    //fetch gets only one row (so loop to get data one at a time)
                    echo "<option value='{$row['user_id']}'>{$row['user_id']}</option>";
                }
            }
            unset($stmt); //close off the statement
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }


}
