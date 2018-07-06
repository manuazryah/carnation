<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\HomeCategorySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="home-category-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'title1') ?>

    <?= $form->field($model, 'url1') ?>

    <?= $form->field($model, 'image') ?>

    <?= $form->field($model, 'title2') ?>

    <?php // echo $form->field($model, 'url2') ?>

    <?php // echo $form->field($model, 'image2') ?>

    <?php // echo $form->field($model, 'title3') ?>

    <?php // echo $form->field($model, 'url3') ?>

    <?php // echo $form->field($model, 'image3') ?>

    <?php // echo $form->field($model, 'title4') ?>

    <?php // echo $form->field($model, 'url4') ?>

    <?php // echo $form->field($model, 'image4') ?>

    <?php // echo $form->field($model, 'UB') ?>

    <?php // echo $form->field($model, 'DOU') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
