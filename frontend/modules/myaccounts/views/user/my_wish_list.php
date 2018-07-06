<?php

use yii\helpers\Html;

$product = \common\models\Product::findOne($model->product);

use common\models\Fregrance;
?>
<style>
    .disabled {
        opacity: 0.65; 
        cursor: not-allowed;
        width: auto !important;
        float: right;
        margin-bottom: 0px !important;
        padding: 10px 15px !important;
        border: 1px solid #61b346 !important;
    }
</style>
<div class="in-main-order-box">
    <div class="order-box wishlist-box">
        <div class="box-header">

            <div class="row">
                <div class="col-xs-12">
                    <ul>
                        <li class="sub-title"><?= $product->product_name ?></li>
                    </ul>
                </div>
            </div>
        </div>
        <?php
        $product_image = Yii::$app->basePath . '/../uploads/product/' . $product->id . '/profile/' . $product->canonical_name . '_thumb.' . $product->profile;
        if (file_exists($product_image)) {
            $image = Yii::$app->homeUrl . 'uploads/product/' . $product->id . '/profile/' . $product->canonical_name . '_thumb.' . $product->profile;
        } else {
            $image = Yii::$app->homeUrl . 'uploads/product/profile_thumb.png';
        }
        ?>
        <div class="box-content">
            <div class="col-xs-12">
                <div class="col-xs-2">
                    <img class="img-responsive" src="<?= $image ?>" width="80" alt="1" height="80"/>
                </div>
                <div class="col-xs-6">
                    <?php $name = $product->product_name; ?>
                    <?= Html::a('<h6 class="product-title">' . $name . '</h6>', ['/product/product-detail', 'product' => $product->canonical_name], ['target' => '_blank']) ?>

                    <?php
                    $fregrance = Fregrance::findOne($product->product_type)->name;
                    ?>
                    <?= Html::a('<p class = "fregrance">' . $fregrance . '</p>', ['/product-detail/' . $product->canonical_name], ['target' => '_blank']) ?>
                    <?php if ($product->stock_availability == 1 && $product->stock > 0) { ?>
                        <span class="stock">In Stock</span>
                        <?php
                    } else {
                        echo '<span style="color:red">Out of Stock</span>';
                    }
                    ?>
                </div>

            </div>
        </div>
        <div style="clear:both"></div>
        <div style="clear:both"></div>
        <div class="horizontal-line"></div>
        <div class="box-footer">
            <div class="col-xs-12">
                <?= Html::a('Remove', 'javascript:void(0)', ['class' => 'remove-wish-list btn shadowbtn bt-right', 'pro_id' => $product->canonical_name, 'data-val' => $model->id]) ?>
                <?php if ($product->stock_availability == 1 && $product->stock > 0) { ?>
                    <?= Html::a('add to cart', 'javascript:void(0)', ['class' => 'add-cart btn shadowbtn bt-right', 'pro_id' => $product->canonical_name, 'data-val' => $model->id]) ?>
                <?php } else { ?>
                    <?= Html::a('Add to Cart', 'javascript:void(0)', ['class' => 'disabled btn shadowbtn bt-right']) ?>
                <?php } ?>
                <input type="hidden" id="quantity" value= "1">
            </div>
        </div>
    </div>
</div>

