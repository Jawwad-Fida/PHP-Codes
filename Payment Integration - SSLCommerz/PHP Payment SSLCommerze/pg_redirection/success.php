<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>

<title>Success Page</title>
<h1 style='text-align: center'>SSLCOMMERZ Integration Success Page</h1>

<?php
error_reporting(0);
ini_set('display_errors', 0);

session_start();

require_once(__DIR__ . "/../lib/SslCommerzNotification.php");
include(__DIR__ . "/../db_connection.php");
include(__DIR__ . "/../OrderTransaction.php");

use SslCommerz\SslCommerzNotification;

$sslc = new SslCommerzNotification();
//re-directed from checkout page
$tran_id = $_POST['tran_id'];
$amount =  $_POST['amount'];
$currency =  $_POST['currency'];

# SHIPMENT INFORMATION (Company Details) (fixed) [Adjust the details here again for the receipt]
$ship_name = $post_data['ship_name'] = "testfidalyk5v"; //store name
$ship_address = $post_data['ship_add1'] = "Dhanmondi, Road no. 7A, Jawwad City Center, 3rd Floor, Dhaka";
$ship_phone = $post_data['ship_phone'] = "+8801715199382";
$vat = $post_data['vat'] = "500";

//Adjusting the total amount with VAT
$temp = $amount;
$total_amount = $temp + $vat;

//Generate a unique string for Sales Receipt Given to Customer
$keyLength = 5;
$str = "1234567890abcdefghijklmnopqrstuvwxyz()/$";
$shuffleStr = str_shuffle($str); //shuffle
$Receipt_number = substr($shuffleStr,0,$keyLength);


$query = new OrderTransaction();
$sql = $query->getRecordQuery($tran_id); //get all records from database order table based on transaction id (unique for each customer)
$result = $conn_integration->query($sql);
$row = $result->fetch_array(MYSQLI_ASSOC); //fetch as associative array

if ($row['status'] == 'Pending') {

    //validate the payment - check whether the payment is success, fail, cancel

    $validation = $sslc->orderValidate($tran_id, $amount, $currency, $_POST);
    $tran_id = (string) $tran_id;

    //if the payment is valid (successfull), update the database
    if ($validation == TRUE) {
        $query = new OrderTransaction();
        $sql = $query->updateTransactionQuery($tran_id, 'Success'); //successfull payment

        if ($conn_integration->query($sql) === TRUE) {
            //echo "Payment Record Updated Successfully";
        } else {
            echo "Error updating record: " . $conn_integration->error;
        }

        echo "<h2 style='color: green; text-align: center;'>Congratulations! Your Transaction is Successful.</h2>";

        
        //Create a mail class to send values over there. That class will be for sending mails
        //call the mail object here after printing receipt

        //REFUND API IS NOT YET IMPLEMENTED

?>
        <!-- After a successfull payment, display a receipt (receipt details can be changed based on us)-->

        <!-- Remember that we are re-directed from sslcommerznotification after payment validation, we can use the varibles
        in validate() function over there to display information here -->

        <table border="1" class="table table-bordered">
            <thead>
                <tr>
                    <th colspan="2" style='text-align: center'>Sales Receipt of Payment</th>
                </tr>
            </thead>
            <tr>
                <td><span style="font-weight:bold">Receipt Number</span></td>
                <td><?php echo $Receipt_number; ?></td>
            </tr>
            <tr>
                <td><span style="font-weight:bold">Company Name</span></td>
                <td><?php echo $ship_name; ?></td>
            </tr>
            <tr>
                <td><span style="font-weight:bold">Company Address</span></td>
                <td><?php echo $ship_address; ?></td>
            </tr>
            <tr>
                <td>Company Contact Information</td>
                <td><?php echo $ship_phone; ?></td>
            </tr>
            <tr>
                <td><span style="font-weight:bold">Customer Name</span></td>
                <td><?php echo $row['name']; ?></td>
            </tr>
            <tr>
                <td>Product Profile</td>
                <td><?php echo $row['product_profile']; ?></td>
            </tr>
            <tr>
                <td><span style="font-weight:bold">Transaction ID</span></td>
                <td><?php echo $tran_id;?></td>
            </tr>
            <tr>
                <td><span style="font-weight:bold">Transaction Date</span></td>
                <td><?php $trans_date = $_POST['tran_date'];
                    echo $trans_date; ?></td>
            </tr>
            <tr>
                <td>Card Type</td>
                <td><?php $card_type = $_POST['card_type'];
                    echo $card_type; ?></td>
            </tr>
            <tr>
                <td>Bank Transaction ID</td>
                <td><?php $bank_trans_id = $_POST['bank_tran_id'];
                    echo $bank_trans_id; ?></td>
            </tr>
            <tr>
                <td>Currency</td>
                <td><?php echo $currency; ?></td>
            </tr>
            <tr>
                <td>Total Price of goods</td>
                <td><?php echo $amount; ?></td>
            </tr>
            <tr>
                <td>VAT on Goods</td>
                <td><?php echo $vat; ?></td>
            </tr>
            <tr>
                <td><span style="font-weight:bold">Total Amount Paid</span></td>
                <td><?php echo $total_amount; ?></td>
            </tr>
        </table>

<?php
        //Enter the receipt details into database receipt table 
        $sql = "INSERT INTO receipt (receipt_number, transaction_id, transaction_date, card_type, bank_transaction_id, currency, vat, amount) VALUES ('$Receipt_number','$tran_id', '$trans_date', '$card_type','$bank_trans_id','$currency','$vat','$total_amount')";
        $result = $conn_integration->query($sql);

        //create a search based on customer's trans_id or receipt number is a seperate document






    } else {
        $query = new OrderTransaction();
        $sql = $query->updateTransactionQuery($tran_id, 'Failed');
        echo $sql;
        echo "<h2 style='color: #ff0000; text-align: center'>Payment was not valid. Please contact with the merchant.</h2>";
    }

    unset($_SESSION['payment_values']);

} else if ($row['status'] == 'Success') {
    echo "This order is already Successful";
} else {
    echo "Invalid Information";
}
?>