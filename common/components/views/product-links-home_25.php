<?php

use yii\helpers\Html;
?>
<div class="slider-item">
    <div class="product-block product-thumb transition">
        <div class="product-block-inner">
            <div class="image">
                <?php
                $product_image = Yii::$app->basePath . '/../uploads/product/' . $product_details->id . '/profile/' . $product_details->canonical_name . '.' . $product_details->profile;
                if (file_exists($product_image)) {
                    $image_src = Yii::$app->homeUrl . 'uploads/product/' . $product_details->id . '/profile/' . $product_details->canonical_name . '.' . $product_details->profile;
                } else {
                    $image_src = Yii::$app->homeUrl . 'uploads/product/dummy_perfume.png';
                }
//                $image_src = Yii::$app->homeUrl . 'image/cache/catalog/20-277x382.jpg';
                ?>
                <?= Html::a('<img  src="' . $image_src . '" alt="' . $product_details->canonical_name . '" class="img-responsive"/>', ['product/product-detail', 'product' => $product_details->canonical_name], ['title' => $product_details->product_name]) ?>
                <?php // Html::a('<img  src="' . $image_src . '" alt="' . $product_details->canonical_name . '" />', ['product/product-detail', 'product' => $product_details->canonical_name], ['title' => $product_details->product_name]) ?>
                <div class="product_hover">
                    <div class="hover_button">
                        <input type="hidden" id="quantity" value="1" />
                        <button class="button_cart add-cart" type="button"  data-placement="left" title="Buynow" pro_id="<?= $product_details->canonical_name ?>" data-original-title="Add to Cart"><i class="fa fa-shopping-cart"></i></button>
                        <button class="wishlist_button" type="button" data-toggle="tooltip" data-placement="left" title="" onclick="wishlist.add('30');" data-original-title="Add to WishList"><i class="fa fa-heart"></i></button>
                        <?= Html::a('<i class="fa fa-eye"></i>', ['product/product-detail', 'product' => $product_details->canonical_name], ['title' => $product_details->product_name, 'class' => 'quickview']) ?>
                    </div>
                    <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> </div>
                </div>
            </div>
            <div class="caption">
                <h4><?= Html::a(strlen($product_details->product_name) > 20 ? substr(strtoupper($product_details->product_name), 0, 20) . ".." : strtoupper($product_details->product_name), ['product/product-detail', 'product' => $product_details->canonical_name], ['title' => $product_details->product_name]) ?></h4>
                <p class="price">
                    <span class="price-new">AED110.00</span>
                    <span class="price-old">AED241.99</span>
                    <?php
                    if ($product_details->offer_price != "0" && isset($product_details->offer_price)) {
                        $percentage = round(100 - (($product_details->offer_price / $product_details->price) * 100));
                        ?>
                        <span class="price-off-percent"><?= $percentage ?>  % off</span>
                    <?php }
                    ?>
                </p>
            </div>
        </div>
    </div>
</div>