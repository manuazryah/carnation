<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\CountryCode;
use yii\helpers\ArrayHelper;

$this->title = 'Forgot-password';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content_breadcum">
    <div class="container">
        <ul class="breadcrumb">
            <li><?= Html::a('<i class="fa fa-home"></i>', ['/site/index']) ?></li>
            <li><a href="">Forgot password</a></li>
        </ul>
        <h1 class="page-title">Forgot password</h1>

    </div>
</div>
<div class="container">
    <div class="row signup-login">
        <div id="content" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="panel">
                <div class="row contact-info">

                    <div class="col-sm-12">
                        <div class="well bg-white">
                            <h4 class="text-center">Forgot Your password?</h4>
                <?php if (Yii::$app->session->hasFlash('error')): ?>
                    <div class="alert alert-danger" role="alert">
                        <?= Yii::$app->session->getFlash('error') ?>
                    </div>
                <?php endif; ?>
                <?php if (Yii::$app->session->hasFlash('success')): ?>
                    <div class="alert alert-success" role="alert">
                        <?= Yii::$app->session->getFlash('success') ?>
                    </div>
                <?php endif; ?>
                <h6 style="font-family: roboto-medium; font-size: 16px; color: #8c8c8c; margin-top: 25px">No Problem!</h6>
                <p class="sub-discrip">We will send you an email to reset your password. Just enter the same email address you used for registration on carnation.com. We will send you an email with instructions for resetting your password.</p>
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
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="control-label" for="input-email">Email  <span class="astrik">*</span></label>
                                    <?= $form->field($model, 'email')->textInput(['placeholder' => 'Email'])->label(FALSE) ?>
                                </div>
                                
                            </div>
                            <div class="row">
                                
                                <div class="form-group col-md-6">
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