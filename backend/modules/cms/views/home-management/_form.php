<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\HomeManagement */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="home-management-form form-inline">

        <?php $form = ActiveForm::begin(); ?>


        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'heading')->textInput(['maxlength' => true]) ?>

        </div>
        <?php
        if ($model->type != 2) {
                if (isset($model->products) && $model->products != '')
                        $model->products = explode(',', $model->products);
                ?>
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'products')->dropDownList(ArrayHelper::map(common\models\Product::find()->all(), 'id', 'product_name'), ['prompt' => 'select Product', 'class' => 'form-control', 'multiple' => 'multiple']) ?>

                </div>
                <?php } else { ?>
                <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'image')->fileInput()->label('Image<i> (1140*520)</i>') ?>
        <?php if (isset($model->image)) { ?>
                                <img src="<?= Yii::$app->homeUrl ?>../uploads/cms/home-management/small.<?= $model->image; ?>?<?= rand() ?>"/>

                                <?php
                        } elseif (!empty($model->img)) {
                                echo "";
                        }
                        ?>
                </div>
<?php } ?>
<!--        <div class='col-md-4 col-sm-6 col-xs-12 left_padd'>    <? $form->field($model, 'sort_order')->textInput() ?>

        </div>-->
        <div class='col-md-4 col-sm-6 col-xs-12' >
                <div class="form-group" >
<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-success', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>
                </div>
        </div>
        <?= $form->field($model, 'type')->hiddenInput()->label(FALSE) ?>

<?php ActiveForm::end(); ?>

</div>

<script>
        $(document).ready(function () {
                $("#homemanagement-products").select2({
                        placeholder: 'Select',
                        allowClear: true
                }).on('select2-open', function ()
                {
                        // Adding Custom Scrollbar
                        $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
                });
        });
</script>