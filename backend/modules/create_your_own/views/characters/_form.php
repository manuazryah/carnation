<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Gender;

/* @var $this yii\web\View */
/* @var $model common\models\Characters */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="characters-form form-inline">

    <?php $form = ActiveForm::begin(); ?>

    <div class='col-md-12 col-sm-12 col-xs-12 left_padd'>
        <?= $form->field($model, 'gender')->dropDownList(ArrayHelper::map(Gender::find()->where(['status' => '1'])->all(), 'id', 'gender'), ['class' => 'form-control', 'prompt' => 'Choose Gender']) ?>
    </div>
    <div class='col-md-12 col-sm-12 col-xs-12 left_padd'>
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    </div>
    <div class='col-md-12 col-sm-12 col-xs-12 left_padd'>
        <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    </div>
    <div class='col-md-12 col-sm-12 col-xs-12 left_padd'>
        <?= $form->field($model, 'img')->fileInput()->label('Image (File Size : 685x375)') ?>

    </div>
    <div class="rows">
        <div class='col-md-12 col-sm-12 col-xs-12 left_padd'>
            <?php if (isset($model->img)) { ?>
                <img src="<?= Yii::$app->homeUrl ?>../uploads/create_your_own/characters/<?= $model->id ?>.<?= $model->img; ?>?<?= rand() ?>" width="320" height="110"/>

                <?php
            } elseif (!empty($model->img)) {
                echo "";
            }
            ?>
        </div>
    </div>
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
