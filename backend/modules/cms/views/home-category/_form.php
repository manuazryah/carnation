<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\HomeCategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="home-category-form form-inline">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    
            <?= $form->field($model, 'title1')->textInput(['maxlength' => true]) ?>

        </div>
        <div class='col-md-6 col-sm-6 col-xs-12 left_padd'>   
            <?= $form->field($model, 'url1')->textInput(['maxlength' => true]) ?>

        </div>
        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    
            <?= $form->field($model, 'image')->fileInput()->label('Image 1<i> (750*820)</i>') ?>
            <?php if (isset($model->image)) { ?>
                <img src="<?= Yii::$app->homeUrl ?>../uploads/cms/home-category/image1_small.<?= $model->image; ?>"/>

                <?php
            }else{
                echo '';
            }
            ?>

        </div>
    </div>
    <div class="row">
        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    
            <?= $form->field($model, 'title2')->textInput(['maxlength' => true]) ?>

        </div>
        <div class='col-md-6 col-sm-6 col-xs-12 left_padd'>   
            <?= $form->field($model, 'url2')->textInput(['maxlength' => true]) ?>

        </div>
        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    
            <?= $form->field($model, 'image2')->fileInput()->label('Image 2<i> (500*550)</i>') ?>
            <?php if (isset($model->image2)) { ?>
                <img src="<?= Yii::$app->homeUrl ?>../uploads/cms/home-category/image2_small.<?= $model->image2; ?>"/>

                <?php
            }
            ?>

        </div>
    </div>
    <div class="row">
        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    
            <?= $form->field($model, 'title3')->textInput(['maxlength' => true]) ?>

        </div>
        <div class='col-md-6 col-sm-6 col-xs-12 left_padd'>   
            <?= $form->field($model, 'url3')->textInput(['maxlength' => true]) ?>

        </div>
        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    
            <?= $form->field($model, 'image3')->fileInput()->label('Image 3<i> (500*550)</i>') ?>
            <?php if (isset($model->image3)) { ?>
                <img src="<?= Yii::$app->homeUrl ?>../uploads/cms/home-category/image3_small.<?= $model->image3; ?>"/>

            <?php }
            ?>

        </div>
    </div>
    <div class="row">
        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    
            <?= $form->field($model, 'title4')->textInput(['maxlength' => true]) ?>

        </div>
        <div class='col-md-6 col-sm-6 col-xs-12 left_padd'>   
            <?= $form->field($model, 'url4')->textInput(['maxlength' => true]) ?>

        </div>
        <div class='col-md-3 col-sm-6 col-xs-12 left_padd'>    
            <?= $form->field($model, 'image4')->fileInput()->label('Image 4<i> (750*388)</i>') ?>
            <?php if (isset($model->image4)) { ?>
                <img src="<?= Yii::$app->homeUrl ?>../uploads/cms/home-category/image4_small.<?= $model->image4; ?>"/>

                <?php
            }?>

        </div>
    </div>

    <div class='col-md-4 col-sm-6 col-xs-12' style="float:right;">
        <div class="form-group" style="float: right;">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-success', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
