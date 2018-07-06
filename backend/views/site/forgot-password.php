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
                        <p>Type your username / email ID in the field below to receive your validation code by email:</p>
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
                        <label class="control-label" for="adminusers-user_name" style="    color: white;
                               font-size: 14px;
                               font-weight: bold;">Email / Username
                        </label>
                        <div class="form-group">
<!--<label class="control-label" for="adminusers-user_name">User Name / Email</label>-->
                            <?= $form->field($model, 'user_name')->textInput(['class' => 'form-control input-dark'], ['autofocus' => true, 'placeholder' => "Username"])->label(false) ?>
                        </div>
<!--                        <div class="form-group">
                            <label class="control-label" for="adminusers-user_name">User Name / Email</label>
                            <input type="text" id="adminusers-user_name" class="form-control" name="AdminUsers[user_name]" maxlength="30" aria-invalid="false">

                            <div class="help-block"></div>
                        </div>-->

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