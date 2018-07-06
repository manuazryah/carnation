<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\StoreLocator */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="store-locator-form form-inline">

    <?php $form = ActiveForm::begin(); ?>

    <div class='col-md-6 col-sm-6 col-xs-12 left_padd'>  
        <?= $form->field($model, 'location')->textInput(['maxlength' => true]) ?>

    </div>
    <div class='col-md-6 col-sm-6 col-xs-12 left_padd'> 
        <?= $form->field($model, 'image')->fileInput()->label('Image<i> (850*610)</i>') ?>

    </div>
    <div class='col-md-8 col-sm-6 col-xs-12 left_padd'>  
        <?= $form->field($model, 'detail')->textarea(['rows' => 6]) ?>

    </div>
    <div class='col-md-6 col-sm-6 col-xs-12 left_padd'>   
        <?= $form->field($model, 'status')->dropDownList(['1' => 'Enable', '0' => 'Disable']) ?>

    </div>
    <div class='col-md-6 col-sm-6 col-xs-12' style="float:right;">
        <div class="form-group" style="float: right;">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-success', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
