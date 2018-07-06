<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ContactPageSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contact-page-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'map') ?>

    <?= $form->field($model, 'content') ?>

    <?= $form->field($model, 'accounts_info') ?>

    <?= $form->field($model, 'administration_info') ?>

    <?php // echo $form->field($model, 'marketing_info') ?>

    <?php // echo $form->field($model, 'business_info') ?>

    <?php // echo $form->field($model, 'marketing_address') ?>

    <?php // echo $form->field($model, 'date_1') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
