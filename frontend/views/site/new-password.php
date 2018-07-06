<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\CountryCode;
use yii\helpers\ArrayHelper;

$this->title = 'Change-password';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content_breadcum">
    <div class="container">
        <ul class="breadcrumb">
            <li><?= Html::a('<i class="fa fa-home"></i>', ['/site/index']) ?></li>
            <li><a href="">Change password</a></li>
        </ul>
        <h1 class="page-title">Change password</h1>

    </div>
</div>
<div class="container">
    <div class="row signup-login">
        <div id="content" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="panel">
                <div class="row contact-info">

                    <div class="col-sm-6">
                        <div class="well bg-white">
                            <h4 class="text-center">Change Your password</h4>


                            <?php
                            $form = ActiveForm::begin(
                                            [
                                                'id' => 'forgot-email',
                                                'method' => 'post',
                                                'options' => [
                                                    'class' => 'login-form fade-in-effect forgot-form'
                                                ]
                                            ]
                            );
                            ?>
                            <div style="font-size: 17px;
                                 color: hsla(0, 100%, 50%, 0.81);">

                                <?= Yii::$app->session->getFlash('error'); ?>
                                <?= Yii::$app->session->getFlash('success'); ?>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 field-employee-password">
                                    <label class="control-label" for="new-password">New Password</label>
                                    <input type="password" id="new-password" class="form-control input-dark" name="new-password" required>
                                    <p class="help-block help-block-error"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12 field-employee-password confirm_password">
                                    <label class="control-label" for="confirm-password">Confirm Password</label>
                                    <input type="password" id="confirm-password" class="form-control input-dark" name="confirm-password" required>
                                    <p class="help-block help-block-error"></p>
                                </div>
                            </div>
                            <div class="row">

                                <div class="form-group col-md-12">
                                    <div class="pull-right">
                                        <?= Html::submitButton('submit', ['class' => 'green2']) ?>
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