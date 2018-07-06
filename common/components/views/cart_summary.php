<?php

use yii\helpers\Html;
use common\models\Product;
use common\models\Fregrance;
use common\models\OrderMaster;
use common\models\Settings;
use common\models\Tax;
?>
<div class="summery-box lit-blue">
    <div class="heading active">
        <p>SUMMARY</p>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: left;"><p><?= count($cart_items); ?> Items</p></div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <?php
        foreach ($cart_items as $cart) {
            $tax = 0;
            ?>
            <?php
            $product = Product::findOne($cart->product_id);

            $product_image = Yii::$app->basePath . '/../uploads/product/' . $product->id . '/profile/' . $product->canonical_name . '.' . $product->profile;
            if (file_exists($product_image)) {
                $image = Yii::$app->homeUrl . 'uploads/product/' . $product->id . '/profile/' . $product->canonical_name . '_thumb.' . $product->profile;
            } else {
                $image = Yii::$app->homeUrl . 'uploads/product/profile_thumb.png';
            }
            if ($product->offer_price == '0' || $product->offer_price == '') {
                $price = $product->price;
            } else {
                $price = $product->offer_price;
            }

            if (isset($cart->tax))
                $tax = $cart->tax;
//			$tax_amount += $tax;
//			$total = $price * $cart->quantity;
            $produt_total = $cart->rate - ($cart->tax * $cart->quantity);
//			$totall += $produt_total;
            ?>
            <div class="media">
                <a class="thumbnail col-lg-2 col-md-2 col-sm-2 col-xs-2" href="#"> <img class="media-object" src="<?= $image ?>"> </a>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="top: 10px; text-align: left">
                    <h4 class="product-heading"><a href="#" title='<?= $product->product_name; ?>'><?= substr($product->product_name, 0, 23); ?></a></h4>

                    <h5 class="brand-name"><a href="#"><?= Fregrance::findOne($product->product_type)->name; ?></a></h5>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="top: 15px; text-align: right; padding-right: 0;">
                    <p class="price">AED <?= sprintf('%0.3f', $produt_total) ?></p>
                </div>
            </div>
        <?php } ?>
        <br/>
    </div>
    <div class=" sub-total">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 pad-0" style="padding: 15px 15px; border-top: 1px solid #ddd; border-right: 1px solid #ddd;">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 cart-summary-subtotal">Subtotal</div>
           <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">Tax (5%)</div>
            <?php if (isset($promotions) && $promotions > 0) { ?>      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 cart-summary-promotion-discount">Promotion Code Added</div> <?php } ?>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">Shipping Charges</div>
            <?php
            if ($master->gift_wrap == 1) {
                ?>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">Gift Wrap Charges</div>
                <?php
            }
            ?>


        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 pad-0" style="padding: 15px 15px; border-top: 1px solid #ddd;">
            <?php $subtotal = $master->total_amount - $master->tax_amount;?>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 price cart-summary-subtotal-amount"><?= sprintf('%0.3f', $subtotal) ?></div>
           <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 price"><?= sprintf('%0.3f', $master->tax_amount) ?></div>
            <?php
            $promotion_disvount = 0;
            if (isset($promotions) && $promotions > 0) {
                $promotion_disvount = $promotions;
                ?> <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 price cart-summary-promotion-amount"><?= sprintf('%0.2f', $promotions) ?></div><?php } ?>

            
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 price"><?= $master->shipping_charge ?></div>
            <?php
            if ($master->gift_wrap == 1) {
                ?>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 price"><?= sprintf('%0.2f', $master->gift_wrap_value) ?></div>
                <?php
            }
            ?>

        </div>
    </div>
    <div class="total">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 pad-0" style="padding: 15px 15px; border-top: 1px solid #ddd; border-right: 1px solid #ddd;">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">Total  ( tax incl )</div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 pad-0" style="padding: 15px 15px; border-top: 1px solid #ddd;">
            
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 price">AED <?= sprintf('%0.2f', $master->net_amount) ?></div>
        </div>
    </div>
</div>