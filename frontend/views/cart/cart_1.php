<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Product;
use common\models\User;

$this->title = 'Shopping Cart';
?>
<div class="cart-page pbtm40  anyflexbox woocommerce-cart">
    <div class="content_breadcum" style="background-position: 50% 0px;"></div>
    <div data-vc-full-width="true" data-vc-full-width-init="true" class="vc_row wpb_row vc_row-fluid  vc_custom_ vc_row-has-fill   vc_hidden" style="position: relative; left: 0px; box-sizing: border-box; width: 1349px; padding-left: 0px; padding-right: 0px; margin: 0 auto; margin-bottom: 35px; margin-top: 15px; background: #1a1a1a; opacity: 1; ">
        <div class="container">
            <!--<h1 class="page-title">Contact Us</h1>-->
            <ul class="breadcrumb">
                <li><?= Html::a('<span>Home</span>', ['/site/index'], ['class' => '']) ?></li>
                <li class="active">My Cart</li>
            </ul>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div id="wpo-content" class="wpo-content col-xs-12 no-sidebar">
                <article id="post-8" class="post-8 page type-page status-publish hentry">
                    <div class="content">
                        <div class="woocommerce">
                            <form action="" method="post">

                                <input type="hidden" id="cart_count" value="<?= count($cart_items); ?>">
                                <table class="shop_table cart" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="product-remove">&nbsp;</th>
                                            <th class="product-thumbnail">&nbsp;</th>
                                            <th class="product-name">Product</th>
                                            <th class="product-price">Price</th>
                                            <th class="product-quantity">Quantity</th>
                                            <th class="product-subtotal">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($cart_items as $cart_item) {
                                            $prod_details = Product::find()->where(['id' => $cart_item->product_id, 'status' => '1'])->one();
                                            if ($prod_details->offer_price == '0' || $prod_details->offer_price == '') {
                                                $price = $prod_details->price;
                                            } else {
                                                $price = $prod_details->offer_price;
                                            }
                                            $product_image = Yii::$app->basePath . '/../uploads/product/' . $prod_details->id . '/profile/' . $prod_details->canonical_name . '.' . $prod_details->profile;
                                            if (file_exists($product_image)) {
                                                $image = '<img src="' . Yii::$app->homeUrl . 'uploads/product/' . $prod_details->id . '/profile/' . $prod_details->canonical_name . '_thumb.' . $prod_details->profile . '" alt="' . $prod_details->canonical_name . '" class="attachment-shop_thumbnail wp-post-image"/>';
                                            } else {
                                                $image = '<img src="' . Yii::$app->homeUrl . 'uploads/product/profile_thumb.png" alt="" class="attachment-shop_thumbnail wp-post-image"/>';
                                            }
                                            ?>
                                            <tr class="cart_item tr_<?= yii::$app->EncryptDecrypt->Encrypt('encrypt', $cart_item->id); ?>">

                                                <td class="product-remove">
                                                    <a class="remove remove_cart" title="Remove this item" data-product_id="<?= yii::$app->EncryptDecrypt->Encrypt('encrypt', $cart_item->id); ?>">×</a>
                                                </td>

                                                <td class="product-thumbnail">
                                                    <a href="<?= Yii::$app->homeUrl . 'product-detail/' . $product_details->canonical_name ?>"><?= $image ?></a>
                                                    <!--<a href=""><img src="images/products/1.jpg" class="attachment-shop_thumbnail wp-post-image" alt="product16"></a>-->
                                                </td>

                                                <td class="product-name">
                                                    <a href="<?= Yii::$app->homeUrl . 'product-detail/' . $product_details->canonical_name ?>"><?= ucwords($prod_details->product_name) ?> </a> </td>

                                                <td class="product-price">
                                                    <span class="amount">AED <?= sprintf("%0.2f", $price) ?></span> </td>

                                                <td class="product-quantity">
                                                    <div class="quantity-adder">
                                                        <div class="quantity">
                                                            <input type="number" min="1" max="<?= $prod_details->stock ?>" step="1" value="<?= $cart_item->quantity ?>" id="quantity_<?= yii::$app->EncryptDecrypt->Encrypt('encrypt', $cart_item->id); ?>" class="cart_quantity">
                                                        </div>
                                                        <!--                                                        <div class="quantity buttons_added"><input type="button" value="-" class="minus">
                                                                                                                    <input type="number" step="1" min="1" max="<?= $prod_details->stock ?>" name="cart[7f6ffaa6bb0b408017b62254211691b5][qty]" value="<?= $cart_item->quantity ?>" title="Qty" class="input-text qty cart_quantity text" id="quantity_<?= yii::$app->EncryptDecrypt->Encrypt('encrypt', $cart_item->id); ?> size="4">
                                                                                                                    <input type="button" value="+" class="plus"></div>-->
                                                        <label><?= $prod_details->stock ?> available</label>
                                                    </div>
                                                </td>

                                                <td class="product-subtotal">
                                                    <?php $total = $price * $cart_item->quantity; ?>
                                                    <span class="amount" id="total_<?= yii::$app->EncryptDecrypt->Encrypt('encrypt', $cart_item->id) ?>">AED <?= sprintf("%0.2f", $total) ?></span> </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>


                            </form>

                            <div class="cart-collaterals">

                                <div class="cart_totals ">


                                    <div class="box-heading"><span>Cart Totals</span></div>

                                    <table cellspacing="0" class="table-cart">

                                        <tbody>
                                            <tr class="cart-subtotal">
                                                <th>Subtotal</th>
                                                <td><span class="amount cart_subtotal">AED <?= sprintf("%0.2f", $subtotal) ?></span></td>
                                            </tr>




                                            <tr class="shipping">
                                                <th>Shipping</th>
                                                <td>


                                                    <ul id="shipping_method">
                                                        <?php
                                                        if ($shipping == '0') {
                                                            $free = '';
                                                            $charge = 'hide';
                                                        } else {
                                                            $charge = '';
                                                            $free = 'hide';
                                                        }
                                                        ?>
                                                        <li class="free_shipping <?= $free ?>">
                                                            <input type="radio" name="shipping_method[0]" data-index="0" id="shipping_method_0_free_shipping" value="free_shipping"  class="shipping_method" checked="checked" disabled="disabled">
                                                            <label for="shipping_method_0_free_shipping">Free Shipping</label>
                                                        </li>
                                                        <?php // } else {   ?>
                                                        <li class="shipping_ <?= $charge ?>">
                                                                <!--<input type="radio" name="shipping_method_[0]" data-index="0" id="shipping_method_0_international_delivery" value="international_delivery" class="shipping_method" checked="checked" disabled="disabled">-->
                                                            <label for="shipping_method_0_international_delivery"> <span class="amount shipping-cost">AED <?= sprintf("%0.2f", $ship_charge) ?></span></label>
                                                        </li>
                                                    </ul>

                                                </td>
                                            </tr>






                                            <tr class="order-total">
                                                <th>Total</th>
                                                <td><strong><span class="amount grand_total">AED <?= sprintf("%0.2f", $grand_total) ?></span></strong> </td>
                                            </tr>


                                        </tbody>
                                    </table>


                                    <div class="wc-proceed-to-checkout">
                                        <?php
                                        if (empty(Yii::$app->user->identity)) {
                                            ?>
                                            <a href="<?= Yii::$app->homeUrl . 'site/login-signup?go=' . Yii::$app->request->hostInfo . Yii::$app->homeUrl . Yii::$app->controller->id . '/' . Yii::$app->controller->action->id ?>" class="checkout-button button alt wc-forward">Login to Checkout</a>
                                        <?php } else { ?>
                                            <a href="<?= Yii::$app->homeUrl . 'cart/proceed' ?>" class="checkout-button button alt wc-forward">Proceed to Checkout</a>
                                        <?php } ?>
                                    </div>


                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- .entry-content -->
                </article>
                <!-- #post -->
            </div>
        </div>
    </div>
</div>
<script>
    jQuery('<div class="quantity-nav"><div class="quantity-button quantity-up">+</div><div class="quantity-button quantity-down">-</div></div>').insertAfter('.quantity input');
    jQuery('.quantity').each(function () {
        var spinner = jQuery(this),
                input = spinner.find('input[type="number"]'),
                btnUp = spinner.find('.quantity-up'),
                btnDown = spinner.find('.quantity-down'),
                min = input.attr('min'),
                max = input.attr('max');

        btnUp.click(function () {
            var oldValue = parseFloat(input.val());
            if (oldValue >= max) {
                var newVal = oldValue;
            } else {
                var newVal = oldValue + 1;
            }
            spinner.find("input").val(newVal);
            spinner.find("input").trigger("change");
        });

        btnDown.click(function () {
            var oldValue = parseFloat(input.val());
            if (oldValue <= min) {
                var newVal = oldValue;
            } else {
                var newVal = oldValue - 1;
            }
            spinner.find("input").val(newVal);
            spinner.find("input").trigger("change");
        });

    });
</script>