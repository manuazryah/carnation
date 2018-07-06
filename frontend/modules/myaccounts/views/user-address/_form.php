<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\UserAddress */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="user-address-form form-inline">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class='col-md-8 col-sm-12 col-xs-12 left_padd'>
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        </div>
    </div>
    <div class="row">
        <div class='col-md-6 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>

        </div>
        <div class='col-md-6 col-sm-12 col-xs-12 left_padd'>
            <?= $form->field($model, 'landmark')->textInput(['maxlength' => true]) ?>

        </div>
        <div class='col-md-6 col-sm-12 col-xs-12 left_padd'>
            <?= $form->field($model, 'location')->textInput(['maxlength' => true]) ?>

        </div>
    </div>
    <div class="row">
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'emirate')->dropDownList(['1' => 'emirate1', '2' => 'emirate2']) ?>

        </div>
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'post_code')->textInput() ?>

        </div>
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'mobile_number')->textInput(['maxlength' => true]) ?>

        </div>
    </div>
    <div class='col-md-4 col-sm-6 col-xs-12' style="float:right;">
        <div class="form-group" style="float: right;">
            <?= Html::submitButton($model->isNewRecord ? 'SAVE CHANGES' : 'Update', ['class' => 'btn btn-success', 'style' => 'margin-top: 18px; height: 36px; width:155px;float: right;']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
