<!DOCTYPE html>
<html lang="en"> <!-- -->
    <head>
        <meta charset="utf-8">
        <title>Calculator</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    
    <body>
        <!--build a FORM for the calculator -->
        <!--we will take 2 inputs -->
        <form>
            <input type="text" name="num1" placeholder="Enter 1st number">
            
            <input type="text" name="num2" placeholder="Enter 2nd number">
            
            <label for="perform">Choose an option:</label>
            <select name="operator"> 
               <!-- Creates a drop down menu to select options-->
                <option>None</option>
                <option>Add</option>
                <option>Subtract</option>
                <option>Multiply</option>
                <option>Divide</option>
                
            </select>
            
            <br>
            
        <!-- create a button (to hit something)-->
            <button type="submit" name="submit" value="submit">Calculate</button>
            
        </form>
        <p>The answer is: - </p>
        
        <!-- now we need to fetch information from srver using php-->
        <!-- checking inside url-->
        <?php
        //if the button was hit - isset()
        if(isset($_GET['submit'])){ 
            //$_GET = get information from url
            
            $result1=$_GET['num1']; //get num1 from url(server)
            $result2=$_GET['num2'];
            $operator=$_GET['operator'];
            
             //what to do with this information?
            switch($operator)
            {
                case "None":
                    echo "Select a method";
                    break;
                    
                case "Add":
                    echo $result1+$result2;
                    break;
                    
                case "Subtract":
                    echo $result1-$result2;
                    break;
                    
                case "Multiply":
                    echo $result1*$result2;
                    break;
                    
                case "Divide":
                    echo $result1/$result2;
                    break;
                    
            }
            
            
        } 
        
       

        
        
        ?>
        
        
    </body>
    
    
</html>