<?php

$reference_code = $_POST['payment_reference'];
header("Location: http://coralperfumes.com/checkout/payment-response?ref_id=".$reference_code);

?>