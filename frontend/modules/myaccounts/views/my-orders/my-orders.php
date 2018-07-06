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
            <?php if ($model->payment_status != '1' && $model->payment_status != '3') { ?>
                <?= Html::a('<i class="" aria-hidden="true"></i>Continue', ['/checkout/continue', 'id' => yii::$app->EncryptDecrypt->Encrypt('encrypt', $model->order_id)], ['class' => 'track-btn btn-success'])
                ?>
            <?php } ?>
<?php if ($model->status != 5) { ?>
            <?= Html::a('<i class="fa fa-ban" aria-hidden="true"></i>Cancel', ['/myaccounts/my-orders/cancel-order', 'id' => yii::$app->EncryptDecrypt->Encrypt('encrypt', $model->order_id)], ['class' => 'track-btn','onclick'=>"return confirm('Are you sure want to cancel the Order?');"]) ?>
<?php } ?>       
 </div>
        <?php
        foreach ($order_products as $order_product) {
            if ($order_product->item_type == 1) {
                $product_detail = \common\models\CreateYourOwn::findOne($order_product->product_id);
                $bottles = common\models\Bottle::findOne($product_detail->bottle);
                $product_image = Yii::$app->basePath . '/../uploads/create_your_own/bottle/' . $bottles->id . '/small.' . $bottles->bottle_img;
                if (file_exists($product_image)) {
                    $image = Yii::$app->homeUrl . 'uploads/create_your_own/bottle/' . $bottles->id . '/small.' . $bottles->bottle_img;
                }
            } else {
                $product_detail = Product::find()->where(['id' => $order_product->product_id])->one();
                $product_image = Yii::$app->basePath . '/../uploads/product/' . $product_detail->id . '/profile/' . $product_detail->canonical_name . '.' . $product_detail->profile;
                if (file_exists($product_image)) {
                    $image = Yii::$app->homeUrl . 'uploads/product/' . $product_detail->id . '/profile/' . $product_detail->canonical_name . '_thumb.' . $product_detail->profile;
                } else {
                    $image = Yii::$app->homeUrl . 'uploads/product/profile_thumb.png';
                }
            }
            ?>
            <div class="ordered-pro-dtls">
                <div class="pro-img-box col-lg-2 col-md-2 col-sm-2 col-xs-2">
                    <img src="<?= $image ?>" height="100%" alt="1" />
                </div>
                <div class="col-lg-6 col-md-6 col-sm-4 col-xs-4">
                    <?php $name = $order_product->item_type == 1 ? 'Custom Perfume' : $product_detail->product_name; ?>
                    <?= Html::a('<p class="cart-pro-heading" style="line-height:18px !important">' . $name . '</p>', $order_product->item_type == 1 ? ['#'] : ['/product-detail/'.$product_detail->canonical_name],  ['target' => '_blank']) ?>
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
                    <?php
                    // $product_type = Fregrance::findOne($product_detail->product_type);
                    $fregrance = $order_product->item_type == 1 ? $label1 . ' , ' . $label2 : Fregrance::findOne($product_detail->product_type)->name;
                    ?>
                    <?= Html::a('<p class="cart-pro-subheading">' . $fregrance . '</p>', $order_product->item_type == 1 ? ['#'] : ['/product-detail/'.$product_detail->canonical_name], ['target' => '_blank']) ?>
                </div>
                <?php
                if ($order_product->item_type == 1) {
                    $price = \common\models\CreateYourOwn::findOne($order_product->product_id)->tot_amount;
                } else {
                    if ($product_detail->offer_price == '0' || $product_detail->offer_price == '') {
                        $price = $product_detail->price;
                    } else {
                        $price = $product_detail->offer_price;
                    }
                }
                ?>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 price">AED <?= $price; ?></div>
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
            $ship_charge = $model->shipping_charge;
            ?>

            <div class="pro-img-box col-lg-2 col-md-2 col-sm-2 col-xs-2"></div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">Shipping Charge</div>

            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">AED  <?= $model->shipping_charge ?></div>

        </div>

        <div class="pro-order-detail">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                <p class="ordered-date">Ordered on <?= date('D, M dS y', strtotime($model->order_date)) ?> </p>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                <?php if ($model->expected_delivery_date) { ?>
                    <p class="expected-date text-center">Expected Delivery <?= date('D, M dS Y', strtotime($model->expected_delivery_date)) ?> </p>
                <?php } ?>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                <p class="order-total">Order Total: AED <?= sprintf('%0.2f', $model->net_amount) ?></p>
            </div>
        </div>

    </div>
</div>
<!--/********************************************************************************************************************/-->
<div class="hidden-lg hidden-md hidden-sm col-xs-12">
    <div class="orders-box col-xs-12">
        <div class="track">
            <button class="product-id"><?= $model->order_id ?></button>
             <?php if ($model->payment_status != '1' && $model->payment_status != '3') { ?>
                <?= Html::a('<i class="" aria-hidden="true"></i>Continue', ['/checkout/continue', 'id' => yii::$app->EncryptDecrypt->Encrypt('encrypt', $model->order_id)], ['class' => 'track-btn btn-success'])
                ?>
            <?php } ?>
            <?= Html::a('<i class="fa fa-ban" aria-hidden="true"></i>Cancel', ['/myaccounts/my-orders/cancel-order', 'id' => yii::$app->EncryptDecrypt->Encrypt('encrypt', $model->order_id)], ['class' => 'track-btn hidden-xs']) ?>
            <?= Html::a('<i class="fa fa-ban" aria-hidden="true"></i>', ['/myaccounts/my-orders/cancel-order', 'id' => yii::$app->EncryptDecrypt->Encrypt('encrypt', $model->order_id)], ['class' => 'track-btn','onclick'=>"return confirm('Are you sure want to cancel the Order?');", 'title' => 'Cancel Your Product']) ?>
        </div>
        <?php
        foreach ($order_products as $order_product) {
            if ($order_product->item_type == 1) {
                $product_detail = \common\models\CreateYourOwn::findOne($order_product->product_id);
                $bottles = common\models\Bottle::findOne($product_detail->bottle);
                $product_image = Yii::$app->basePath . '/../uploads/create_your_own/bottle/' . $bottles->id . '/small.' . $bottles->bottle_img;
                if (file_exists($product_image)) {
                    $image = Yii::$app->homeUrl . 'uploads/create_your_own/bottle/' . $bottles->id . '/small.' . $bottles->bottle_img;
                }
            } else {
                $product_detail = Product::find()->where(['id' => $order_product->product_id])->one();
                $product_image = Yii::$app->basePath . '/../uploads/product/' . $product_detail->id . '/profile/' . $product_detail->canonical_name . '.' . $product_detail->profile;
                if (file_exists($product_image)) {
                    $image = Yii::$app->homeUrl . 'uploads/product/' . $product_detail->id . '/profile/' . $product_detail->canonical_name . '_thumb.' . $product_detail->profile;
                } else {
                    $image = Yii::$app->homeUrl . 'uploads/product/profile_thumb.png';
                }
            }
            ?>
            <div class="ordered-pro-dtls">
                <div class="pro-img-box col-xs-3">
                    <img src="<?= $image ?>" height="100%" alt="1" />
                </div>
                <div class="col-xs-9">
                    <?php $name = $order_product->item_type == 1 ? 'Custom Perfume' : $product_detail->product_name; ?>
                    <?= Html::a('<p class="cart-pro-heading" style="line-height:18px !important">' . $name . '</p>', $order_product->item_type == 1 ? ['#'] : ['/product-detail/'.$product_detail->canonical_name], ['target' => '_blank']) ?>
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
                    <?php
                    // $product_type = Fregrance::findOne($product_detail->product_type);
                    $fregrance = $order_product->item_type == 1 ? $label1 . ' , ' . $label2 : Fregrance::findOne($product_detail->product_type)->name;
                    ?>
                    <?= Html::a('<p class="cart-pro-subheading">' . $fregrance . '</p>', $order_product->item_type == 1 ? ['#'] : ['/product-detail/'.$product_detail->canonical_name], ['target' => '_blank']) ?>
                    <!--<p class="product-discp">Sed ut perspiciatis unde omnis iste natus error sit voluptatem.</p>-->
                </div>
                <?php
                if ($order_product->item_type == 1) {
                    $price = \common\models\CreateYourOwn::findOne($order_product->product_id)->tot_amount;
                } else {
                    if ($product_detail->offer_price == '0' || $product_detail->offer_price == '') {
                        $price = $product_detail->price;
                    } else {
                        $price = $product_detail->offer_price;
                    }
                }
                ?>
                <div class="col-xs-12 price">AED <?= $price?></div>
                <div class="col-xs-12 price">Quantity : <?= $order_product->quantity; ?></div>
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

       <div style="clear:both"></div>
       <div>
                        <?php
                        $shipping_limit = Settings::findOne('1')->value;
                        $shipextra = Settings::findOne('2')->value;
                        $ship_charge = $model->shipping_charge;
                        ?>

                        <div class="pro-img-box col-lg-2 col-md-2 col-sm-2 col-xs-2"></div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">Shipping Charge</div>

                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">AED  <?= $model->shipping_charge ?></div>

                </div>

        <div class="pro-order-detail">
            <p class="ordered-date">Ordered on <?= date('D, M dS y', strtotime($model->order_date)) ?> </p>
            <p class="order-total">Order Total: AED <?= sprintf('%0.2f', $model->net_amount) ?></p>
        </div>
    </div>
</div>

