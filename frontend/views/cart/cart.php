<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Product;
use common\models\User;

$this->title = 'Shopping Cart';
?>
<div class="content_breadcum">
    <div class="container">
        <ul class="breadcrumb">
            <li><?= Html::a('<i class="fa fa-home"></i>', ['/site/index']) ?></li>
            <li><a href="">Cart</a></li>
        </ul>
        <h1 class="page-title">Cart</h1>

    </div>
</div>
<section class="in-cart-page">
    <div class="container">
        <div class="row">

            <div class="col-sm-12">
                <!--<form action="" method="post">-->
                <div class="table-responsive">
                    <input type="hidden" id="cart_count" value="<?= count($cart_items); ?>">
                    <table class="table table-bordered shopping-cart">
                        <thead>
                            <tr>
                                <td class="text-center">Image</td>
                                <td class="text-left">Product Name</td>
                                <!--<td class="text-left">Model</td>-->
                                <td class="text-left">Quantity</td>
                                <td class="text-right">Unit Price</td>
                                <td class="text-right">Total</td>
                                <td class="text-right">&nbsp;</td>
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
                                    $image = '<img src="' . Yii::$app->homeUrl . 'uploads/product/' . $prod_details->id . '/profile/' . $prod_details->canonical_name . '_thumb.' . $prod_details->profile . '" alt="' . $prod_details->canonical_name . '" title="' . $prod_details->product_name . '" class="img-thumbnail"/>';
                                } else {
                                    $image = '<img src="' . Yii::$app->homeUrl . 'uploads/product/profile_thumb.png" alt="" class="img-thumbnail"/>';
                                }
                                
                                ?>
                                <tr class="cart_item tr_<?= yii::$app->EncryptDecrypt->Encrypt('encrypt', $cart_item->id); ?>">
                                    <td class="text-center"><a href="<?= Yii::$app->homeUrl . 'product-detail/' . $prod_details ->canonical_name ?>"><?= $image ?></a></td>
                                    <td class="text-left"><a href="<?= Yii::$app->homeUrl . 'product-detail/' . $prod_details ->canonical_name ?>"><?= ucwords($prod_details->product_name) ?></a> <br>
    <!--                                            <small>Delivery Date: 2011-04-22</small> <br>
                                        <small>Reward Points: 300</small></td>-->
                                    <!--<td class="text-left">Product 21</td>-->
                                    <td class="text-left"><div class="input-group btn-block" style="max-width: 200px;">
                                            <input  type="number" min="1" max="<?= $prod_details->stock ?>" step="1" value="<?= $cart_item->quantity ?>" id="quantity_<?= yii::$app->EncryptDecrypt->Encrypt('encrypt', $cart_item->id); ?>" class="cart_quantity form-control">
    <!--                                                <input type="text" name="quantity[139]" value="1" size="1" class="form-control">
                                            <span class="input-group-btn">
                                                <button type="submit" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Update"><i class="fa fa-refresh"></i></button>
                                                <button type="button" data-toggle="tooltip" title="" class="btn btn-danger" onclick="cart.remove('139');" data-original-title="Remove"><i class="fa fa-times-circle"></i></button>
                                            </span>-->
                                        </div></td>
                                    <td class="text-right"><span class="amount">AED <?= sprintf("%0.2f", $price) ?></span></td>
                                    <?php $total = $price * $cart_item->quantity; ?>
                                    <td class="text-right">
                                        <span class="amount" id="total_<?= yii::$app->EncryptDecrypt->Encrypt('encrypt', $cart_item->id) ?>">AED <?= sprintf("%0.2f", $total) ?></span>
                                    </td>

                                    <td class="product-remove">
                                        <a class="btn btn-danger remove_cart" title="Remove this item" data-product_id="<?= yii::$app->EncryptDecrypt->Encrypt('encrypt', $cart_item->id); ?>">×</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                     <div class="gift_wrapp">
                        <input type="checkbox" name="gift-wrap" id="gift-wrap" class="checkbox1 gift-wrap"><span>Gift wrap</span>
                    </div>
                </div>
                <!--</form>-->
                <!--<h3>What would you like to do next?</h3>
                <p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
                <div class="panel-group" id="accordion">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title"><a href="#collapse-coupon" class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" aria-expanded="false">Use Coupon Code <i class="fa fa-caret-down"></i></a></h4>
                        </div>
                        <div id="collapse-coupon" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                            <div class="panel-body">
                                <label class="col-sm-2 control-label" for="input-coupon">Enter your coupon here</label>
                                <div class="input-group">
                                    <input type="text" name="coupon" value="" placeholder="Enter your coupon here" id="input-coupon" class="form-control">
                                    <span class="input-group-btn">
                                        <input type="button" value="Apply Coupon" id="button-coupon" data-loading-text="Loading..." class="btn btn-primary">
                                    </span></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title"><a href="#collapse-voucher" data-toggle="collapse" data-parent="#accordion" class="accordion-toggle collapsed" aria-expanded="false">Use Gift Certificate <i class="fa fa-caret-down"></i></a></h4>
                        </div>
                        <div id="collapse-voucher" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                            <div class="panel-body">
                                <label class="col-sm-2 control-label" for="input-voucher">Enter your gift certificate code here</label>
                                <div class="input-group">
                                    <input type="text" name="voucher" value="" placeholder="Enter your gift certificate code here" id="input-voucher" class="form-control">
                                    <span class="input-group-btn">
                                        <input type="submit" value="Apply Gift Certificate" id="button-voucher" data-loading-text="Loading..." class="btn btn-primary">
                                    </span> </div>
                            </div>
                        </div>
                    </div>
                </div>-->
                <br>
                <div class="row">
                    <div class="col-sm-4 col-sm-offset-8">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td class="text-right"><strong>Sub-Total:</strong></td>
                                    <td class="text-right"><span class="amount cart_subtotal">AED <?= sprintf("%0.2f", $subtotal) ?></span></td>
                                </tr>
                                <tr>
                                    <td class="text-right"><strong>Shipping:</strong></td>
                                    <td class="text-right"><span class="amount shipping-cost">AED <?= sprintf("%0.2f", $shipping) ?></span></td>
                                </tr>
