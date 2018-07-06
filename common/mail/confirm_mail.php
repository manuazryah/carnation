<?php

use yii\helpers\Html;
use common\models\OrderDetails;
use common\models\OrderMaster;
use common\models\Product;
use common\models\Fregrance;
use common\models\Settings;
use common\models\OrderPromotions;

$order_master = OrderMaster::find()->where(['order_id' => $orderid])->one();

$order_products = OrderDetails::find()->where(['order_id' => $order_master->order_id])->all();
$promotions = OrderPromotions::find()->where(['order_master_id' => $order_master->id])->sum('promotion_discount');
?>

<html>

        <head>
                <title>Confirm Order</title>
                <link href="<?= Yii::$app->homeUrl; ?>css/email.css" rel="stylesheet">
        </head>

        <body>
                <div class="mail-body" style="margin: auto;width: 100%;border: 1px solid #9e9e9e;">
                        <div class="content" style="margin-left: 40px;">
                                <h2 style="text-align: center;">ORDER SUCCESSFULLY CONFIRMED</h2>
                                <p style="text-align: center;">Your order is confirmed successfully. Thanks For Purchasing From Us.<br> Your Order Id : <span style="font-size: 15px;font-weight: bold;"><?= $orderid ?></span></p>

                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-12 hidden-xs my-order-list">

                                <div class="orders-box">

                                        <table class="table" style="margin:auto;width:50%;border-collapse: collapse;margin-bottom: 25px;">
                                                <thead>
                                                        <tr>
                                                                <th style="text-align:center;border: 1px solid #ddd;"><p class="th">Product</p></th>
                                                                <th style="text-align:center;border: 1px solid #ddd;"><p class="th">Price</p></th>
                                                                <th style="text-align:center;border: 1px solid #ddd;"><p class="th">Quantity</p></th>
                                                                <th style="text-align:center;border: 1px solid #ddd;"><p class="th">Total</p></th>
                                                        </tr>
                                                </thead>
                                                <tbody>
                                                        <?php
                                                        foreach ($order_products as $order_product) {

                                                                if ($order_product->item_type == 1) {
                                                                        $product_detail = \common\models\CreateYourOwn::findOne($order_product->product_id);
                                                                } else {
                                                                        $product_detail = Product::find()->where(['id' => $order_product->product_id])->one();
                                                                }
                                                                ?>
                                                                <tr>
                                                                        <td style="text-align:center;border: 1px solid #ddd;"><?= $order_product->item_type == 1 ? 'Custom Perfume' : $product_detail->product_name; ?></td>
                                                                        <td style="text-align:center;border: 1px solid #ddd;"><?= $order_product->amount ?></td>
                                                                        <td style="text-align:center;border: 1px solid #ddd;"><?= $order_product->quantity ?></td>
                                                                        <td style="text-align:center;border: 1px solid #ddd;">AED <?= sprintf('%0.2f', $order_product->rate) ?></td>
                                                                </tr>

                                                        <?php } ?>
                                                        <?php
                                                        if (isset($promotions) && $promotions > 0) {
                                                                ?>
                                                                <tr>
                                                                        <td colspan="3" style="text-align:center;border: 1px solid #ddd;">Promotion Code Added</td>

                                                                        <td style="text-align:center;border: 1px solid #ddd;"> AED <?= sprintf('%0.2f', $promotions) ?></td>
                                                                </tr>
                                                        <?php } ?>

                                                        <tr>
                                                                <td colspan="3" style="text-align:center;border: 1px solid #ddd;">Shipping Charges</td>
                                                                <?php
                                                                $shipping_limit = Settings::findOne('1')->value;
                                                                $shipextra = Settings::findOne('2')->value;
                                                                $ship_charge = $order_master->total_amount <= $shipping_limit ? $shipextra : 0.00
                                                                ?>
                                                                <td style="text-align:center;border: 1px solid #ddd;"> AED <?= sprintf('%0.2f', $ship_charge) ?></td>
                                                        </tr>

                                                        <tr>
                                                                <td colspan="3" style="text-align:center;border: 1px solid #ddd;"><b>Total </b></td>
                                                                <td style="text-align:center;border: 1px solid #ddd;"> <b>AED <?= sprintf('%0.2f', $order_master->net_amount) ?></b></td>
                                                        </tr>


                                                </tbody>
                                        </table>


                                </div>
                        </div>
                </div>



        </body>
</html>