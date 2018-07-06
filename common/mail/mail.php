<?php

use yii\helpers\Html;
use common\models\OrderDetails;
use common\models\OrderMaster;
use common\models\Product;
use common\models\Fregrance;
use common\models\Settings;
use common\models\OrderPromotions;
use common\models\Tax;
echo $payment_method;exit;
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
                                                                                Thank you for placing your order with Coral Perfumes. Here is a summary of your purchase </p>
                                                                                </td>
                                                                                </tr>

                                                                                <tr>
                                                                                        <td>
                                                                                                <table style="width:100%">
                                                                                                        <tr>
                                                                                                                <td style="width:38%;font-size: 12px;padding-bottom: 1em;"><b>Order Number</b><br> #500031274</td>
                                                                                                                <td style="width:40%;font-size: 12px;padding-bottom: 1em;"><b>Order Date</b> <br>Jan 27, 2018, 6:40:55 PM</td>
                                                                                                                <td style="width:40%;font-size: 12px;padding-bottom: 1em;"><b>Payment Method</b>  <br>
                                                                                                                      <?= $payment_method;?>          
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
                                                                                                        <div class="main-left left-address" style="padding-top: 10px;float: left;">
                                                                                                                <table class="tb2">
                                                                                                                        <tr>
                                                                                                                                <td style="max-width: 405px;font-size: 11px;">
                                                                                                                                        <p><label style="font-weight:bold;text-decoration: underline">BILLING ADDRESS</label></p>
                                                                                                                                </td>
                                                                                                                        </tr>
                                                                                                                        <?php
                                                                                                                        $bill_address = \common\models\UserAddress::findOne($order_master->bill_address_id);
                                                                                                                        ?>
                                                                                                                        <tr>
                                                                                                                                <td style="max-width: 405px;font-size: 11px;">
                                                                                                                                        <p style=""><?= $bill_address->address ?></p>
                                                                                                                                        <p ><?= $bill_address->location ?></p>
                                                                                                                                        <p ><?= $bill_address->landmark ?></p>
                                                                                                                                        <p >Tel : <?= $bill_address->mobile_number ?></p>
                                                                                                                                </td>
                                                                                                                        </tr>
                                                                                                                </table>
                                                                                                        </div>
                                                                                                        <div class="main-right left-address" style="padding-top: 10px;margin: 0px 30px 0px 0px;float: right;">
                                                                                                                <table class="tb2">
                                                                                                                        <tr>
                                                                                                                                <td style="max-width: 405px;font-size: 11px;">
                                                                                                                                        <p><label style="font-weight:bold;text-decoration: underline">SHIPPING ADDRESS</label></p>
                                                                                                                                </td>
                                                                                                                        </tr>
                                                                                                                        <?php
                                                                                                                        $ship_address = \common\models\UserAddress::findOne($order_master->ship_address_id);
                                                                                                                        ?>
                                                                                                                        <tr>
                                                                                                                                <td style="max-width: 405px;font-size: 11px;">
                                                                                                                                        <p style=""><?= $ship_address->address ?></p>
                                                                                                                                        <p ><?= $ship_address->location ?></p>
                                                                                                                                        <p ><?= $ship_address->landmark ?></p>
                                                                                                                                        <p >Tel : <?= $ship_address->mobile_number ?></p>
                                                                                                                                </td>
                                                                                                                        </tr>
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
                                                                                                                <tr>
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
                                                                                                                                if (isset($product_detail->tax) && $product_detail->tax != '') {
                                                                                                                                        $tax_detail = Tax::findOne($product_detail->tax);
                                                                                                                                        if (isset($tax_detail)) {
                                                                                                                                                if ($tax_detail->type == 1) {
                                                                                                                                                        $tax = $price * $tax_detail->value / 100;
                                                                                                                                                } else if ($tax_detail->type == 2) {
                                                                                                                                                        $tax = $price + $tax_detail->value;
                                                                                                                                                }
                                                                                                                                        }
                                                                                                                                }
                                                                                                                        }
                                                                                                                        $tax_amount += $tax;
                                                                                                                        $total_amount += $order_product->rate;
                                                                                                                        ?>

                                                                                                                        <tr style="<?= $count == $p ? 'border-bottom: 1px solid #a09c9c;' : '' ?>">
                                                                                                                                <td style="padding-bottom: 1em;font-size: 12px;">
                                                                                                                                        <img src="<?= $image ?>">
                                                                                                                                                <span><?= $order_product->item_type == 1 ? 'Custom Perfume' : $product_detail->product_name; ?></span>

                                                                                                                                </td>
                                                                                                                                <td style="padding-bottom: 1em;font-size: 12px;"><?= $order_product->quantity ?></td>
                                                                                                                                <td style="padding-bottom: 1em;font-size: 12px;">AED <?= sprintf('%0.2f', $order_product->rate) ?></td>
                                                                                                                        </tr>
                                                                                                                <?php } ?>


                                                                                                                <tr>
                                                                                                                        <td colspan="2" style="padding-bottom: 1em;font-size: 14px;"><b>Subtotal</b></td>
                                                                                                                        <td style="padding-bottom: 1em;font-size: 14px;">AED <?= sprintf('%0.2f', $total_amount) ?></td>
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
                                                                                                                        Delivery Information Returns and Exchange Policy FAQs and Contact
                                                                                                                        </p>
                                                                                                                        </td>
                                                                                                                        </tr>


                                                                                                                        </table>
                                                                                                                        </div>