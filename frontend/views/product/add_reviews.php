<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin(['id' => 'submit-reviews']);
?>
<div class="modal-content">
        <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Add Reviews</h4>
        </div>

        <div class="modal-body">
                <h5 class="review-h5"><?= $product_details->product_name ?></h5>
                <p class=""><?= $product_details->main_description ?></p>

                <?= $form->field($model_review, 'product_id')->hiddenInput(['maxlength' => true, 'value' => $product_id])->label(FALSE) ?>

                <div class="row">
                        <div class="col-md-12">
                                <?= $form->field($model_review, 'tittle')->textInput(['maxlength' => true]) ?>
                        </div>

                </div>

                <div class="row">
                        <div class="col-md-12">
                                <?= $form->field($model_review, 'description')->textarea(['rows' => 5, 'style' => 'height:auto']) ?>
                        </div>

                </div>

        </div>
        <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
</div>
<?php ActiveForm::end(); ?>


<style>
        .review-h5{
                font-size: 14px !important;
                color: #000 !important;
                font-weight: bold !important;
        }
</style>
