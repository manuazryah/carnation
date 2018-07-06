<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Bottle */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bottle-form form-inline">

    <?php $form = ActiveForm::begin(); ?>
    <div class='col-md-12 col-sm-12 col-xs-12 left_padd'>
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    </div>
    <div class='col-md-6 col-sm-6 col-xs-12 left_padd'>
        <?= $form->field($model, 'text_length')->textInput(['maxlength' => true]) ?>

    </div>
    <div class='col-md-6 col-sm-6 col-xs-12 left_padd'>
        <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    </div>
    <div class='col-md-12 col-sm-12 col-xs-12 left_padd'>
        <?= $form->field($model, 'bottle_img')->fileInput() ?>
        <?php if (isset($model->bottle_img)) { ?>
            <img src="<?= Yii::$app->homeUrl ?>../uploads/create_your_own/bottle/<?= $model->id ?>/small.<?= $model->bottle_img; ?>?<?= rand() ?>" width="320" height="110"/>

            <?php
        } elseif (!empty($model->bottle_img)) {
            echo "";
        }
        ?>

    </div>
    <!--    <div class='col-md-12 col-sm-12 col-xs-12 left_padd'>
    <?php // $form->field($model, 'desigin_img[]')->fileInput(['multiple' => true]) ?>

        </div>-->

    <div class='col-md-12 col-sm-12 col-xs-12' style="padding-left: 0px;">
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-success', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>
            <?php if (!empty($model->id)) { ?>
                <?= Html::a('Reset', ['index'], ['class' => 'btn btn-gray btn-reset', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>
            <?php }
            ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
