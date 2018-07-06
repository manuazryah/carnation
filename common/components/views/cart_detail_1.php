<?php

use yii\helpers\Html;
use common\models\Cart;
use common\models\Product;
use common\models\Unit;

$condition = Cart::usercheck();
$cart_contents = Cart::find()->where($condition)->all();
if (!empty($cart_contents)) {
    $cart_total = Cart::total($cart_contents);
    ?>
    <div class="cart-info"> <span class="count">2 item(s)</span>
        <span class="price"><span class="amount"><span class="Price-currencySymbol">&#36;</span>0.00</span>
        </span></div>
    <input type="hidden" value="0" id="cart_number">
    <div  class="blockcart">
        <ul>
            <?php
            $content = '';
            $i = 0;
            foreach ($cart_contents as $cart_content) {
                $i++;
                $prod_details = Product::find()->where(['id' => $cart_content->product_id, 'status' => '1'])->one();
                $unit = Unit::findOne($prod_details->size_unit)->unit_name;
                if ($prod_details->offer_price == '0' || $prod_details->offer_price == '') {
                    $price = $prod_details->price;
                } else {
                    $price = $prod_details->offer_price;
                }
                $product_image = Yii::$app->basePath . '/../uploads/product/' . $prod_details->id . '/profile/' . $prod_details->canonical_name . '.' . $prod_details->profile;
                if (file_exists($product_image)) {
                    $image = '<img class="product-image img-responsive" src="' . yii::$app->homeUrl . 'uploads/product/' . $prod_details->id . '/profile/' . $prod_details->canonical_name . '_thumb.' . $prod_details->profile . '" alt="" title="" width="100" height="100">';
//                $image = '<img src="' . Yii::$app->homeUrl . 'uploads/product/' . $prod_details->id . '/profile/' . $prod_details->canonical_name . '_thumb.' . $prod_details->profile . '" alt="' . $prod_details->canonical_name . '" />';
                } else {
                    $image = '<img src="' . Yii::$app->homeUrl . 'uploads/product/profile_thumb.png" alt=""/>';
                }
                $product_name = $prod_details->product_name;
                if (strlen($product_name) > 25) {
                    $str = substr($product_name, 0, 25) . '...';
                } else {
                    $str = $product_name;
                }
                ?>
                <li>
                    <div class="img_content">
                        <?= Html::a($image, ['product/product-detail', 'product' => $prod_details->canonical_name], ['title' => $product_name]) ?>
                        <span class="product-quantity"><?= $cart_content->quantity ?> x</span>
                    </div>
                    <div class="right_block">
                        <?= Html::a('<span class="product-name">' . $str . '</span>', ['product/product-detail', 'product' => $prod_details->canonical_name], ['title' => $product_name, 'class' => '']) ?>

                        <span class="product-price">AED <?= sprintf("%0.2f", $price) ?></span>
                        <a class="remove-from-cart remove_cart_product" rel="nofollow" href="" data-product_id="<?= yii::$app->EncryptDecrypt->Encrypt('encrypt', $cart_content->id) ?>" data-link-action="remove-from-cart" title="Remove from cart">
                            <i class="fa fa-remove"></i>
                        </a>
                        <div class="attributes_content">
                            <span><strong>Size</strong>: <?= $prod_details->size ?> <?= $unit ?></span><br>
                        </div>
                    </div>
                </li>
                <?php
            }
            ?>
        </ul>
        <div class="price_content">

            <div class="cart-total price_inline">
                <span class="label">Total</span>
                <span class="value">AED <?= sprintf("%0.2f", $cart_total) ?></span>
            </div>
        </div>
        <div class="checkout">
            <?= Html::a('View Cart', ['cart/mycart'], ['class' => 'btn btn-primary']) ?>
        </div>
        <div class="checkout">
            <?= Html::a('Checkout', ['cart/proceed'], ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
    <?php
}