<!--                                <tr>
                                    <td class="text-right"><strong>VAT (20%):</strong></td>
                                    <td class="text-right">$20.00</td>
                                </tr>-->
                                <tr>
                                    <td class="text-right"><strong>Total:</strong></td>
                                    <td class="text-right"><span class="amount grand_total">AED <?= sprintf("%0.2f", $grand_total) ?></span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="buttons clearfix">
                    <!--<div class="pull-left"><a href="http://opencart.templatemela.com/OPC09/OPC090218/index.php?route=common/home" class="btn btn-default">Continue Shopping</a></div>-->
                    <div class="pull-right">
                        <?php if (empty(Yii::$app->user->identity)) { ?>
                            <a href="<?= Yii::$app->homeUrl . 'site/login-signup' ?>" class="btn btn-primary">Login to Checkout</a>
                        <?php } else { ?>
                            <a href="<?= Yii::$app->homeUrl . 'cart/proceed' ?>" class="btn btn-primary">Checkout</a>
                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<input type="hidden" class="grand_total_value" value="<?= $grand_total ?>">
<input type="hidden" name="subb_total" id="subb_total" value="<?= $subtotal ?>">
<input type="hidden" name="gift_wrapp" id="gift_wrapp" value="<?= Yii::$app->session['gift_wrap'] ?>">
<?php $giftwrap = \common\models\Settings::findOne(5)->value; ?>
<span class="giftwrap_value" style="display:none"><?= $giftwrap ?></span>
<?php $shipping_minimum = common\models\Settings::findOne(1)->value; ?>
<span class="min_ship_amount" style="display:none"><?= $shipping_minimum ?></span>
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
<script>
    $(document).ready(function () {
        $('.gift-wrap').change(function () {
//        $('#gift-wrap').change(function () {
            var id = $(this).attr('id');
            var giftwrap = $('.giftwrap_value').html();
//            var ship_charge_gift = $('.min_ship_amount').html();
            var grand = $('.grand_total_value').val();
            if ($("#" + id).prop('checked') == true) {
//            if ($("#gift-wrap").prop('checked') == true) {
                $('.gift-wrap').prop('checked', true);
                var value = 1;
            } else {
                $('.gift-wrap').prop('checked', false);
                var value = 0;
            }

            var subtotal = $('#subb_total').val();

            $.ajax({
//            url: $base_url + 'event_item/select_event',
                url: homeUrl + 'cart/set-gift-wrap',
                type: "post",
                data: {value: value},
                success: function (data) {
                    if (data === '1') {
                        var result = +subtotal + parseFloat(giftwrap);
                        var grand_total = parseFloat(grand) + parseFloat(giftwrap);
                        $('.gift_wrapp').val(1);
//                        $('#gift_wrapp').val(1);
                        $('.cart_subtotal').html('AED ' + result.toFixed(2));
                        $('#subb_total').val(result);
                        $('.grand_total').html('AED ' + grand_total.toFixed(2));
                        $('.grand_total_value').val(grand_total);

                    } else {
                        var result = subtotal - parseFloat(giftwrap);
                        var grand_total = parseFloat(grand) - parseFloat(giftwrap);
                        $('.gift_wrapp').val(0);
                        $('.cart_subtotal').html('AED ' + result.toFixed(2));
                        $('#subb_total').val(result);
                        $('.grand_total').html('AED ' + grand_total.toFixed(2));
                        $('.grand_total_value').val(grand_total);
                    }
//                    if (parseFloat(ship_charge_gift) > parseFloat(result)) {
//                        $('.free-shipping').removeClass('hide');
//                        var balance_ship = ship_charge_gift - result;
//                        $('.remain_freeship').html(balance_ship);
//                    } else {
//                        $('.free-shipping').addClass('hide');
//                    }
                }, error: function () {
//					alert('Image Cannot be delete');
                }
            });
        });
    });
</script>