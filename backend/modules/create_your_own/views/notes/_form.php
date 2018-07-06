<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Scent;

/* @var $this yii\web\View */
/* @var $model common\models\Notes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="notes-form form-inline">

    <?php $form = ActiveForm::begin(); ?>
    <div class='col-md-12 col-sm-12 col-xs-12 left_padd'>
        <?php
        if (!$model->isNewRecord) {
            if (isset($model->scent_id)) {
                $model->scent_id = explode(',', $model->scent_id);
            }
        }
        ?>
        <?= $form->field($model, 'scent_id')->dropDownList(ArrayHelper::map(Scent::find()->where(['status' => '1'])->all(), 'id', 'scent'), ['class' => 'form-control', 'multiple' => 'multiple']) ?>
    </div>
    <div class='col-md-6 col-sm-12 col-xs-12 left_padd'>
        <?= $form->field($model, 'notes')->textInput(['maxlength' => true]) ?>
    </div>
    <div class='col-md-6 col-sm-12 col-xs-12 left_padd'>
        <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>
    </div>
    <div class='col-md-6 col-sm-12 col-xs-12 left_padd'>
        <?= $form->field($model, 'main_img')->fileInput()->label('Main Image (File Size : 685x375)') ?>
        <?php if (isset($model->main_img)) { ?>
            <img src="<?= Yii::$app->homeUrl ?>../uploads/create_your_own/notes/<?= $model->id ?>/large.<?= $model->main_img; ?>?<?= rand() ?>" width="150" height="75"/>

            <?php
        } elseif (!empty($model->image)) {
            echo "";
        }
        ?>
    </div>
    <div class='col-md-6 col-sm-12 col-xs-12 left_padd'>
        <?= $form->field($model, 'sub_img')->fileInput()->label('Sub Image (File Size : 45x35)') ?>
        <?php if (isset($model->sub_img)) { ?>
            <img src="<?= Yii::$app->homeUrl ?>../uploads/create_your_own/notes/<?= $model->id ?>/small.<?= $model->sub_img; ?>?<?= rand() ?>" width="45" height="35"/>

            <?php
        } elseif (!empty($model->image)) {
            echo "";
        }
        ?>
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
        $("#notes-scent_id").select2({
            placeholder: 'Choose Scent',
            allowClear: true
        }).on('select2-open', function ()
        {
            // Adding Custom Scrollbar
            $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
        });

    });
</script>
