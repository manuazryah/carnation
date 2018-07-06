<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\components\CartSummaryWidget;
use common\models\Emirates;
use yii\helpers\ArrayHelper;

$this->title = 'Checkout';
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
                        <div class="heading">
                                <p>1. Check out options </p>
                        </div>
                        <div class="heading">
                                <p>2.   Promotions</p>
                        </div>

                        <div class="heading margin-auto active">
                                <p>3.   Account & Billing Details</p>
                        </div>
                        <div class="content lit-blue">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <?php $form = ActiveForm::begin(); ?>
                                        <div class="form-group col-lg-8 col-md-8 col-sm-8 col-xs-12 address-field">
                                                <label for="usr">Name</label>
                                                <?= $form->field($model, 'name')->textInput(['class' => 'form-control'])->label(FALSE) ?>
                                        </div>
                                        <div class="form-group col-lg-8 col-md-8 col-sm-8 col-xs-12 address-field">
                                                <label for="usr">Address</label>
                                                <?= $form->field($model, 'address')->textInput(['class' => 'form-control'])->label(FALSE) ?>
                                        </div>
                                        <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                <label for="usr">Landmark</label>
                                                <?= $form->field($model, 'landmark')->textInput(['class' => 'form-control'])->label(FALSE) ?>
                                        </div>
                                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12 location-field">
                                                <label for="usr">Location</label>
                                                <?= $form->field($model, 'location')->textInput(['class' => 'form-control'])->label(FALSE) ?>
                                        </div>
                                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12 emirate-field">
                                                <label for="pwd">Emirate</label>
                                                <?= $form->field($model, 'emirate')->dropDownList(ArrayHelper::map(Emirates::find()->all(), 'id', 'name'), ['prompt' => 'select'])->label(FALSE); ?>
                                        </div>
                                        <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12 post-code-field">
                                                <label for="pwd">Post Code</label>
                                                <?= $form->field($model, 'post_code')->textInput(['class' => 'form-control'])->label(FALSE) ?>
                                        </div>
                                        <div class="form-group col-lg-8 col-md-8 col-sm-8 col-xs-12 number-field">
                                                <label for="pwd">Mobile Number</label>
                                                <div class="date-dropdowns" style="padding-right: 15px;">
                                                        <select class="day" style="position: absolute; border-right: 1px solid #d1d2d0" id="useraddress-country_code" name="UserAddress[country_code]">
                                                        <!--<select id="signupform-day" class="day" name="SignupForm[day]">-->
                                                                <?php foreach ($country_codes as $country_code) { ?>
                                                                        <option value="<?= $country_code ?>" <?= $country_code == $model->country_code ? ' selected' : '' ?>><?= $country_code ?></option>
                                                                <?php }
                                                                ?>
                                                        </select>
                                                        <?= $form->field($model, 'mobile_number')->textInput(['class' => 'form-control', 'style' => 'padding-left: 70px'])->label(FALSE) ?>
                                                        <!--<input style="padding-left: 70px;" type="phone" id="user-mobile_number" class="form-control" name="UserAddress[mobile_number]" value="<?= $model->mobile_number ?>" maxlength="15" aria-invalid="false" data-format="+1 (ddd) ddd-dddd">-->
                                                </div>
                                        </div>
                                        <div class="form-group login-group-checkbox margin-auto col-md-12">
                                                <label> <input type="checkbox" value='1' id="lg_remember" name="UserAddress[check]">My delivery and billing addresses are the same.</label>
                                        </div>
                                </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 lit-blue" style="padding: 0 30px;padding-right: 55px; padding-bottom: 30px; margin-bottom: 5px;">
                                <!--<a href="delivery-details.php"> <button class="green2">continue</button></a>-->
                                <?= Html::submitButton('continue', ['class' => 'green2']) ?>
                        </div>
                        <?php ActiveForm::end(); ?>
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
