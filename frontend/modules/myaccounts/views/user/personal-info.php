<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
if (isset($meta_title) && $meta_title != '')
    $this->title = $meta_title;
else
    $this->title = 'carnation';
?>
<title><?= $this->title ?></title>
<style>
    .first-name .form-group{
        margin-bottom: 0px !important;
    }
</style>
<div class="pad-20 hide-xs"></div>

<div class="container">
    <div class="breadcrumb">
        <span class="current-page">personal information</span>
        <ol class="path">
            <li><?= Html::a('<span>Home</span>', ['/site/index'], ['class' => '']) ?></li>
            <li><?= Html::a('<span>My account</span>', ['/myaccounts/user/index'], ['class' => '']) ?></li>
            <li class="active">personal information</li>
        </ol>
    </div>
</div>

<div id="our-product" class="my-account">
    <div class="container">
        <?= Yii::$app->controller->renderPartial('_leftside_menu'); ?>
        <div class="settings">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 right-box" style="padding: 50px 15px;">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 my-account-cntnt align-center">
                    <div class="form-feild-box">
                        <?php $form = ActiveForm::begin(); ?>
                        <div class="form-group col-md-12 form-group1">
                            <!--<label for="usr">Name*</label>-->
                            <div class="col-md-12 first-name">
                                <?= $form->field($model, 'first_name')->textInput(['placeholder' => 'First Name'])->label('First Name*') ?>
                            </div>
                            <div class="col-md-12 last-name">
                                <?= $form->field($model, 'last_name')->textInput(['placeholder' => 'Last Name'])->label('Last Name') ?>
                            </div>
                        </div>
                        <div class="col-md-8 col-sm-8 col-xs-8 dob" style="padding-left: 0px;">
                            <label for="pwd" style="color:#8c8c8c;">D.O.B*</label>
                            <div class="date-dropdowns form-group">
                                <?php
                                if ($model->dob != '' && $model->dob != '0000-00-00') {
                                    $model->dob = date("d-m-Y", strtotime($model->dob));
                                } else {
                                    $model->dob = date('d-m-Y');
                                }
                                echo DatePicker::widget([
                                    'model' => $model,
                                    'attribute' => 'dob',
                                    'type' => DatePicker::TYPE_INPUT,
                                    'pluginOptions' => [
                                        'autoclose' => true,
                                        'format' => 'dd-mm-yyyy',
                                        'class' => 'form-control'
                                    ]
                                ]);
                                ?>
                            </div>
                        </div>
                        <div class="form-group col-md-4 col-sm-4 col-xs-4 gender-selection form-group1">
                            <?= $form->field($model, 'gender')->dropDownList(['1' => 'Male', 2 => 'Female']); ?>
                        </div>

                        <?= Html::submitButton('save changes', ['class' => 'green2']) ?>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</div>

<div class="pad-20"></div>
