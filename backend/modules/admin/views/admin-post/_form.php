<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\AdminPost */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="admin-post-form form-inline">

    <?php $form = ActiveForm::begin(); ?>
    <div class="rows">
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'> 
            <?= $form->field($model, 'post_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'> 
            <?= $form->field($model, 'admin')->dropDownList(['1' => 'Yes', '0' => 'No'], ['prompt' => 'Select Admin']) ?>
        </div>

        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'> 
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
