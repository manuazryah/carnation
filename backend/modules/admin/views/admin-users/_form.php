<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\AdminUser */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="admin-user-form form-inline">

    <?php $form = ActiveForm::begin(); ?>
    <div class="rows">
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>

            <?= $form->field($model, 'post_id')->dropDownList(ArrayHelper::map(common\models\AdminPost::find()->all(), 'id', 'post_name'), ['prompt' => 'select']) ?>
        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'user_name')->textInput(['maxlength' => true]) ?>
        </div>
        <?php if ($model->isNewRecord) { ?><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
            </div>
        <?php } ?>
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        </div>
        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
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
