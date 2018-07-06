<?php

use yii\helpers\Html;

$api_keys = array(
    "secret_key" => "test_sec_k_16dc38ad730d6ba806a92",
    "open_key" => "test_open_k_c3f462a1e8277114c1da"
);


/* convert 10.00 AED to cents */
$amount = $model->net_amount * 100;
$currency = "AED";
$customer_email = $user_details->email;
?>
<h1>Payfort Start PHP Demo</h1>
<?= Html::beginForm(['checkout/payment-return'], 'post', []) ?>
<input type="hidden" id="merchant_identifier" name="merchant_identifier" value="<?= $model->order_id ?>">
<input type="hidden" id="access_code" name="access_code" value="redacted">
<input type="hidden" id="merchant_reference" name="merchant_reference" value="redacted">
<input type="hidden" id="language" name="language" value="en">
<!--<input type="hidden" id="service_command" name="service_command" value="TOKENIZATION">-->
<input type="hidden" id="return_url" name="return_url" value="redacted">
<input type="hidden" id="signature" name="signature" value="redacted">
<!--<input type="hidden" id="card_number" name="card_number" value="4005550000000001">-->
<!--<input type="hidden" id="card_holder_name" name="card_holder_name" value="Mr Smith">-->
<!--<input type="hidden" id="card_security_code" name="card_security_code" value="123">-->
<input type="hidden" id="expiry_date" name="expiry_date" value="2105">
<input type="hidden" id="amount" name="expiry_date" value="<?= $amount ?>">
<input type="hidden" id="currency" name="expiry_date" value="<?= $currency ?>">
<input type="hidden" id="email" name="expiry_date" value="<?= $customer_email ?>">
<script src="https://beautiful.start.payfort.com/checkout.js"
	data-key="<?php echo $api_keys['open_key']; ?>"
	data-currency="<?php echo $currency ?>"
	data-amount="<?php echo $amount ?>"
	data-email="<?php echo $customer_email ?>">
</script>

<?= Html::endForm() ?>
