<?php

use common\models\Product;

// import paytabs class

require 'PayTabs.php';


//make sure to set the right value in paytabs_config.php file
//create new paytabs object
$paytabs = new PayTabs();
/*
  -title: payment title
  -ref_number: number from your system to track the order
  -currency: 3 character for currency
  -customer_ip: customer ip address
  -page_language: the language of the payment page

 */
$paytabs->set_page_setting('title', $model->order_id, 'AED', '127.0.0.1', 'English');

/*
  -customer first name
  -customer last name
  -customer international phone number
  -customer phone number
  -customer email

 */
$paytabs->set_customer($user_details->first_name, $user_details->last_name, $user_details->country_code, $user_details->mobile_no, $user_details->email);
/*
  -Item name
  -item price in the same currency set in paytabs_config.php file
  -item quantity
 */

foreach ($order_details as $order) {

	$product = Product::findOne($order->product_id);

	if ($product->offer_price == NULL && empty($product->offer_price)) {
		$price = $product->price;
	} else {
		$price = $product->offer_price;
	}

	$paytabs->add_item($product->product_name, $price, $order->quantity);
}

//$paytabs->add_item('New item2', '20', '2');

/*
  add extra charges
 */
if ($model->total_amount < $limit) {
	$paytabs->set_other_charges($extra);
}

/*
  add discount
 */
$paytabs->set_discount($discount);

/*
  -customer address
  -customer state, required for USA and Canada
  -customer city
  -customer postal code
  -customer country
 */
$paytabs->set_address($bill_address->address, "United Arab Emirates", $bill_address->location, "12345", "BHR");
//$paytabs->set_address($bill_address->address,$bill_address->landmark, $bill_address->location, $bill_address->post_code, "UAE");


/*

  note: only set shipping address if it is different than billing address.
  -customer address
  -customer state, required for USA and Canada
  -customer city
  -customer postal code
  -customer country
 */
$paytabs->set_address($ship_address->address, "United Arab Emirates", $ship_address->location, '000', "BHR");
//$paytabs->set_shipping_address($ship_address->address,$ship_address->landmark, $ship_address->location, $ship_address->post_code, "UAE");

/*
  return value:
  -result
  -response_code
  -payment_url
  -p_id
 */
$result = $paytabs->create_pay_page();
$array = get_object_vars($result);

//print_r($paytabs->create_pay_page());
Yii::$app->response->redirect(['checkout/paypal-form', 'url' => $array['payment_url'], 'p_id' => $array['p_id'], 'order_id' => $model->id]);
?>
