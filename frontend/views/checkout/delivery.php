<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\components\CartSummaryWidget;
use common\models\Emirates;
use yii\helpers\ArrayHelper;

$this->title = 'Checkout';
?>
<div class="cart-page pbtm40  anyflexbox woocommerce-cart">
    <div class="content_breadcum" style="background-position: 50% 0px;"></div>
    <div data-vc-full-width="true" data-vc-full-width-init="true" class="vc_row wpb_row vc_row-fluid  vc_custom_ vc_row-has-fill   vc_hidden" style="position: relative; left: 0px; box-sizing: border-box; width: 1349px; padding-left: 0px; padding-right: 0px; margin: 0 auto; margin-bottom: 35px; margin-top: 15px; background: #1a1a1a; opacity: 1; ">
        <div class="container">
            <!--<h1 class="page-title">Contact Us</h1>-->
            <ul class="breadcrumb">
                <li><a href="index.php"><i class="fa fa-home"></i></a></li>
                <!--<li><a href="my-account.php">Cart</a></li>-->
                <li class="active"><a>Billing</a></li>
            </ul>
        </div>
    </div>
    <div id="checkout" class="my-account">
        <div class="container">
            <div class="col-lg-7 col-md-7 col-sm-12 left-accordation">

                <h3>Shipping Address</h3>
                <div class="content lit-blue">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <?php $form = ActiveForm::begin(); ?>
                        <div class="form-group col-lg-12 col-md-8 col-sm-8 col-xs-12 address-field">
                            <label for="usr">Shipping Address*</label>
                            <select class="form-control" id="delivery" name="UserAddress[billing]">
                                <option value=''>Select</option>
                                <?php foreach ($addresses as $address) { ?>
                                    <option value="<?= $address->id ?>" ><?= $address->address . ', ' . $address->landmark . ', ' . $address->location ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div>OR ADD NEW</div>

                        <div class="form-group col-lg-8 col-md-8 col-sm-8 col-xs-12 address-field">
                            <label for="usr">Name</label>
                            <?= $form->field($model, 'name')->textInput(['class' => 'form-control billing'])->label(FALSE) ?>
                        </div>
                        <div class="form-group col-lg-8 col-md-8 col-sm-8 col-xs-12 address-field">
                            <label for="usr">Address</label>
                            <?= $form->field($model, 'address')->textInput(['class' => 'form-control billing'])->label(FALSE) ?>
                        </div>
                        <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label for="usr">Landmark</label>
                            <?= $form->field($model, 'landmark')->textInput(['class' => 'form-control billing'])->label(FALSE) ?>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12 location-field">
                            <label for="usr">Location</label>
                            <?= $form->field($model, 'location')->textInput(['class' => 'form-control billing'])->label(FALSE) ?>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12 emirate-field">
                            <label for="pwd">Emirate</label>
                            <?= $form->field($model, 'emirate')->dropDownList(ArrayHelper::map(Emirates::find()->all(), 'id', 'name'), ['prompt' => 'select'])->label(FALSE); ?>
                        </div>

                        <div class="form-group col-lg-8 col-md-8 col-sm-8 col-xs-12 number-field">
                            <label for="pwd">Mobile Number</label>
                            <div class="date-dropdowns" style="padding-right: 15px;">
                                <select class="day" style="position: absolute;border-right: 1px solid #d1d2d0;height: 33px;" id="useraddress-country_code" name="UserAddress[country_code]">
                                <!--<select id="signupform-day" class="day" name="SignupForm[day]">-->
                                    <?php foreach ($country_codes as $country_code) { ?>
                                        <option value="<?= $country_code ?>" <?= $country_code == $model->country_code ? ' selected' : '' ?>><?= $country_code ?></option>
                                    <?php }
                                    ?>
                                </select>
                                <?= $form->field($model, 'mobile_number')->textInput(['class' => 'form-control billing mobile', 'style' => 'padding-left: 70px'])->label(FALSE) ?>
                                <!--<input style="padding-left: 70px;" type="phone" id="user-mobile_number" class="form-control" name="UserAddress[mobile_number]" value="<?= $model->mobile_number ?>" maxlength="15" aria-invalid="false" data-format="+1 (ddd) ddd-dddd">-->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 lit-blue" style="padding: 0 30px;padding-right: 55px; padding-bottom: 30px; margin-bottom: 5px;">
                    <!--<a href="delivery-details.php"> <button class="green2">continue</button></a>-->
                    <?= Html::submitButton('continue', ['class' => 'green2']) ?>
                </div>
                <?php ActiveForm::end(); ?>
                
            </div>

            <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 product-summery">
                <?= CartSummaryWidget::widget(); ?>
            </div>

        </div>
    </div>
</div>
<script>

        jQuery('#delivery').on('change', function () {
                var id = jQuery(this).val();
                if (id === '') {
                        jQuery('.delivery').prop('readonly', false);
                } else {
                        jQuery('.delivery').prop('readonly', true);
                }
                changeaddress('useraddress', id);
        });
        function changeaddress(formclass, id) {
                jQuery.ajax({
                        type: "POST",
                        cache: 'false',
                        async: false,
                        url: homeUrl + 'checkout/getadress',
                        data: {id: id}
                }).done(function (data) {
                        var $data = JSON.parse(data);
                        if ($data.rslt === "success") {
                                jQuery('#' + formclass + '-name').val($data.name);
                                jQuery('#' + formclass + '-address').val($data.address);
                                jQuery('#' + formclass + '-landmark').val($data.landmark);
                                jQuery('#' + formclass + '-location').val($data.location);
                                jQuery('#' + formclass + '-emirate').val($data.emirate);
                                jQuery('#' + formclass + '-mobile_number').val($data.mobile_number);
                                jQuery('#' + formclass + '-country_code').val($data.country_code);

                        } else {
                                jQuery('#' + formclass + '-name').val('');
                                jQuery('#' + formclass + '-address').val('');
                                jQuery('#' + formclass + '-landmark').val('');
                                jQuery('#' + formclass + '-location').val('');
                                jQuery('#' + formclass + '-emirate').val('');
                                jQuery('#' + formclass + '-mobile_number').val('');
//                $('#' + formclass + '-country_code').val('');
                        }
                });
        }
</script>