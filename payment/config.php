<?php

require_once("vendor/autoload.php");

$api_keys = array(
    "secret_key" => "test_sec_k_09ebc551709ada8e24269",
    "open_key" => "test_open_k_51d7e20eef6388900859"
);


/* convert 10.00 AED to cents */
$amount_in_cents = 10.00 * 100;
$currency = "AED";
$customer_email = "surumi@azryah.com";
?>
