<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;

$action = Yii::$app->controller->id . '/' . Yii::$app->controller->action->id;
$latest_products = common\models\Product::find()->where(['status' => 1])->orderBy(['id' => SORT_DESC])->limit(2)->all();
?>

<aside id="column-left" class="col-lg-3 col-md-3 col-sm-3 column-left-menu">
    <div class="box hidden-xs" id="latest">
        <div class="box-heading"><span>Latest</span>
        </div>
        <?php
        if (!empty($latest_products)) {
            foreach ($latest_products as $product_details) {
                ?>
                <div class="box-content left-side-menu">
                    <div class="box-product productbox-grid" id="latest-grid">
                        <div class="product-items">
                            <div class="product-block product-thumb transition">
                                <div class="product-block-inner">
                                    <div class="image">
                                        <?php
                                        $product_image = Yii::$app->basePath . '/../uploads/product/' . $product_details->id . '/profile/' . $product_details->canonical_name . '.' . $product_details->profile;
                                        if (file_exists($product_image)) {
                                            $image_src = Yii::$app->homeUrl . 'uploads/product/' . $product_details->id . '/profile/' . $product_details->canonical_name . '.' . $product_details->profile;
                                        } else {
                                            $image_src = Yii::$app->homeUrl . 'uploads/product/gallery_dummy.png';
                                        }
                                        ?>
                                        <?= Html::a('<img  src="' . $image_src . '" alt="' . $product_details->canonical_name . '" />', ['product/product-detail', 'product' => $product_details->canonical_name], ['title' => $product_details->product_name, 'style' => 'width:60px;height:82px;']) ?>
                                    </div>
                                    <div class="caption">
                                        <h4>
                                            <?= Html::a(strlen($product_details->product_name) > 15 ? substr(strtoupper($product_details->product_name), 0, 15) . ".." : strtoupper($product_details->product_name), ['product/product-detail', 'product' => $product_details->canonical_name], ['title' => $product_details->product_name]) ?>
                                        </h4>
                                        <?php $fragrance = \common\models\Fregrance::findOne($product_details->product_type)->name ?>
                                        <p><?= $fragrance ?></p>
                                        <?php
                                        if ($product_details->offer_price != "0" && isset($product_details->offer_price)) {
                                            $percentage = round(100 - (($product_details->offer_price / $product_details->price) * 100));
                                            ?>
                                            <p class="price"> <span class="price-new">AED <?= $product_details->offer_price; ?></span>  <span class="price-old">AED <?= $product_details->price; ?></span></p>
                                            <?php
                                        } else {
                                            ?>
                                            <p class="price"> <span class="price-new">AED <?= $product_details->price; ?></span></p>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
        }
        ?>
    </div>
    <span class="latest_default_width" style="display:none; visibility:hidden"></span>
</aside>