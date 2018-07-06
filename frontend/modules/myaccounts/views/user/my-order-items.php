<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use common\models\OrderDetails;
use common\models\Product;
use common\models\Fregrance;
use common\models\Settings;
use common\models\UserAddress;
use common\models\Emirates;

$order_products = OrderDetails::find()->where(['order_id' => $model->order_id])->all();
?>
<div class="in-main-order-box">
<div class="order-box wishlist-box">
    <div class="box-header">
    
        <div class="row">
            <div class="col-xs-4">
                <ul>
                    <li class="header-title">Ordered on</li>
                    <li class="sub-title"><?= date('D, M dS y', strtotime($model->order_date)) ?></li>
                </ul>
            </div>
            <div class="col-xs-4">
                <ul>
                    <li class="header-title">total</li>
                    <li class="sub-title">AED <?= sprintf('%0.2f', $model->net_amount) ?></li>
                </ul>
            </div>
            
            <div class="col-xs-4 pull-right">
                <ul>
                    <li class="header-title">Order ID  </li>
                    <li class="sub-title"><?= $model->order_id ?></li>
                </ul>
            </div>
        </div>
    </div>
    <?php
    foreach ($order_products as $order_product) {
       
            $product_detail = Product::find()->where(['id' => $order_product->product_id])->one();
            $product_image = Yii::$app->basePath . '/../uploads/product/' . $product_detail->id . '/profile/' . $product_detail->canonical_name . '.' . $product_detail->profile;
            if (file_exists($product_image)) {
                $image = Yii::$app->homeUrl . 'uploads/product/' . $product_detail->id . '/profile/' . $product_detail->canonical_name . '_thumb.' . $product_detail->profile;
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
                    <?php $name = $product_detail->product_name; ?>
                    <?= Html::a('<h6 class="product-title">' . $name . '</h6>', ['/product/product-detail', 'product' => $product_detail->canonical_name], ['target' => '_blank']) ?>
                    
                    <?php
                    $fregrance = Fregrance::findOne($product_detail->product_type)->name;
                    ?>
                    <?= Html::a('<p class = "fregrance">' . $fregrance . '</p>', ['/product-detail/' . $product_detail->canonical_name], ['target' => '_blank']) ?>
                </div>
                
                <div class="col-xs-2">
                    <span class="price-new">AED <?= sprintf("%0.2f", $order_product->rate); ?></span>
                </div>
                <div class="col-xs-2">
                    <span class="price-new">Quantity : <?= $order_product->quantity; ?></span>
                </div>
                <?php
                if ($model->payment_status != '1') {
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
            </div>
        </div>
        <?php
    }
    ?>
    <div>
        <?php
        $promotions = \common\models\OrderPromotions::find()->where(['order_master_id' => $model->id])->sum('promotion_discount');
        if (isset($promotions) && $promotions > 0) {
            ?>

            <div class="col-xs-2"></div>
            <div class="col-xs-6">Promotion Code Added</div>

            <div class="col-xs-2">AED  <?= $promotions; ?></div>
            <div class="col-xs-2"></div>
        <?php } ?>
    </div>
    <div style="clear:both"></div>
    <div>
        <?php
        $shipping_limit = Settings::findOne('1')->value;
        $shipextra = Settings::findOne('2')->value;
        $ship_charge = $model->shipping_charge;
        ?>

        <div class="col-xs-2"></div>
        <div class="col-xs-6 ship-charge"><p>Shipping Charge</p></div>
        <div class="col-xs-2 ship-charge">AED  <?= $model->shipping_charge ?></div>
        <div class="col-xs-2"></div>

    </div>
    <div style="clear:both"></div>
    <div class="horizontal-line"></div>
    <div class="box-footer">
        <div class="col-xs-12">
            <?php if ($model->payment_status != 1 && $model->payment_status != 3) { ?>
                <?= Html::a('Continue', ['/checkout/continue', 'id' => yii::$app->EncryptDecrypt->Encrypt('encrypt', $model->order_id)], ['class' => 'btn shadowbtn bt-right']) ?>
            <?php } ?>
            <?php if ($model->admin_status != 4 && $model->admin_status != 5  && $model->status != 5) { ?>
                <?= Html::a('Cancel', ['/myaccounts/user/cancel-order', 'id' => yii::$app->EncryptDecrypt->Encrypt('encrypt', $model->order_id)], ['class' => 'btn shadowbtn bt-right']) ?>
            <?php
            } elseif ($model->admin_status == 4) {
                echo '<span class="order-deliver-stat">Order Delivered</span>';
            } elseif ($model->admin_status == 5 || $model->status == 5) {
                echo '<span class="order-cancel-stat">Order Cancelled</span>';
            }
            ?>
        </div>
    </div>
</div>
</div>