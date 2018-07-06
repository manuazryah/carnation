<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\AboutSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="about-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'index_title') ?>

    <?= $form->field($model, 'index_content') ?>

    <?= $form->field($model, 'about_title') ?>

    <?= $form->field($model, 'about_content') ?>

    <?php // echo $form->field($model, 'chairman_image') ?>

    <?php // echo $form->field($model, 'chairman_name') ?>

    <?php // echo $form->field($model, 'chairman_position') ?>

    <?php // echo $form->field($model, 'chairman_message') ?>

    <?php // echo $form->field($model, 'about_image') ?>

    <?php // echo $form->field($model, 'CB') ?>

    <?php // echo $form->field($model, 'UB') ?>

    <?php // echo $form->field($model, 'DOC') ?>

    <?php // echo $form->field($model, 'DOU') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
