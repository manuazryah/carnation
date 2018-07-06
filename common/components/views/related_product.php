<?php

use yii\helpers\Html;
use common\models\Fregrance;
use common\components\ProductLinksWidget;
?>
<?php
if (!empty($related_product)) {
        ?>
        <div class="woocommrece related products">
                <div class="box-heading"><span>Related Products</span></div>
                <div class="box-content">
                        <div class="box-products slide" id="productcarouse-C3htu">
                                <div class="carousel-inner">
                                        <div class="item active">
                                                <div class="row">
                                                        <?php foreach ($related_product as $val) { ?>
                                                                <?= ProductLinksWidget::widget(['id' => $val->id]) ?>
                                                        <?php } ?>


                                                </div>
                                        </div>
                                </div>
                        </div>


                        <meta itemprop="url" content="index33a9.html?product=woo-logo-2">

                </div>
                <!-- #product-113 -->


        </div>
        <?php
}
?>

