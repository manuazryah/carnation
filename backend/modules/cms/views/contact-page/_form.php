<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model common\models\ContactPage */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contact-page-form form-inline">

        <?php $form = ActiveForm::begin(); ?>



        <div class='col-md-12 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'map')->textInput(['maxlength' => true]) ?>

        </div>
        <div class='col-md-6 col-sm-6 col-xs-12 left_padd'>
                <?=
                $form->field($model, 'address_1')->widget(CKEditor::className(), [
                    'options' => ['rows' => 0],
                    'preset' => 'custom'
                ])
                ?>

        </div>

        <div class='col-md-6 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'phone_no')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-6 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'phone_no_1')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-6 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

        </div>

        <div class='col-md-4 col-sm-6 col-xs-12' style="float:right;">
                <div class="form-group" style="float: right;">
                        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-success', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>
                </div>
        </div>

        <?php ActiveForm::end(); ?>

</div>
