<?php


require 'PayTabs.php';
$paytabs= new PayTabs();
$data = $paytabs->verify_payment($_POST['payment_reference']);
var_dump($data);
exit;
?>