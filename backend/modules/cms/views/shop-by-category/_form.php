<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ShopByCategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="shop-by-category-form form-inline">

    <?php $form = ActiveForm::begin(); ?>
    <div class='col-md-12 col-sm-12 col-xs-12 left_padd'>    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    </div>
    <div class='col-md-12 col-sm-12 col-xs-12 left_padd'>    <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>

    </div>
    <?php
    $label = '';
    if ($model->id == 1) {
        $label = 'Image (634*582)';
    } else if ($model->id == 2) {
        $label = 'Image (634*274)';
    } else if ($model->id == 3) {
        $label = 'Image (634*274)';
    } else if ($model->id == 4) {
        $label = 'Image (1268*309)';
    }
    ?>
    <div class='col-md-12 col-sm-12 col-xs-12 left_padd'>    <?= $form->field($model, 'image')->fileInput()->label($label) ?>

        <?php
        if (!empty($model->image)) {
            ?>

            <img src="<?= Yii::$app->homeUrl ?>../uploads/cms/shop-by-category/<?= $model->id ?>/small.<?= $model->image; ?>" />
            <?php
        }
        ?>

    </div>
    <div class='col-md-4 col-sm-6 col-xs-12' style="float:right;">
        <div class="form-group" style="float: right;">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-success', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
