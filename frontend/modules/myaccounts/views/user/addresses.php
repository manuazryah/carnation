<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Emirates;
use common\models\CountryCode;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="content_breadcum">
    <div class="container">
        <ul class="breadcrumb">
            <li><?= Html::a('<i class="fa fa-home"></i>', ['/site/index']) ?></li>
            <li><a href="">Address Book</a></li>
        </ul>
        <h1 class="page-title">Address Book</h1>

    </div>
</div>
<div class="container">
    <div class="row my-account">
        <?= Yii::$app->controller->renderPartial('_leftside_menu'); ?>
        <div id="content" class="col-sm-9 content-myaccount">      
            <div class="row">
                <div class="col-sm-12">
                    <div class="well">
                        <h3 class="title2">Addresses</h3>
                        <p>The following addresses will be used on the checkout page by default.</p>
                        <?php $form = ActiveForm::begin(); ?>
                        <fieldset id="address">
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-firstname">Name</label>
                                <div class="col-sm-10">
                                    <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label(FALSE) ?>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-lastname">Address</label>
                                <div class="col-sm-10">
                                    <?= $form->field($model, 'address')->textInput(['maxlength' => true])->label(FALSE) ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-email">Landmark</label>
                                <div class="col-sm-10">
                                    <?= $form->field($model, 'landmark')->textInput(['maxlength' => true])->label(FALSE) ?>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-telephone">Location</label>
                                <div class="col-sm-10">
                                    <?= $form->field($model, 'location')->textInput(['maxlength' => true])->label(FALSE) ?>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-telephone">Emirate</label>
                                <div class="col-sm-10">
                                    <?= $form->field($model, 'emirate')->dropDownList(ArrayHelper::map(Emirates::find()->all(), 'id', 'name'), ['prompt' => 'select'])->label(FALSE); ?>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-telephone">Post Code</label>
                                <div class="col-sm-10">
                                    <?= $form->field($model, 'post_code')->textInput(['maxlength' => true])->label(FALSE) ?>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label class="col-sm-2 control-label" for="input-telephone">Mobile</label>
                                <div class="col-sm-10">
                                    <?php $countrie_code = ArrayHelper::map(CountryCode::findAll(['status' => 1]), 'id', 'country_code'); ?>
                                    <select class="day" id="cntry_code_id"style="position: absolute; border-right: 1px solid #d1d2d0;padding-top: 7px;padding-bottom: 6px;" name="SignupForm[country_code]">
                                        <?php
                                        foreach ($countrie_code as $key => $countrie_cod) {
                                            ?>
                                            <option value="<?= $key ?>"><?= $countrie_cod ?></option>
                                        <?php }
                                        ?>
                                    </select>
                                    <?= $form->field($model, 'mobile_number')->textInput(['class' => 'form-control mobile', 'placeholder' => 'Mobile No', 'style' => 'padding-left: 70px;'])->label(FALSE) ?>
                                </div>
                            </div>
                            <div class="form-group required">
                                <div class="col-sm-12">
                                    <div class="pull-right">
                                        <?= Html::submitButton('Save Address', ['class' => 'btn btn-primary shadowbtn my-accbtn']) ?>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <?php ActiveForm::end(); ?>
                        <div class="clearfix"></div>
                        <?php
                        if (!empty($user_address)) {
                            ?>
                        <h6 class="address-head">Your Saved Addresses:</h6>
                            <?php
                            foreach ($user_address as $value) {
                                ?>
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 lit-blue" id="useraddress-<?= $value->id ?>">
                                    <div class="user-adddress">
                                        <div class="user-address-hei">
                                            <p><strong><?= $value->name ?></strong></p>
                                            <p><?= $value->address ?></p>
                                            <p><?= $value->landmark ?></p>
                                            <p><?= $value->location ?></p>
                                            <p><?= $value->post_code ?></p>
                                            <p><?= $value->mobile_number ?></p>
                                        </div>
                                        <label id="Radio0">
                                            <input type="radio" name="default-address" value="<?= $value->id ?>" <?php
                                            if ($value->status == 1) {
                                                echo ' checked';
                                            }
                                            ?> data-waschecked="true" />
                                            Default address
                                        </label>
                                        <a href="" class="delete-address" data-val="<?= $value->id ?>"><i class="fa fa-trash" aria-hidden="true"></i>Delete address</a>
                                    </div>
                                </div>
                                <?php
                            }
                        } else {
                            ?>
                            <h6 style="text-transform: none;">You have no saved addresses:</h6>
                        <?php }
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('input[type=radio][name=default-address]').change(function () {
            var idd = $(this).val();
            $.ajax({
                url: '<?= Yii::$app->homeUrl; ?>myaccounts/user/change-status',
                type: "POST",
                data: {id: idd},
                success: function (data) {
                }
            });
        });
        $('.delete-address').on('click', function () {
            if (confirm("Are you sure you want to delete this?"))
            {
                var idd = $(this).attr('data-val');
                $.ajax({
                    url: '<?= Yii::$app->homeUrl; ?>myaccounts/user/remove-address',
                    type: "POST",
                    data: {id: idd},
                    success: function (data) {
                        if (data == 1) {
                            $("#useraddress-" + idd).remove();
                            location.reload();
                        }
                    }
                });
            }
        });
    });
</script>
