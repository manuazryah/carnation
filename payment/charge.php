<?php
require_once("config.php");


# Read the fields that were automatically submitted by beautiful.js
$token = $_POST["startToken"];
$email = $_POST["startEmail"];

# Setup the Start object with your private API key
Start::setApiKey($api_keys["secret_key"]);

# Process the charge
try {

	$charge = Start_Charge::create(array(
		    "amount" => $amount_in_cents,
		    "currency" => $currency,
		    "card" => $token,
		    "email" => $email,
		    "ip" => $_SERVER["REMOTE_ADDR"],
		    "description" => "Charge Description"
	));


	echo "<h1>Successfully charged 10.00 AED</h1>";
	echo "<p>Charge ID: " . $charge["id"] . "</p>";
	echo "<p>Charge State: " . $charge["state"] . "</p>";
} catch (Start_Error $e) {
	$error_code = $e->getErrorCode();
	$error_message = $e->getMessage();

	/* depending on $error_code we can show different messages */
	if ($error_code === "card_declined") {
		echo "<h1>Charge was declined</h1>";
	} else {
		echo "<h1>Charge was not processed</h1>";
	}
	echo "<p>" . $error_message . "</p>";
}
?>

<a href="index.php">Try Again!</a>
