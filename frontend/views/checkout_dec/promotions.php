<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Emirates;
use yii\helpers\ArrayHelper;
use common\components\CartSummaryWidget;

$this->title = 'Checkout-Delivery';
?>
<div class="pad-20 hide-xs"></div>

<div class="container">
        <div class="breadcrumb">
                <span class="current-page">My account</span>
                <ol class="path">
                        <li><?= Html::a('<span>Home</span>', ['index'], ['class' => '']) ?></li>
                        <li class="active">My account</li>
                </ol>
        </div>
</div>

<div id="checkout" class="my-account">
        <div class="container">
                <div class="col-lg-7 col-md-7 col-sm-12 left-accordation">
                        <?= Html::a('<div class="heading"><p>1. Check out options </p></div>', ['cart/checkout'], ['class' => '']) ?>

                        <div class="heading margin-auto active">
                                <p>2.   Promotions</p>
                        </div>
                        <div class="content lit-blue delivery-details">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <?php $form = ActiveForm::begin(); ?>
                                        <p>If you have any promotion code please enter that code in the below textbox.</p>
                                        <div class="form-group col-lg-8 col-md-8 col-sm-8 col-xs-12 address-field xs-marg-0">
                                                <?= $form->field($promotion, 'promotion_code')->textInput(['class' => 'form-control promotion-code', 'placeholder' => 'Enter Code Here'])->label(FALSE) ?>
                                        </div>

                                        <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4 address-field">
                                                <a style="cursor: pointer" class="add-promotion">ADD</a>
                                        </div>
                                </div>
                                <div class="clearfix"></div>

                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 promotion-table" id='id-promotion-table'>
                                        <?php
                                        if (!empty($added_promotions)) {
                                                foreach ($added_promotions as $value) {
                                                        $code = '';
                                                        $promo = common\models\Promotions::findOne($value->promotion_id);
                                                        if (isset($promo->promotion_code))
                                                                $code = $promo->promotion_code
                                                                ?>
                                                        <p id="disc_<?= $value->id ?>"> Promotion  code <?= $code ?> is added with AED. <?= $value->promotion_discount ?> /- off <a class="promotion-remove" title="Remove" id="<?= $value->id ?>">x</a></p>
                                                        <?php
                                                }
                                        }
                                        ?>
                                </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 lit-blue" style="padding: 0 30px;padding-right: 55px; padding-bottom: 30px; margin-bottom: 5px;">
                                <?= Html::submitButton('continue', ['class' => 'green2']) ?>
                        </div>
                        <?php ActiveForm::end(); ?>
                        <div class="heading">
                                <p>3.   Account & Billing Details</p>
                        </div>
                        <div class="heading">
                                <p>4.   Delivery Details</p>
                        </div>

                        <div class="heading">
                                <p>5.   Confirm Order</p>
                        </div>
                </div>

                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 product-summery">
                        <?= CartSummaryWidget::widget(); ?>
                </div>

        </div>
</div>

<div class="pad-20"></div>
<script>

        $('#delivery').on('change', function () {
                var id = $(this).val();
                if (id === '') {
                        $('.delivery').prop('readonly', false);
                } else {
                        $('.delivery').prop('readonly', true);
                }
                changeaddress('useraddress', id);
        });
        function changeaddress(formclass, id) {
                $.ajax({
                        type: "POST",
                        cache: 'false',
                        async: false,
                        url: homeUrl + 'checkout/getadress',
                        data: {id: id}
                }).done(function (data) {
                        var $data = JSON.parse(data);
                        if ($data.rslt === "success") {
                                $('#' + formclass + '-name').val($data.name);
                                $('#' + formclass + '-address').val($data.address);
                                $('#' + formclass + '-landmark').val($data.landmark);
                                $('#' + formclass + '-location').val($data.location);
                                $('#' + formclass + '-emirate').val($data.emirate);
                                $('#' + formclass + '-post_code').val($data.post_code);
                                $('#' + formclass + '-mobile_number').val($data.mobile_number);
                                $('#' + formclass + '-country_code').val($data.country_code);

                        } else {
                                $('#' + formclass + '-name').val('');
                                $('#' + formclass + '-address').val('');
                                $('#' + formclass + '-landmark').val('');
                                $('#' + formclass + '-location').val('');
                                $('#' + formclass + '-emirate').val('');
                                $('#' + formclass + '-post_code').val('');
                                $('#' + formclass + '-mobile_number').val('');
//                $('#' + formclass + '-country_code').val('');
                        }
                });
        }
</script>