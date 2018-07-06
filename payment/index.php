<?php
require_once("config.php");
?>

<h1>Payfort Start PHP Demo</h1>

<form action="charge.php" method="post">
	<script src="https://beautiful.start.payfort.com/checkout.js"
		data-key="<?php echo $api_keys['open_key']; ?>"
		data-currency="<?php echo $currency ?>"
		data-amount="<?php echo $amount_in_cents ?>"
		data-email="<?php echo $customer_email ?>">
	</script>
</form>
