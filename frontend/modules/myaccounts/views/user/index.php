<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\CountryCode;
use yii\helpers\ArrayHelper;

$this->title = 'My Account';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content_breadcum">
    <div class="container">
        <ul class="breadcrumb">
            <li><?= Html::a('<i class="fa fa-home"></i>', ['/site/index']) ?></li>
            <li><a href="">My Account</a></li>
        </ul>
        <h1 class="page-title">My Account</h1>

    </div>
</div>
<div class="container">
    <div class="row my-account">
        <?= Yii::$app->controller->renderPartial('_leftside_menu'); ?>
        <div id="content" class="col-sm-9 content-myaccount">      
            <div class="row">
                <div class="col-sm-12">
                    <div class="well">
                        <p class="customer-name">Hello, <?= ucwords(Yii::$app->user->identity->first_name); ?>!</p>
                        <p>From  My Account Dashboard you have the ability to view a snapshot of your recent account activity and update your account
                            information. Select a link  to view or edit information.</p>
                        <?php $form = ActiveForm::begin(); ?>
                        <fieldset id="account">
                            <h3 class="title2">Your Personal Details</h3>

                            <div class="form-group required" style="display: none;">
                                <label class="col-sm-2 control-label">Customer Group</label>
                                <div class="col-sm-10">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="customer_group_id" value="1" checked="checked">
                                            Default</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-firstname">First Name</label>
                                <div class="col-sm-10">
                                    <?= $form->field($model, 'first_name')->textInput(['placeholder' => 'First Name'])->label(FALSE) ?>
                                    <!--<input type="text" name="firstname" value="" placeholder="First Name" id="input-firstname" class="form-control">-->
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-lastname">Last Name</label>
                                <div class="col-sm-10">
                                    <?= $form->field($model, 'last_name')->textInput(['placeholder' => 'Last Name', 'id' => 'input-lastname'])->label(FALSE) ?>
                                    <!--<input type="text" name="lastname" value="" placeholder="Last Name" id="input-lastname" class="form-control">-->
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-email">E-Mail</label>
                                <div class="col-sm-10">
                                    <?= $form->field($model, 'email')->textInput(['placeholder' => 'Email'])->label(FALSE) ?>
                                </div>
                            </div>
                            <?php $countrie_code = ArrayHelper::map(CountryCode::findAll(['status' => 1]), 'id', 'country_code'); ?>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-telephone">Mobile</label>
                                <div class="col-sm-10">
                                    <select class="day" id="cntry_code_id"style="position: absolute; border-right: 1px solid #d1d2d0;padding-top: 7px;padding-bottom: 6px;" name="SignupForm[country_code]">
                                        <?php
                                        foreach ($countrie_code as $key => $countrie_cod) {
                                            ?>
                                            <option value="<?= $key ?>"><?= $countrie_cod ?></option>
                                        <?php }
                                        ?>
                                    </select>
                                    <?= $form->field($model, 'mobile_no')->textInput(['class' => 'form-control mobile', 'placeholder' => 'Mobile No', 'style' => 'padding-left: 70px;'])->label(FALSE) ?>
                                </div>
                            </div>
                            <div class="form-group required">
                                <div class="col-sm-12">
                                    <?= Html::submitButton('Update', ['class' => 'btn btn-primary shadowbtn signup_submit my-accbtn']) ?>
                                </div>
                            </div>
                        </fieldset>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>