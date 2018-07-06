<?php

use yii\helpers\Html;
?>
<div class="col-md-3 gp_products_inner">
    <div class="all-product-box">
        <div class="main-product-image"> 
            <?php
            $product_image = Yii::$app->basePath . '/../uploads/product/' . $product_details->id . '/profile/' . $product_details->canonical_name . '.' . $product_details->profile;
            if (file_exists($product_image)) {
                $image_src = Yii::$app->homeUrl . 'uploads/product/' . $product_details->id . '/profile/' . $product_details->canonical_name . '.' . $product_details->profile;
            } else {
                $image_src = Yii::$app->homeUrl . 'uploads/product/dummy_perfume.png';
            }
//                $image_src = Yii::$app->homeUrl . 'image/cache/catalog/20-277x382.jpg';
            ?>

            <?php $image_link = '<div class="image-box" >
                    <div class="front face"> <img src="' . $image_src . '" class="img-responsive" > </div>
                    <div class="back face center"> <img src="' . $image_src . '" class="img-responsive" > </div>
                </div>';
            ?>
            <?= Html::a($image_link, ['product/product-detail', 'product' => $product_details->canonical_name]) ?>
            <div class="product_hover">
                <div class="hover_button">
                    <input type="hidden" id="quantity" value="1">
                    <button class="button_cart add-cart" type="button" data-placement="left" title="Buynow" pro_id="<?= $product_details->canonical_name ?>" data-original-title="Add to Cart"><i class="fa fa-shopping-cart"></i></button>
                    <button class="wishlist_button add_to_wish_list" id="<?= yii::$app->EncryptDecrypt->Encrypt('encrypt', $product_details->id) ?>" type="button" data-toggle="tooltip" data-placement="left" title="" data-original-title="Add to WishList"><i class="fa fa-heart"></i></button>
                    <?= Html::a('<i class="fa fa-eye"></i>', ['product/product-detail', 'product' => $product_details->canonical_name], ['title' => $product_details->product_name, 'class' => 'quickview']) ?>
                </div>
            </div>
        </div>
        <div class="caption">
            <h4 class="head-text"><?= Html::a(strlen($product_details->product_name) > 40 ? substr(strtoupper($product_details->product_name), 0, 40) . ".." : strtoupper($product_details->product_name), ['product/product-detail', 'product' => $product_details->canonical_name], ['title' => $product_details->product_name]) ?></h4>
            <?php
            if ($product_details->offer_price != "0" && isset($product_details->offer_price)) {
                $price = $product_details->offer_price;
                $percentage = round(100 - (($product_details->offer_price / $product_details->price) * 100));
                ?>
                <div class="off-price">
                    <span class="price-new"><?= $percentage ?>% OFF</span> <span class="price-old">AED <?= $product_details->price ?></span> 
                </div>
            <?php } else {
                $price = $product_details->price;
                ?>
            <?php }
            ?>
        </div>

        <div class="main-price"> <span class="amount">AED <?= $price ?></span> </div>
    </div>
</div>