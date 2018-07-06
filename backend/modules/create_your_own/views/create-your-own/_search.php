<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CreateYourOwnSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="create-your-own-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'session_id') ?>

    <?= $form->field($model, 'gender') ?>

    <?= $form->field($model, 'character_id') ?>

    <?php // echo $form->field($model, 'scent') ?>

    <?php // echo $form->field($model, 'note') ?>

    <?php // echo $form->field($model, 'bottle') ?>

    <?php // echo $form->field($model, 'label_1') ?>

    <?php // echo $form->field($model, 'label_2') ?>

    <?php // echo $form->field($model, 'tot_amount') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
