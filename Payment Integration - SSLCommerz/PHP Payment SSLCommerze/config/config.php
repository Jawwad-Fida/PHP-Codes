<?php

if (!defined('PROJECT_PATH')) {
    define('PROJECT_PATH', 'http://www.jawwadfida.com/phpDemo/PHP%20Payment%20SSLCommerze'); // Replace this value with your project path
}

if (!defined('API_DOMAIN_URL')) {
    define('API_DOMAIN_URL', 'https://sandbox.sslcommerz.com'); //sandbox url, change it when going live
}

if (!defined('STORE_ID')) {
    define('STORE_ID', 'fidal5ed892039802d'); //from mail
}

if (!defined('STORE_PASSWORD')) {
    define('STORE_PASSWORD', 'fidal5ed892039802d@ssl'); //from mail
}

if (!defined('IS_LOCALHOST')) {
    define('IS_LOCALHOST', true); //change it to false for live server
}

return [
    'projectPath' => constant("PROJECT_PATH"),
    'apiDomain' => constant("API_DOMAIN_URL"),
    'apiCredentials' => [
        'store_id' => constant("STORE_ID"),
        'store_password' => constant("STORE_PASSWORD"),
    ],
    'apiUrl' => [ //THESE WILL CHANGE when going live. Using v3 instead of v4(problem)
        'make_payment' => "/gwprocess/v3/api.php", //session Api (url) to generate transaction - create and get session from SSLCommerze
        'transaction_status' => "/validator/api/merchantTransIDvalidationAPI.php", //validation api urls
        'order_validate' => "/validator/api/validationserverAPI.php",
        'refund_payment' => "/validator/api/merchantTransIDvalidationAPI.php",
        'refund_status' => "/validator/api/merchantTransIDvalidationAPI.php",
    ],
    'connect_from_localhost' => constant("IS_LOCALHOST"),
    'success_url' => 'pg_redirection/success.php', //re-direction for payment processes - success, failed, canceled
    'failed_url' => 'pg_redirection/fail.php',
    'cancel_url' => 'pg_redirection/cancel.php',
    'ipn_url' => 'pg_redirection/ipn.php',
];
