<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use common\models\OrderDetails;
use common\models\Product;
use common\models\Fregrance;
use common\models\Settings;

$order_products = OrderDetails::find()->where(['order_id' => $model->order_id])->all();
?>

<div class="col-lg-8 col-md-8 col-sm-12 hidden-xs my-order-list">

    <div class="orders-box">
        <div class="track">
            <button class="product-id"><?= $model->order_id ?></button>
            <?php if ($model->payment_status != '1') { ?>
                <?= Html::a('<i class="" aria-hidden="true"></i>Continue', ['/checkout/continue', 'id' => $model->order_id], ['class' => 'track-btn btn-success'])
                ?>
            <?php } ?>
            <?= Html::a('<i class="fa fa-ban" aria-hidden="true"></i>Cancel', ['/myaccounts/my-orders/cancel-order', 'id' => $model->order_id], ['class' => 'track-btn']) ?>
        </div>
        <?php
        foreach ($order_products as $order_product) {

            $product_detail = Product::find()->where(['id' => $order_product->product_id])->one();
            ?>
            <div class="ordered-pro-dtls">
                <div class="pro-img-box col-lg-2 col-md-2 col-sm-2 col-xs-2">
                    <?= Html::a('<img src="' . Yii::$app->homeUrl . 'uploads/product/' . $product_detail->id . '/profile/' . $product_detail->canonical_name . '_thumb.' . $product_detail->profile . '" height="100%" alt="1" />', ['/product/product_detail', 'product' => $product_detail->canonical_name], ['target' => '_blank']) ?>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <?= Html::a('<p class="cart-pro-heading">' . $product_detail->product_name . '</p>', ['/product/product_detail', 'product' => $product_detail->canonical_name], ['target' => '_blank']) ?>
                    <?php $product_type = Fregrance::findOne($product_detail->product_type); ?>
                    <?= Html::a('<p class="cart-pro-subheading">' . $product_type->name . '</p>', ['/product/product_detail', 'product' => $product_detail->canonical_name], ['target' => '_blank']) ?>
                    </a>
                </div>
                <?php
                if ($product_detail->offer_price == '0' || $product_detail->offer_price == '') {
                    $price = $product_detail->price;
                } else {
                    $price = $product_detail->offer_price;
                }
                ?>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 price">AED  <?= $price; ?></div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 price">Quantity : <?= $order_product->quantity; ?></div>
                <?php
                if ($order_product->item_type != '1' && $model->payment_status != '1') {
                    if ($product_detail->stock_availability == '1') {
                        if ($product_detail->stock < $order_product->quantity) {
                            ?>
                            <div class = "col-lg-2 col-md-2 col-sm-2 col-xs-2 price" style="color: red"><?= $product_detail->stock != 0 ? $product_detail->stock . ' Available' : 'Out Of Stock' ?></div>
                            <?php
                        }
                    } else {
                        ?>
                        <div class = "col-lg-2 col-md-2 col-sm-2 col-xs-2 price" style="color: red">Out Of Stock</div>
                        <?php
                    }
                }
                ?>

                <?php if ($order_product->status == 1) { ?>
                    <div class=" col-lg-4 col-md-4 col-sm-4 col-xs-4 delivered-date">Delivered on <?= date('D, M dS y', strtotime($order_product->delivered_date)) ?>
                        <span>Your item has been delivered</span>
                    </div>
                <?php } else { ?>
                    <div class=" col-lg-4 col-md-4 col-sm-4 col-xs-4 delivered-date" style="min-width: 300px;
                         max-width: 300px;">
                        <span></span>
                    </div>
                <?php } ?>
            </div>

            <?php
        }
        ?>

        <div>
            <?php
            $promotions = \common\models\OrderPromotions::find()->where(['order_master_id' => $model->id])->sum('promotion_discount');
            if (isset($promotions) && $promotions > 0) {
                ?>

                <div class="pro-img-box col-lg-2 col-md-2 col-sm-2 col-xs-2"></div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">Promotion Code Added</div>

                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">AED  <?= $promotions; ?></div>
            <?php } ?>
        </div>
        <div style="clear:both"></div>
        <div>
            <?php
            $shipping_limit = Settings::findOne('1')->value;
            $shipextra = Settings::findOne('2')->value;
            $ship_charge = $model->total_amount <= $shipping_limit ? sprintf('%0.2f', $shipextra) : 0.00
            ?>

            <div class="pro-img-box col-lg-2 col-md-2 col-sm-2 col-xs-2"></div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">Shipping Charge</div>

            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">AED  <?= $ship_charge ?></div>

        </div>

        <div class="pro-order-detail">
            <p class="ordered-date">Ordered on <?= date('D, M dS y', strtotime($model->order_date)) ?> </p>
            <p class="order-total">Order Total: AED <?= sprintf('%0.2f', $model->net_amount) ?></p>
        </div>

    </div>
