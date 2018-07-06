<?php

use yii\helpers\Html;
?>
<?php
if (isset($meta_title) && $meta_title != '')
    $this->title = $meta_title;
else
    $this->title = 'carnation';
?>
<title><?= $this->title ?></title>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 customer-reviews orders-box active">
    <div class="pro-img-box col-lg-3 col-md-3 col-sm-3 col-xs-12">
        <?php
        $product = \common\models\Product::findOne($model->product_id);
        $product_image = Yii::$app->basePath . '/../uploads/product/' . $product->id . '/profile/' . $product->canonical_name . '_thumb.' . $product->profile;
        if (file_exists($product_image)) {
            ?>
            <img src="<?= Yii::$app->homeUrl . 'uploads/product/' . $product->id . '/profile/' . $product->canonical_name . '_thumb.' . $product->profile ?>" height="100%" alt="1" />
            <?php
        } else {
            ?>
            <img src="<?= Yii::$app->homeUrl . 'uploads/product/profile_thumb.png' ?>" height="100%" alt="1" />
        <?php }
        ?>
    </div>
    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
        <p class="subject"> <?= $model->tittle ?></p>
        <i><?= \common\models\User::findOne($model->user_id)->first_name ?> on <?= date("M d , Y", strtotime($model->review_date)) ?></i>
        <p class="message"><?= $model->description ?></p>
    </div>
</div>

