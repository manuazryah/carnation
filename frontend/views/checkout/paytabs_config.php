<?php

$ip = $_SERVER['SERVER_ADDR'];
return array(
    'merchant_email' => 'operations@carnation.com',
    'secret_key' => 'uOOMvx08gEDjG1m9CjZIbX4svh0kvsCZgrMLYNUerxy7yUhbdhTpeYRKfS4KkHKB8xm7kgmLOUTmPbx3trsHpjsFcwqxeb8nIvu2',
    'site_url' => "http://carnation.com/",
    'return_url' => "http://carnation.com/payment-response.php",
    'ip_merchant' => $ip,
    'cms_with_version' => "VT_PayTabs 0.1.0"
);
?>