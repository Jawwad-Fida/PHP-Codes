<?php
include("db_connection.php");
?>

<!DOCTYPE html> <!-- -->
<html lang="en">

<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Customer's Receipt</title>
     <!-- Bootstrap Core CSS -->
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>

<body>

    <div class="col-md-8 order-md-1">
        <h4 class="mb-3" style="text-align: center;font-size: 40px">Search for Customer's Receipt</h4>

        <form action="searchReceipt.php" method="post" class="needs-validation">

            <div class="row">
                <div class="col-md-12 mb-3">

                    <!-- customer_name -->

                    <label for="number">Receipt No./Transaction No.</label>
                    <input type="text" name="search" class="form-control" id="search_num" placeholder="Enter Receipt No. or Transaction No." required>

                    <hr class="mb-4">

                    <button class="btn btn-primary btn-lg btn-block" name="submit" type="submit">Search for Customer's Receipt</button>

                    <div class="invalid-feedback">
                        Valid receipt number or transaction number is required.
                    </div>

                </div>
            </div>

        </form>
    </div>

</body>

</html>

<?php

function validate($data)
{
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);

    return $data;
}

$search = "";

if (isset($_POST['submit'])) {

    $search = validate($_POST['search']);
    $search = mysqli_real_escape_string($conn_integration, $search);

    $sql = "SELECT * FROM receipt WHERE receipt_number='$search' OR transaction_id='$search'";

    $result = $conn_integration->query($sql);
    $rowNumber = $result->num_rows;

    //check if table has any data
    if ($rowNumber > 0) {
        echo "<div class='col-xs-6'>";
        echo "<table class='table table-bordered table-hover'>";
        echo ' <thead>
    <tr>
        <th>Receipt Number</th>
        <th>Transaction ID</th>
        <th>Card Type</th>
        <th>Bank Transaction ID</th> 
        <th>Transaction Date</th> 
        <th>Currency</th>  
        <th>Total Amount Paid (with VAT)</th>   
    </tr>
    </thead>';

        while ($row = $result->fetch_assoc()) {
           
            echo "  <tbody>
        <tr>
            <td>{$row['receipt_number']}</td>
            <td>{$row['transaction_id']}</td>
            <td>{$row['card_type']}</td>
            <td>{$row['bank_transaction_id']}</td>
            <td>{$row['transaction_date']}</td>
            <td>{$row['currency']}</td>
            <td>{$row['amount']}</td>
            
        </tr>
    </tbody>";
        }
        echo "</table>";
        echo "</div>";

        echo "<hr>";

        echo '<div class="col-md-8 order-md-1">
        <h4 class="mb-3" style="text-align: center;font-size: 40px">Refund Payment to Customer</h4>

        <form action="refunds/example_refund.php" method="get" class="needs-validation">

            <div class="row"
                <div class="col-md-12 mb-3">

                    <!-- customer_name -->

                    <label for="bank_id">Bank Transaction ID</label>
                    <input type="text" name="bank_trans_id" class="form-control" id="search_num" value="">

                    <hr class="mb-4">

                    <button class="btn btn-primary btn-lg btn-block" name="submit" type="submit">Start Refund Process</button>

                    <div class="invalid-feedback">
                        Valid receipt number or transaction number is required.
                    </div>

                </div>
            </div>

        </form>
    </div>';



    } else {
        echo "<h1 style='color:red'>There is no such receipt</h1>";
    }


    $conn_integration->close();
}

?>