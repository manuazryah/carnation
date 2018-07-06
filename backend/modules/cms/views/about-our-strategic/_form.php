<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\AboutOurStrategic */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="about-our-strategic-form form-inline">

    <?php $form = ActiveForm::begin(); ?>

    <div class='col-md-12 col-sm-6 col-xs-12 left_padd'>   
        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    </div>
    <div class='col-md-12 col-sm-6 col-xs-12 left_padd'> 
        <?= $form->field($model, 'content')->textarea(['maxlength' => '270', 'rows' => 6])->label('Content<i> (250 characters)</i>') ?>

    </div>
    <div class='col-md-4 col-sm-6 col-xs-12' style="float:right;">
        <div class="form-group" style="float: right;">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-success', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
