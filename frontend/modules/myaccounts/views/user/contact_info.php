<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

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
    .field-user-mobile_no{
        padding: 0px !important;
    }
</style>
<div class="pad-20 hide-xs"></div>

<div class="container">
    <div class="breadcrumb">
        <span class="current-page">Update Email/Mobile</span>
        <ol class="path">
            <li><?= Html::a('<span>Home</span>', ['/site/index'], ['class' => '']) ?></li>
            <li><?= Html::a('<span>My account</span>', ['/myaccounts/user/index'], ['class' => '']) ?></li>
            <li class="active">Email/Mobile</li>
        </ol>
    </div>
</div>

<div id="our-product" class="my-account">
    <div class="container">
        <?= Yii::$app->controller->renderPartial('_leftside_menu'); ?>
        <div class="settings">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 right-box" style="padding: 50px 15px;">
                <div class="col-lg-12 col-md-12 col-sm-8 col-xs-12 my-account-cntnt margin-auto align-center">

                    <p class="contact-information">Enter the new Email ID / Mobile number you wish to associate with your account. </p>
                    <?php
                    if ($model->email_verification == NULL) {
                        ?>
                        <p style="color: red;font-weight: 600;">(Please verify Email Id).</p>
                                <!--<div class="email_verify_div"><p class="email_verify_p"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>Please verify your Email Id</p></div>-->
                        <?php
                    } else {
                        ?>
                        <p style="color: green;font-weight: 600;">(Email Id is verified).</p>
                    <?php }
                    ?>

                    <div class="row">
                        <div class="form-feild-box pad-lft0">
                            <?php $form = ActiveForm::begin(); ?>
                            <div class="col-md-8 pad-0">
                                <?= $form->field($model, 'email')->textInput(['maxlength' => true])->label('Email') ?>
                            </div>
                            <div class="form-group col-md-8">
                                <label for="pwd">Mobile Number</label>
                                <div class="date-dropdowns" style="">
                                    <select class="day" style="position: absolute; border-right: 1px solid #d1d2d0" id="user-country_code" name="UserAddress[country_code]">
                                    <!--<select id="signupform-day" class="day" name="SignupForm[day]">-->
                                        <?php foreach ($country_codes as $country_code) { ?>
                                            <option value="<?= $country_code ?>" <?= $country_code == $model->country_code ? ' selected' : '' ?>><?= $country_code ?></option>
                                        <?php }
                                        ?>
                                    </select>
                                    <?= $form->field($model, 'mobile_no')->textInput(['placeholder' => '555 555 5555', 'data-format' => '+1 (ddd) ddd-dddd', 'style' => 'padding-left: 70px;'])->label(FALSE) ?>
                                    <!--<input style="padding-left: 70px;" type="phone" id="user-mobile_number" class="form-control" name="UserAddress[mobile_number]" value="<?php // $model->mobile_number                                                           ?>" maxlength="15" aria-invalid="false" data-format="+1 (ddd) ddd-dddd">-->
                                </div>
                            </div>
                            <!--                            <div class="col-md-8 pad-0">
                            <?php // $form->field($model, 'mobile_no')->textInput(['maxlength' => true])->label('Mobile No')        ?>
                                                        </div>-->
                            <div class="col-md-8">
                                <?= Html::submitButton('save changes', ['class' => 'green2']) ?>
                            </div>
                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                    <div class="pad-20"></div>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="pad-20"></div>
<script>
    $("document").ready(function () {
        $("#user-email").blur(function () {
            emailunique();
            //showLoader();
        });
        $("body").click(function () {
            emailunique();
            //showLoader();
        });
    });
    function emailunique() {
        //showLoader();
        var email = $("#user-email").val();
        $.ajax({
            type: 'POST',
            cache: false,
            data: {email: email},
            url: homeUrl + 'myaccounts/user/email-unique',
            success: function (data) {
                if (data == 0) {
                    $(".field-user-email").addClass('has-error');
                    if ($(".field-user-email div").text() === "") {
                        $(".field-user-email div").append('Email "' + email + '" has already been taken.');
                    }
                }
                hideLoader();
            }
        });
    }
</script>
