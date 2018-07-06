<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form form-inline">

    <?php $form = ActiveForm::begin(); ?>
    <div class="rows">
        <div class='col-md-12 col-sm-12 col-xs-12 left_padd'>    
            <?= $form->field($model, 'tag_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class='col-md-12 col-sm-12 col-xs-12 left_padd'> 
            <?= $form->field($model, 'status')->dropDownList(['1' => 'Enable', '0' => 'Disable']) ?>
        </div>
    </div>
    <div class="rows">
    <div class='col-md-12 col-sm-12 col-xs-12'>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-success', 'style' => 'float:right;']) ?>
        </div>
    </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
