<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Change password';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-reset-password">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please choose your new password:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php
            $form = ActiveForm::begin(
                            [
                                'id' => 'change-password',
                                'method' => 'post',
                                'options' => [
                                    'class' => 'login-form fade-in-effect changepassword-form'
                                ]
                            ]
            );
            ?>
            <div style="font-size: 17px;
                 color: hsla(0, 100%, 50%, 0.81);">

                <?= Yii::$app->session->getFlash('error'); ?>
                <?= Yii::$app->session->getFlash('success'); ?>
            </div>

            <div class="form-group">
                <div class="form-group field-employee-password">
                    <label class="control-label" for="old-password">Old Password</label>
                    <input type="password" id="old-password" class="form-control input-dark" name="old-password" required>
                    <p class="help-block help-block-error"></p>
                </div>

            </div>
            <div class="form-group">
                <div class="form-group field-employee-password">
                    <label class="control-label" for="new-password">New Password</label>
                    <input type="password" id="new-password" class="form-control input-dark" name="new-password" required>
                    <p class="help-block help-block-error"></p>
                </div>

            </div>
            <div class="form-group">
                <div class="form-group field-employee-password">
                    <label class="control-label" for="confirm-password">Confirm Password</label>
                    <input type="password" id="confirm-password" class="form-control input-dark" name="confirm-password" required>
                    <p class="help-block help-block-error"></p>
                </div>

            </div>

            <div class="form-group">
                <?= Html::submitButton('<i class="fa-lock"></i>Submit', ['class' => 'btn btn-dark  btn-block text-left']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
