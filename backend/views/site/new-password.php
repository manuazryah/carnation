<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>

<section class="body-content body-content-top">
    <div class="page-content">

        <div class="container">

            <div class="row">

                <div class="col-sm-6" style="margin-top: 62px;">
                    <div class="forgot-header">
                        <h4>Forgot Your Password ?</h4>
                        <hr/>
                        <h5>Let us help you</h5>
                        <p>Type your new password here:</p>
                    </div>
                    <div class="forgot-body">
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

        </div>

    </div>

</section>