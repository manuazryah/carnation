<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Promotions */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="promotions-form form-inline">

        <?php $form = ActiveForm::begin(); ?>

        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'promotion_type')->dropDownList(['' => '--Select--', '1' => 'Unique Product Code', '2' => 'User Specified Code', '3' => 'Common Code', '4' => 'Brand']) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'promotion_code')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd promption-productid'>
                <?php
                if (!$model->isNewRecord) {
                        if (isset($model->product_id)) {
                                $model->product_id = explode(',', $model->product_id);
                        }
                }
                ?>

                <?php $products = common\models\Product::find()->where(['status' => 1])->orderBy(['product_name' => SORT_ASC])->all(); ?>   <?= $form->field($model, 'product_id')->dropDownList(ArrayHelper::map($products, 'id', 'product_name'), ['prompt' => '--Select--', 'multiple' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd promption-userid'>

                <?php
                if (!$model->isNewRecord) {
                        if (isset($model->user_id)) {
                                $model->user_id = explode(',', $model->user_id);
                        }
                }
                ?>
                <?php $users = common\models\User::find()->where(['status' => 1])->all(); ?>   <?= $form->field($model, 'user_id')->dropDownList(ArrayHelper::map($users, 'id', 'email'), ['prompt' => '--Select--', 'multiple' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd promption-brand'>

                <?php
                if (!$model->isNewRecord) {
                        if (isset($model->brand)) {
                                $model->brand = explode(',', $model->brand);
                        }
                }
                ?>
                <?php $brands = common\models\Category::find()->where(['status' => 1])->all(); ?>   <?= $form->field($model, 'brand')->dropDownList(ArrayHelper::map($brands, 'id', 'category'), ['prompt' => '--Select--', 'multiple' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'type')->dropDownList(['1' => 'Percentage', '2' => 'Fixed']) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'amount_range')->textInput(['maxlength' => true]) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'code_usage')->dropDownList(['' => '--Select--', '1' => 'Single Use', '2' => 'Multiple Use']) ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>

                <?php
                if (!$model->isNewRecord) {
                        $model->starting_date = date('d-m-Y', strtotime($model->starting_date));
                } else {
                        $model->starting_date = date('d-m-Y');
                }
                echo $form->field($model, 'starting_date')->widget(\yii\jui\DatePicker::classname(), [
                    'dateFormat' => 'dd-MM-yyyy',
                    'options' => ['class' => 'form-control', 'placeholder' => 'Date']])->label('Starting Date')
                ?>

        </div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>

                <?php
                if (!$model->isNewRecord) {
                        $model->expiry_date = date('d-m-Y', strtotime($model->expiry_date));
                } else {
                        $model->expiry_date = date('d-m-Y');
                }
                echo $form->field($model, 'expiry_date')->widget(\yii\jui\DatePicker::classname(), [
                    'dateFormat' => 'dd-MM-yyyy',
                    'options' => ['class' => 'form-control', 'placeholder' => 'Date']])->label('Expiry Date')
                ?>



        </div>
        <div class='col-md-4 col-sm-6 col-xs-12' style="float:right;">
                <div class="form-group" style="float: right;">
                        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-success', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>
                </div>
        </div>

        <?php ActiveForm::end(); ?>

</div>


<script>
        $(document).ready(function () {

                $('.promption-productid').hide();
                $('.promption-userid').hide();
                $('.promption-brand').hide();

                $('#promotions-promotion_type').change(function () {
                        var type = $(this).val();
                        if (type == 1) {
                                $('.promption-productid').show();
                                $('.promption-userid').hide();
                                $('.promption-brand').hide();
                        } else if (type == 2) {
                                $('.promption-userid').show();
                                $('.promption-productid').hide();
                                $('.promption-brand').hide();
                        } else if (type == 3) {
                                $('.promption-userid').show();
                                $('.promption-productid').show();
                                $('.promption-brand').show();
                        } else if (type == 4) {
                                $('.promption-brand').show();
                                $('.promption-userid').hide();
                                $('.promption-productid').hide();
                        }
                });

                var type = $('#promotions-promotion_type').val();
                if (type == 1) {
                        $('.promption-productid').show();
                        $('.promption-userid').hide();
                        $('.promption-brand').hide();
                } else if (type == 2) {
                        $('.promption-userid').show();
                        $('.promption-productid').hide();
                        $('.promption-brand').hide();
                } else if (type == 3) {
                        $('.promption-userid').show();
                        $('.promption-productid').show();
                        $('.promption-brand').show();
                } else if (type == 4) {
                        $('.promption-brand').show();
                        $('.promption-userid').hide();
                        $('.promption-productid').hide();
                }



                $("#promotions-user_id").select2({
                        placeholder: 'Select',
                        allowClear: true
                }).on('select2-open', function ()
                {
                        $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
                });

                $("#promotions-product_id").select2({
                        placeholder: 'Select',
                        allowClear: true
                }).on('select2-open', function ()
                {
                        $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
                });

                $("#promotions-brand").select2({
                        placeholder: 'Select',
                        allowClear: true
                }).on('select2-open', function ()
                {
                        $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
                });


                $('#promotions-type').change(function () {
                        var type = $(this).val();
                        if (type == 2) {
                                $("label[for*='promotions-price']").html("Amount");
                        } else {
                                $("label[for*='promotions-price']").html("Percentage");
                        }
                });
                var protype = $('#promotions-type').val();
                if (protype == 2) {
                        $("label[for*='promotions-price']").html("Amount");
                } else {
                        $("label[for*='promotions-price']").html("Percentage");
                }

        });

</script>