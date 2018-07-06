<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\CountryCode;
if (isset($meta_title) && $meta_title != '')
        $this->title = $meta_title;
else
        $this->title = 'Carnation';
?>
<?php
$country_codes = ArrayHelper::map(\common\models\CountryCode::find()->where(['status' => 1])->orderBy(['id' => SORT_ASC])->all(), 'id', 'country_code');
?>
<div class="content_breadcum">
    <div class="container">
        <ul class="breadcrumb">
            <li><?= Html::a('<i class="fa fa-home"></i>', ['/site/index']) ?></li>
            <li><a href="">Login</a></li>
        </ul>
        <h1 class="page-title">Login</h1>

    </div>
</div>
<div class="container">
    <div class="row signup-login">
        <div id="content" class="col-sm-12">      
            <div class="row">

                <div class="col-sm-6">
                    <div class="well bg-white">
                        <h3>New Customer</h3>
                        <p><strong>Register Account</strong></p>
                        <p>By creating an account you will be able to shop faster, be up to date on an order's status, and keep track of the orders you have previously made.</p>
                        <?= Html::a('Continue', ['site/signup'], ['class' => 'btn shadowbtn']) ?>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="well bg-white">
                        <h3>Returning Customer</h3>
                        <p><strong>I am a returning customer</strong></p>
                        <?php $form = ActiveForm::begin(['action' => ['site/login'], 'options' => ['method' => 'post']]) ?>
                        <div class="form-group">
                            <label class="control-label" for="input-email">E-Mail Address</label>
                            <?= $form->field($model_login, 'email')->textInput(['placeholder' => 'Email Id'])->label(FALSE) ?>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="input-password">Password</label>
                            <?= $form->field($model_login, 'password')->passwordInput(['placeholder' => '********'])->label(FALSE) ?>
                            <?= Html::a('Forgotten Password', ['site/forgot'], ['class' => 'fblack']) ?>
                        </div>
                        <div class="buttons submit-btn">
                            <div class="pull-left">
                                <input class="btn btn-primary shadowbtn" type="submit" value="Login">
                            </div>
                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $("document").ready(function () {
//		$("#email_id").blur(function () {
//
//			var email = $(this).val();
//			emailunique(email);
//			//showLoader();
//
//		});
//		$("#username_id").blur(function () {
//			var username = $(this).val();
//			usernameunique(username);
//		});
        $("body").click(function (event) {
            var clicked_id = event.target.id;
            var arr = ["signupform-password_repeat", "last_name_id", "email_id", "signupform-country", "signupform-gender", "signupform-day", "signupform-month", "signupform-year", "signupform-mobile_no", "signupform-password"];
            if (jQuery.inArray(clicked_id, arr) !== -1) {
                displayerrors(clicked_id);
            }
            $("#email_id").blur(function () {
                var email = $(this).val();
                emailunique(email);
                //showLoader();
            });
//            $("#username_id").blur(function () {
//                var username = $(this).val();
//                usernameunique(username);
//            });
            $('#signupform-password_repeat').on('keyup', function () {
                CheckConfirmPasswordMatch();
            });
            /*
             * Purpose   :- On change of country dropdown
             * parameter :- country_id
             * return   :- The list of states depends on the country_id
             */
            $('#signupform-country').change(function () {
                var country_id = $(this).val();
                //showLoader();
                $.ajax({
                    type: 'POST',
                    cache: false,
                    data: {country_id: country_id},
                    url: homeUrl + 'ajax/countrycode',
                    success: function (data) {
                        if (data == 0) {
                            alert('Failed to Load data, please try again error:1001');
                        } else {
                            $('#cntry_code_id').val(data).attr("selected", "selected");
                            //$(".state-change").html(data);
                        }
                        hideLoader();
                    }
                });
            });
            function CheckConfirmPasswordMatch() {
                if (($("#signupform-password_repeat ").val()) !== ($("#signupform-password ").val())) {
                    $(".field-signupform-password_repeat ").addClass('has-error');
                    if ($(".field-signupform-password_repeat div").text() === "") {
                        $(".field-signupform-password_repeat div").append("Password Mismatch");
                    }
                } else {
                    $(".field-signupform-password_repeat ").removeClass('has-error');
                    $(".field-signupform-password_repeat div").text("");
                    $(".field-signupform-password_repeat ").addClass('has-success');
                }
            }
            function displayerrors(clicked_id, arr) {
                if (!$("#first_name_id").val()) {
                    $(".field-first_name_id ").addClass('has-error');
                    if ($(".help-block").text() === "") {
                        $(".field-first_name_id div").append("First Name cannot be blank");
                    }
                }
                if ((!$("#email_id").val()) && (clicked_id !== "last_name_id")) {
                    $(".field-email_id ").addClass('has-error');
                    if ($(".field-email_id div").text() === "") {
                        $(".field-email_id div").append("Email Id cannot be blank");
                    }
                } else {
                    emailunique($("#email_id").val());
                }
//                if (($("#signupform-day").val() === "") && (clicked_id !== "signupform-country") && (clicked_id !== "signupform-gender") && ($("#signupform-month").val() === "") && ($("#signupform-year").val() === "") && (clicked_id !== "last_name_id") && (clicked_id !== "email_id")) {
//                    $('#date_form_group_id').addClass("required has-error");
//                    if ($("#dob_id div").text() === "") {
//                        $('#dob_id').append($('<div class="help-block"> DOB cannot be blank </div>'));
//                    }
//                } else {
//                    $('#date_form_group_id').removeClass("required has-error");
//                    $('#dob_id div').empty();
//                }
//				if ((!$("#username_id").val()) && (clicked_id !== "signupform-mobile_no") && (clicked_id !== "signupform-day") && (clicked_id !== "signupform-month") && (clicked_id !== "signupform-year") && (clicked_id !== "signupform-country") && (clicked_id !== "signupform-gender") && (clicked_id !== "last_name_id") && (clicked_id !== "email_id") && (clicked_id !== "signupform-mobile_no")) {
//					$(".field-username_id ").addClass('has-error');
//					if ($(".field-username_id div").text() === "") {
//						$(".field-username_id div").append("Username cannot be blank");
//					}
//				}
                if ((!$("#signupform-password").val()) && (clicked_id !== "signupform-password") && (clicked_id !== "signupform-mobile_no") && (clicked_id !== "signupform-day") && (clicked_id !== "signupform-month") && (clicked_id !== "signupform-year") && (clicked_id !== "signupform-country") && (clicked_id !== "signupform-gender") && (clicked_id !== "last_name_id") && (clicked_id !== "email_id")) {
                    $(".field-signupform-password ").addClass('has-error');
                    if ($(".field-signupform-password div").text() === "") {
                        $(".field-signupform-password div").append("Passwordcannot be blank");
                    }
                }
            }
        });
//		function usernameunique(username) {
//			//showLoader();
//			$.ajax({
//				type: 'POST',
//				cache: false,
//				data: {username: username},
//				url: homeUrl + 'ajax/user-unique',
//				success: function (data) {
//					if (data == 0) {
//
//						$(".field-username_id").addClass('has-error');
//						if ($(".field-username_id div").text() === "") {
//							$(".field-username_id div").append("Username Already Exist");
//						}
//					}
//					hideLoader();
//				}
//			});
//
//		}
        function emailunique(email) {
            //showLoader();
            $.ajax({
                type: 'POST',
                cache: false,
                data: {email: email},
                url: homeUrl + 'ajax/email-unique',
                success: function (data) {
                    if (data == 0) {
                        $(".field-email_id").addClass('has-error');
                        if ($(".field-email_id div").text() === "") {
                            $(".field-email_id div").append("Email Id Already Exist");
                        }
                    }
                    hideLoader();
                }
            });
        }
    });
</script>