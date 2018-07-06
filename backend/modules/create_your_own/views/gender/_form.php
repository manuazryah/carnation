<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Gender */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gender-form form-inline">

    <?php $form = ActiveForm::begin(); ?>

    <div class="rows">
        <div class='col-md-12 col-sm-12 col-xs-12 left_padd'>
            <?= $form->field($model, 'img')->fileInput()->label('Image (File Size : 685x375)') ?>
        </div>
    </div>
    <div class="rows">
        <div class='col-md-12 col-sm-12 col-xs-12 left_padd'>
            <?php if (isset($model->img)) { ?>
                <img src="<?= Yii::$app->homeUrl ?>../uploads/create_your_own/gender/<?= $model->id ?>.<?= $model->img; ?>?<?= rand() ?>" width="320" height="150"/>

                <?php
            } elseif (!empty($model->image)) {
                echo "";
            }
            ?>
        </div>
    </div>
    <div class='col-md-12 col-sm-12 col-xs-12' style="padding-left: 0px;">
        <div class="form-group" style="float: right;">
            <?= Html::submitButton('Update', ['class' => 'btn btn-success', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>
            <?php if (!empty($model->id)) { ?>
                <?= Html::a('Reset', ['index'], ['class' => 'btn btn-gray btn-reset', 'style' => 'padding: 9px;width: 110px;margin-top: 17px;']) ?>
            <?php }
            ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
