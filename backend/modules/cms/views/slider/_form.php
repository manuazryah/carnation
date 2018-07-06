<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model common\models\Slider */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="slider-form form-inline">

    <?php $form = ActiveForm::begin(); ?>

    <div class='col-md-12 col-sm-12 col-xs-12 left_padd'>
        <?= $form->field($model, 'img')->fileInput()->label('Image (File Size : 1920x580)') ?>

    </div>
    <div class='col-md-12 col-sm-12 col-xs-12 left_padd'>
        <?= $form->field($model, 'slider_link')->textInput(['maxlength' => true]) ?>
    </div>
    <div class='col-md-12 col-sm-12 col-xs-12 left_padd'>
        <?= $form->field($model, 'alt_tag_content')->textInput(['maxlength' => true]) ?>

    </div>
    <div class="rows">
        <div class='col-md-12 col-sm-12 col-xs-12 left_padd'>
            <?php if (isset($model->img)) { ?>
                <img src="<?= Yii::$app->homeUrl ?>../uploads/cms/slider/<?= $model->id ?>/small.<?= $model->img; ?>?<?= rand() ?>" width="300" height="110"/>

                <?php
            } elseif (!empty($model->img)) {
                echo "";
            }
            ?>
        </div>
    </div>
    <div class='col-md-12 col-sm-12 col-xs-12 left_padd'>
        <?= $form->field($model, 'status')->dropDownList(['1' => 'Enable', '0' => 'Disable']) ?>

    </div>

    <div class='col-md-12 col-sm-12 col-xs-12' style="padding-left: 0px;">
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-success', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>
            <?php if (!empty($model->id)) { ?>
                <?= Html::a('Reset', ['index'], ['class' => 'btn btn-gray btn-reset', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>
            <?php }
            ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
