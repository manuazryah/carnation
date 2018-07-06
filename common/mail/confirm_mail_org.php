<?php

use yii\helpers\Html;
use common\models\OrderDetails;
use common\models\OrderMaster;
use common\models\Product;
use common\models\Fregrance;
use common\models\Settings;

$order_products = OrderDetails::find()->where(['order_id' => $orderid])->all();
$order_master = OrderMaster::find()->where(['order_id' => $orderid])->one();
?>

<html>

    <head>
        <title>Confirm Order</title>
        <link href="<?= Yii::$app->homeUrl; ?>css/email.css" rel="stylesheet">
    </head>

    <body>
        <div class="mail-body" style="margin: auto;width: 50%;border: 1px solid #9e9e9e;">
            <div class="content" style="margin-left: 40px;">
                <h2 style="text-align: center;">ORDER SUCCESSFULLY CONFIRMED</h2>
                <p style="text-align: center;">Your order is successfully Confirmed. Thanks For Purchasing From Us. Your Order Id : <h3><?= $orderid ?></h3></p>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-12 hidden-xs my-order-list">

                <div class="orders-box">

                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center"><p class="th">Product</p></th>
                                <th class="text-center"><p class="th">Price</p></th>
                                <th class="text-center"><p class="th">Quantity</p></th>
                                <th class="text-center"><p class="th">Total</p></th>
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
                                    <td><?= $order_product->item_type == 1 ? 'Custom Perfume' : $product_detail->product_name; ?></td>
                                    <td><?= $order_product->amount ?></td>
                                    <td><?= $order_product->quantity ?></td>
                                    <td><?= $order_product->rate ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <div class="">
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 shipping">
                            <h5 class="product-heading text-right">Shipping Charges:</h5>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 shipping-cost">
                            <?php
                             $shipping_limit = Settings::findOne('1')->value;
                            $shipextra = Settings::findOne('2')->value;
                            $ship_charge = $subtotal <= $shipping_limit ? $shipextra : 0.00
                            ?>
                            <p class="text-right price"><?= sprintf('%0.2f', $ship_charge) ?></p>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 total">
                            <h5 class="product-heading text-right">Total:</h5>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 total-cost">
                            <p class="text-right price">AED <?= sprintf('%0.2f', $order_master->net_amount) ?></p>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>



    </body>
</html>