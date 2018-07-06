<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\components\CartSummaryWidget;
use common\models\Product;
use common\models\Fregrance;
use common\models\Settings;

$this->title = 'Checkout-Confirm';
?>
<div class="cart-page pbtm40  anyflexbox woocommerce-cart">
    <div class="content_breadcum" style="background-position: 50% 0px;"></div>

    <div id="checkout" class="my-account">
        <div class="container">
            <div class="col-lg-7 col-md-7 col-sm-12 left-accordation checkout-billing">

                <h3>Confirm Order</h3>
                <div class="horizontal-line"></div>
                <div class="content lit-blue">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <?php $form = ActiveForm::begin(); ?>
                        <div class="content lit-blue delivery-details col-xs-pad40-0">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <table class="table margin-auto">
                                    <thead>
                                        <tr>
                                            <th class="text-left">Product</th>
                                            <th class="text-right">Quantity</th>
                                            <th class="text-right">Unit Price</th>
                                            <th class="text-right">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($order_details) {
                                            $tax_amount = 0;
                                            foreach ($order_details as $order) {
                                                $tax = 0;
                                                if ($order->item_type == 1) {
                                                    $product = \common\models\CreateYourOwn::findOne($order->product_id);

                                                    $bottles = \common\models\Bottle::findOne($product->bottle);
                                                } else {
                                                    $product = Product::findOne($order->product_id);
                                                    $product_type = Fregrance::findOne($product->product_type);

                                                    if (isset($order->tax))
                                                        $tax = $order->tax;
//
                                                    $tax_amount += $tax;
                                                }
                                                ?>
                                                <tr>
                                                    <td class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                        <div class="media-body">
                                                            <h5 class="product-heading"><?= $order->item_type == 1 ? 'Custom Perfume' : $product->product_name; ?></h5>
                                                            <?php
                                                            $label1 = '';
                                                            $label2 = '';
                                                            if (isset($product->label_1)) {
                                                                $label1 = $product->label_1;
                                                            }
                                                            if (isset($product->label_2)) {
                                                                $label2 = $product->label_2;
                                                            }
                                                            ?>
                                                            <h5 class="brand-name"><?= $order->item_type == 1 ? $label1 . ' , ' . $label2 : $product_type->name; ?></h5>
                                                        </div>
                                                    </td>
                                                    <td class="col-lg-2 col-md-2 col-sm-2 col-xs-2 text-right quantity"><?= $order->quantity ?></td>
                                                    <?php
                                                    $prdct_tax = $order->tax / $order->quantity;
                                                    $amount = $order->amount - $prdct_tax;
                                                    ?>
                                                    <td class="col-lg-2 col-md-2 col-sm-2 col-xs-2 text-right price">AED <?= sprintf('%0.3f', $amount) ?></td>
                                                    <?php
                                                    $rate = $order->rate;
                                                    $produt_total = $rate - $order->tax;
                                                    ?>
                                                    <td class = "col-lg-2 col-md-2 col-sm-2 col-xs-2 text-right price">AED <?= sprintf('%0.3f', $produt_total) ?></td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <div class="">
                                    <?php
                                    $promotion_disvount = 0;
                                    if (isset($promotions) && $promotions > 0) {
                                        $promotion_disvount = $promotions;
                                        ?>
                                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 shipping">
                                            <h5 class="product-heading text-right">Promotion Code Added:</h5>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 shipping-cost">

                                            <p class="text-right price"><?= sprintf('%0.2f', $promotions) ?></p>
                                        </div>
                                    <?php } ?>

                                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 shipping">
                                        <h5 class="product-heading text-right">Tax (5%):</h5>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 shipping-cost">

                                        <p class="text-right price"><?= sprintf('%0.3f', $order_master->tax_amount) ?></p>
                                    </div>

                                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 shipping">
                                        <h5 class="product-heading text-right">Shipping Charges:</h5>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 shipping-cost">
                                        <?php
                            $shipextra = Settings::findOne('2')->value;
                            $ship_charge = $subtotal <= $shipping_limit ? $shipextra : 0.00
                                        ?>
                                        <p class="text-right price"><?= sprintf('%0.2f', $order_master->shipping_charge) ?></p>
                                    </div>
                                    <?php
                                    if ($order_master->gift_wrap == 1) {
                                        ?>
                                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 shipping">
                                            <h5 class="product-heading text-right">Gift Wrap Charges:</h5>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 shipping-cost">
                                            <p class="text-right price"><?= sprintf('%0.2f', $order_master->gift_wrap_value) ?></p>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 total">
                                        <h5 class="product-heading text-right">Total:</h5>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 total-cost">
                                        <?php
                                        if ($order_master->gift_wrap == 1) {
                                            ?>
                                            <?php $grand_total = ($subtotal + $ship_charge + $order_master->gift_wrap_value) - $promotions ?>
                                        <?php } else { ?>
                                            <?php $grand_total = ($subtotal + $ship_charge) - $promotions ?>
                                        <?php } ?>
                                        <p class="text-right price">AED <?= sprintf('%0.2f', $order_master->net_amount) ?></p>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <br>
                                <textarea name="user_comment" class="form-control" placeholder="User comment"></textarea>
                                <div class="clearfix"></div>
                                <br>
                                <div class="conform-payment">
                                    <label id="Radio0">
                                        <input type="radio" name="payment_method" value="1" data-waschecked="true">Cash On delivery
                                    </label>
                                    <label id="Radio0">
                                        <input type="radio" name="payment_method" value="2" data-waschecked="true">Payment Gateway
                                    </label>
                                    <p class="alert-payment" style="display: none">Select Any Payment Mode</p>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 lit-blue" style="padding: 0 30px;padding-right: 55px; padding-bottom: 30px; margin-bottom: 5px;">
                            <?= Html::submitButton('Confirm order', ['class' => 'green2', 'id' => 'confirm']) ?>

                        </div>

                    </div>
                </div>

                <?php ActiveForm::end(); ?>

            </div>

            <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 product-summery">
                <?= CartSummaryWidget::widget(); ?>
            </div>

        </div>
    </div>
</div>