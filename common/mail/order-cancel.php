<?php

use yii\helpers\Html;
use common\models\OrderDetails;
use common\models\OrderMaster;
use common\models\Product;
use common\models\Fregrance;
use common\models\Settings;
use common\models\OrderPromotions;
use common\models\Tax;

$order_products = OrderDetails::find()->where(['order_id' => $orderid])->all();

$order_master = OrderMaster::find()->where(['order_id' => $orderid])->one();
$promotions = OrderPromotions::find()->where(['order_master_id' => $order_master->id])->sum('promotion_discount');
$user_detail = common\models\User::findOne($order_master->user_id);
?>
<div class="mail-body" style="margin: auto;width: 100%;border: 1px solid #9e9e9e;">
        <table style="margin: auto;font-family: sans-serif;font-size: 12px !important;">
                <tr>
                        <td style="padding-bottom: 1em;">
                                <p><strong>Dear <?= $user_detail->first_name . ' ' . $user_detail->last_name ?>, </strong><br><br>
                                        Your order has been cancelled. Here is the summary of your cancelled order.</p>
                        </td>
                </tr>

                <tr>
                        <td>
                                <table style="width:100%">
                                        <tr>
                                                <td style="width:38%;font-size: 12px;padding-bottom: 1em;"><b>Order Number</b><br> #<?= $order_master->order_id ?></td>
                                                <td style="width:40%;font-size: 12px;padding-bottom: 1em;"><b>Order Date</b> <br><?= date('d-m-Y H:i:A', strtotime($order_master->order_date)) ?></td>
                                                <td style="width:40%;font-size: 12px;padding-bottom: 1em;"><b>Payment Method</b>  <br>
                                                        Credit/Debit Card Payment
                                                </td>
                                        </tr>
                                </table>

                                <!--                                <div style="float: left;margin-left: 10px;">Order Number #500031274</div>
                                                                <div style="float: left;margin-left: 10px;">Order Date Jan 27, 2018, 6:40:55 PM</div>
                                                                <div style="float: left;margin-left: 10px;">Payment Method  #500031274</div>-->
                        </td>
                </tr>

                <tr>
                        <td>
                                <div class="close-estimate-heading-top" style="margin-bottom:30px;">
                                        <div class="main-left left-address" style="float: left;">
                                                <table class="tb2">
                                                        <tr>
                                                                <td style="max-width: 405px;font-size: 11px;">
                                                                        <p><label style="font-weight:bold;text-decoration: underline">BILLING ADDRESS</label></p>
                                                                </td>
                                                        </tr>
                                                        <?php
                                                        $bill_address = \common\models\UserAddress::findOne($order_master->bill_address_id);
                                                        if (!empty($bill_address)) {
                                                                ?>
                                                                <tr>
                                                                        <td style="max-width: 405px;font-size: 11px;">
                                                                                <p style=""><?= $bill_address->address ?></p>
                                                                                <p ><?= $bill_address->location ?></p>
                                                                                <p ><?= $bill_address->landmark ?></p>
                                                                                <p >Tel : <?= $bill_address->mobile_number ?></p>
                                                                        </td>
                                                                </tr>
                                                        <?php } ?>
                                                </table>
                                        </div>
                                        <div class="main-right left-address" style="margin: 0px 30px 0px 0px;float: right;">
                                                <table class="tb2">
                                                        <tr>
                                                                <td style="max-width: 405px;font-size: 11px;">
                                                                        <p><label style="font-weight:bold;text-decoration: underline">SHIPPING ADDRESS</label></p>
                                                                </td>
                                                        </tr>
                                                        <?php
                                                        $ship_address = \common\models\UserAddress::findOne($order_master->ship_address_id);
                                                        if (!empty($ship_address)) {
                                                                ?>
                                                                <tr>
                                                                        <td style="max-width: 405px;font-size: 11px;">
                                                                                <p style=""><?= $ship_address->address ?></p>
                                                                                <p ><?= $ship_address->location ?></p>
                                                                                <p ><?= $ship_address->landmark ?></p>
                                                                                <p >Tel : <?= $ship_address->mobile_number ?></p>
                                                                        </td>
                                                                </tr>
                                                        <?php } ?>
                                                </table>
                                        </div>
                                </div>
                                <br/>
                        </td>
                </tr>


                <tr>
                        <td>
                                <div class="invoice-details"style="margin-top: 10px;">
                                        <table style="width:100%;border-collapse: collapse;text-align: left;">
                                                <tr style="border-bottom: 1px solid #a09c9c;">
                                                        <th style="width: 20%;font-size: 12px;padding: 10px 2px;">Product</th>
                                                        <th style="width: 5%;font-size: 12px;padding: 10px 2px;">Quantity</th>
                                                        <th style="width: 5%;font-size: 12px;padding: 10px 2px;">SubTotal</th>
                                                </tr>
                                                <?php
                                                $tax_amount = 0;
                                                $count = count($order_products);
                                                $total_amount = 0;
                                                $p = 0;
                                                foreach ($order_products as $order_product) {
                                                        $p++;
                                                        $tax = 0;
                                                        if ($order_product->item_type == 1) {
                                                                $product_detail = \common\models\CreateYourOwn::findOne($order_product->product_id);
                                                                $bottles = \common\models\Bottle::findOne($product_detail->bottle);
                                                                $product_image = Yii::$app->basePath . '/../uploads/create_your_own/bottle/' . $bottles->id . '/small.' . $bottles->bottle_img;
                                                                if (file_exists($product_image)) {
                                                                        $image = 'http://' . Yii::$app->request->serverName . '/uploads/create_your_own/bottle/' . $bottles->id . '/small.' . $bottles->bottle_img;
                                                                }
                                                                $price = $product->tot_amount;
                                                        } else {
                                                                $product_detail = Product::find()->where(['id' => $order_product->product_id])->one();
                                                                $product_image = Yii::$app->basePath . '/../uploads/product/' . $product_detail->id . '/profile/' . $product_detail->canonical_name . '.' . $product_detail->profile;
                                                                if (file_exists($product_image)) {
                                                                        $image = 'http://' . Yii::$app->request->serverName . '/uploads/product/' . $product_detail->id . '/profile/' . $product_detail->canonical_name . '_thumb.' . $product_detail->profile;
                                                                } else {
                                                                        $image = 'http://' . Yii::$app->request->serverName . '/uploads/product/profile_thumb.png';
                                                                }
                                                                if ($product_detail->offer_price == '0' || $product_detail->offer_price == '') {
                                                                        $price = $product_detail->price;
                                                                } else {
                                                                        $price = $product_detail->offer_price;
                                                                }
                                                                if (isset($order_product->tax))
                                                                        $tax = $order_product->tax;
                                                        }
                                                        $tax_amount += $tax;
                                                        $amount_tax = ( $order_product->rate * 5) / 100;
                                                        $order_product->rate = $order_product->rate - $amount_tax;
                                                        $total_amount += $order_product->rate;
                                                        ?>

                                                        <tr style="<?= $count == $p ? 'border-bottom: 1px solid #a09c9c;' : '' ?>">
                                                                <td style="padding-bottom: 1em;font-size: 12px;">
                                                                        <img src="<?= $image ?>" style="float:left">
                                                                        <span style="vertical-align: middle;margin-top: 25px;display: inline-block;"><?= $order_product->item_type == 1 ? 'Custom Perfume' : $product_detail->product_name; ?></span>

                                                                </td>
                                                                <td style="padding-bottom: 1em;font-size: 12px;"><?= $order_product->quantity ?></td>
                                                                <td style="padding-bottom: 1em;font-size: 12px;">AED <?= sprintf('%0.2f', $order_product->rate) ?></td>
                                                        </tr>
                                                <?php } ?>


                                                <tr>
                                                        <td colspan="2" style="padding-bottom: 1em;font-size: 14px;padding-top: 1em;"><b>Subtotal</b></td>
                                                        <td style="padding-bottom: 1em;font-size: 14px;padding-top: 1em;">AED <?= sprintf('%0.2f', $total_amount) ?></td>
                                                </tr>
                                                <?php
                                                $promotion_disvount = 0;
                                                if (isset($promotions) && $promotions > 0) {
                                                        $promotion_disvount = $promotions;
                                                        ?>
                                                        <tr>
                                                                <td colspan="2" style="padding-bottom: 1em;font-size: 14px;"><b>Coupon Code Added</b></td>
                                                                <td style="padding-bottom: 1em;font-size: 14px;">AED <?= sprintf('%0.2f', $promotions) ?></td>
                                                        </tr>
                                                <?php }
                                                ?>

                                                <tr>
                                                        <td colspan="2" style="padding-bottom: 1em;font-size: 14px;"><b>Tax</b></td>
                                                        <td style="padding-bottom: 1em;font-size: 14px;">AED <?= sprintf('%0.2f', $tax_amount) ?></td>
                                                </tr>



                                                <tr>
                                                        <?php
                                                        $shipping_limit = Settings::findOne('1')->value;
                                                        $shipextra = Settings::findOne('2')->value;
                                                        $ship_charge = $order_master->total_amount <= $shipping_limit ? $shipextra : 0.00
                                                        ?>
                                                        <td colspan="2" style="padding-bottom: 1em;font-size: 14px;"><b>Shipping Charge</b></td>
                                                        <td style="padding-bottom: 1em;font-size: 14px;">AED <?= sprintf('%0.2f', $ship_charge) ?></td>
                                                </tr>
                                                <?php $grand_total = $total_amount + $ship_charge - $promotion_disvount + $tax_amount; ?>
                                                <tr>
                                                        <td colspan="2" style="padding-bottom: 1em;font-size: 14px;"><b>Grand Total (inclusive of VAT)</b></td>
                                                        <td style="padding-bottom: 1em;font-size: 14px;"><b>AED <?= sprintf('%0.2f', $grand_total) ?></b></td>
                                                </tr>

                                        </table>
                                </div>


                        </td>
                </tr>


                <tr>
                        <td >
                                <p style="font-size: 10px;">We'll be in touch again with delivery and tracking details as soon as your order leaves our warehouse.<br>
                                        In the meantime, you can find some useful information by clicking on the below links: <br>
                                        <a href="http://<?= Yii::$app->request->serverName ?>/delivery-information" style="color:#501a8f;text-decoration: none;"></i>Delivery Information | </a> <a href="http://<?= Yii::$app->request->serverName ?>/return-policy" style="color:#501a8f;text-decoration: none;"></i>Return Policy | </a>  <a href="http://<?= Yii::$app->request->serverName ?>/faq" style="color:#501a8f;text-decoration: none;"></i>FAQs </a>
                                </p>
                        </td>
                </tr>


        </table>
</div>