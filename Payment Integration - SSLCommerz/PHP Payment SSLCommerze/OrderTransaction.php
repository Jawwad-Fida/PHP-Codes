<?php

class OrderTransaction {

    public function getRecordQuery($tran_id)
    {
        $sql = "select * from orders WHERE transaction_id='" . $tran_id . "'";
        return $sql;
    }
    public function saveTransactionQuery($post_data)
    {
        $name = $post_data['cus_name'];
        $email = $post_data['cus_email'];
        $phone = $post_data['cus_phone'];
        $transaction_amount = $post_data['total_amount'];
        $address = $post_data['cus_add1'];
        $city = $post_data['cus_city'];
        $transaction_id = $post_data['tran_id'];
        $currency = $post_data['currency'];
        $product_profile = $post_data['product_category'];
        $product_category = $post_data['product_profile'];

        $vat = $post_data['vat'];
        $transaction_amount += $vat;

        $sql = "INSERT INTO orders (name, email, phone, amount, address, city, status, transaction_id, currency, product_profile, product_category)
                                    VALUES ('$name', '$email', '$phone','$transaction_amount','$address','$city','Pending', '$transaction_id','$currency','$product_profile','$product_category')";

        return $sql;
    }

    public function updateTransactionQuery($tran_id, $type = 'Success')
    {
        $sql = "UPDATE orders SET status='$type' WHERE transaction_id='$tran_id'";

        return $sql;
    }
}