</div>

<div class="hidden-lg hidden-md hidden-sm col-xs-12">
    <div class="orders-box col-xs-12">
        <div class="track">
            <button class="product-id"><?= $model->order_id ?></button>
            <?= Html::a('<i class="fa fa-ban" aria-hidden="true"></i>Cancel', ['/myaccounts/my-orders/cancel-order', 'id' => $model->order_id], ['class' => 'track-btn hidden-xs']) ?>
            <?= Html::a('<i class="fa fa-ban" aria-hidden="true"></i>', ['/myaccounts/my-orders/cancel-order', 'id' => $model->order_id], ['class' => 'track-btn', 'title' => 'Cancel Your Product']) ?>
        </div>
        <?php
        foreach ($order_products as $order_product) {
            $product_detail = Product::find()->where(['id' => $order_product->product_id])->one();
            ?>
            <div class="ordered-pro-dtls">
                <div class="pro-img-box col-xs-3">
                    <a href="<?= Yii::$app->homeUrl . 'product_detail/' . $product_detail->canonical_name ?>"><img src="<?= Yii::$app->homeUrl . 'uploads/product/' . $product_detail->id . '/profile/' . $product_detail->canonical_name . '_thumb.' . $product_detail->profile ?>"/></a>
                </div>
                <div class="col-xs-9">
                    <a href="<?= Yii::$app->homeUrl . 'product_detail/' . $product_detail->canonical_name ?>"><p class="cart-pro-heading"><?= $product_detail->product_name ?></p></a>
                    <?php $product_type = Fregrance::findOne($product_detail->product_type); ?>
                    <a href="<?= Yii::$app->homeUrl . 'product_detail/' . $product_detail->canonical_name ?>"><p class="cart-pro-subheading"><?= $product_type->name; ?></p>
                    </a>
                    <!--<p class="product-discp">Sed ut perspiciatis unde omnis iste natus error sit voluptatem.</p>-->
                </div>
                <div class="col-xs-12 price">AED <?= $product_detail->price; ?></div>
                <?php if ($order_product->status == 1) { ?>
                    <div class=" col-xs-12 delivered-date">Delivered on <?= date('D, M dS y', strtotime($order_product->delivered_date)) ?>
                        <span>Your item has been delivered</span>
                    </div>
                <?php } else { ?>
                    <div class=" col-xs-12 delivered-date">
                        <span></span>
                    </div>
                <?php } ?>
            </div>
            <?php
        }
        ?>
        <div>
            <?php
            $promotions = \common\models\OrderPromotions::find()->where(['order_master_id' => $model->id])->sum('promotion_discount');
            if (isset($promotions) && $promotions > 0) {
                ?>

                <div class="pro-img-box col-lg-2 col-md-2 col-sm-2 col-xs-2"></div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">Promotion Code Added</div>

                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">AED  <?= $promotions; ?></div>
            <?php } ?>
        </div>

        <div class="pro-order-detail">
            <p class="ordered-date">Ordered on <?= date('D, M dS y', strtotime($model->order_date)) ?> </p>
            <p class="order-total">Order Total: AED <?= sprintf('%0.2f', $model->total_amount) ?></p>
        </div>
    </div>
</div>