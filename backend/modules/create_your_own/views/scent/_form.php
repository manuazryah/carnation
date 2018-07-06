<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Characters;

/* @var $this yii\web\View */
/* @var $model common\models\Scent */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="scent-form form-inline">

    <?php $form = ActiveForm::begin(); ?>

    <div class='col-md-12 col-sm-12 col-xs-12 left_padd'>
        <?php
        if (!$model->isNewRecord) {
            if (isset($model->charecter_id)) {
                $model->charecter_id = explode(',', $model->charecter_id);
            }
        }
        ?>
        <?= $form->field($model, 'charecter_id')->dropDownList(ArrayHelper::map(Characters::find()->where(['status' => '1'])->all(), 'id', 'name'), ['class' => 'form-control', 'multiple' => 'multiple']) ?>
    </div>
    <div class='col-md-12 col-sm-12 col-xs-12 left_padd'>
        <?= $form->field($model, 'scent')->textInput(['maxlength' => true]) ?>

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
                <img src="<?= Yii::$app->homeUrl ?>../uploads/create_your_own/scent/<?= $model->id ?>.<?= $model->img; ?>?<?= rand() ?>" width="320" height="110"/>

                <?php
            } elseif (!empty($model->image)) {
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
<script type="text/javascript">
    jQuery(document).ready(function ($)
    {
        $("#scent-charecter_id").select2({
            placeholder: 'Choose Charecter',
            allowClear: true
        }).on('select2-open', function ()
        {
            // Adding Custom Scrollbar
            $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
        });

    });
</script>
