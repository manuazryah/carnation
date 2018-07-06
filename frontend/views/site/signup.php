<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\CountryCode;
use yii\helpers\ArrayHelper;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
if (isset($meta_title) && $meta_title != '')
        $this->title = $meta_title;
else
        $this->title = 'Carnation';
?>
<div class="content_breadcum">
    <div class="container">
        <ul class="breadcrumb">
            <li><?= Html::a('<i class="fa fa-home"></i>', ['/site/index']) ?></li>
            <li><a href="">Sign Up</a></li>
        </ul>
        <h1 class="page-title">Sign Up</h1>

    </div>
</div>
<div class="container">
    <div class="row signup-login">
        <div id="content" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="panel">
                <div class="row contact-info">

                    <div class="col-sm-12">
                        <div class="well bg-white">
                            <h3 class="title2">New User Registration</h3>
                            <p>If you already have an account with us, please login at the  <?= Html::a('login page', ['/site/login-signup']) ?>.</p>
                            <?php
                            $form = ActiveForm::begin([
                                        'id' => 'signup-form',
                            ]);
                            ?>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="input-email">First Name  <span class="astrik">*</span></label>
                                    <?= $form->field($model, 'first_name')->textInput(['placeholder' => 'First Name'])->label(FALSE) ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="input-email">Last Name <span class="astrik">*</span> </label>
                                    <?= $form->field($model, 'last_name')->textInput(['placeholder' => 'Last Name'])->label(FALSE) ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="input-email">E-Mail  <span class="astrik">*</span></label>
                                    <?= $form->field($model, 'email')->textInput(['placeholder' => 'E-Mail'])->label(FALSE) ?>
                                </div>
                                <?php $countrie_code = ArrayHelper::map(CountryCode::findAll(['status' => 1]), 'id', 'country_code'); ?>
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="input-email">Mobile <span class="astrik">*</span> </label>
                                    <select class="day" id="cntry_code_id"style="border: none;position: absolute;border-right: 1px solid #d1d2d0;padding-top: 5px;padding-bottom: 5px;left: 16px;top: 24px;border-bottom-left-radius: 5px;border-top-left-radius: 5px;" name="SignupForm[country_code]">
                                        <?php
                                        foreach ($countrie_code as $key => $countrie_cod) {
                                            ?>
                                            <option value="<?= $key ?>"><?= $countrie_cod ?></option>
                                        <?php }
                                        ?>
                                    </select>
                                    <?= $form->field($model, 'mobile_no')->textInput(['placeholder' => 'Mobile No', 'class' => 'mobile form-control', 'style' => 'padding-left: 70px;'])->label(FALSE) ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="input-email">Password  <span class="astrik">*</span></label>
                                    <?= $form->field($model, 'password')->passwordInput()->label('Password*')->label(FALSE) ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="input-email">Confirm Password <span class="astrik">*</span> </label>
                                    <?= $form->field($model, 'password_repeat')->passwordInput(['placeholder' => 'Confirm Password'])->label(FALSE) ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <?= $form->field($model, 'rules')->checkBox() ?>
                                    <div class="g-recaptcha" style="" data-sitekey="6LfASkMUAAAAAKb0YThDF1KSdEFtkltDfiBI9_iI"></div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="pull-right">
                                        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary shadowbtn', 'style' => 'margin-top: 82px;']) ?>
                                    </div>
                                </div>
                            </div>
                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>