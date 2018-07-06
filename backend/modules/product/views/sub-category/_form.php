<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Category;

/* @var $this yii\web\View */
/* @var $model common\models\SubCategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sub-category-form form-inline form-tab">

    <?php $form = ActiveForm::begin(); ?>
    <div class='col-md-12 col-sm-6 col-xs-12 left_padd'>
        <?= $form->field($model, 'main_category')->dropDownList(['1' => 'Our Products', '2' => 'International Products'], ['id' => 'product-main_category']) ?>
    </div>
    <div class='col-md-12  left_padd'>
        <?php
        if (!$model->isNewRecord) {
            $cat = Category::find()->where(['main_category' => $model->main_category, 'status' => '1'])->all();
            echo $form->field($model, 'category')->dropDownList(ArrayHelper::map($cat, 'id', 'category'), ['prompt' => 'select', 'id' => 'product-category']);
        } else {
            ?>
            <?=
            $form->field($model, 'category')->dropDownList(ArrayHelper::map(Category::find()->where(['main_category' => '1'])->all(), 'id', 'category'), ['prompt' => 'select', 'id' => 'product-category']);
        }
        ?>
        <label onclick="jQuery('#modal-1').modal('show', {backdrop: 'fade'});" class="btn  add_category" style="float: right">Add Category</label>
    </div>
    <!--<a href="javascript:;" onclick="jQuery('#modal-1').modal('show', {backdrop: 'fade'});" class="btn btn-primary btn-single btn-sm">Show Me</a>-->

    <div class='col-md-12 col-sm-6 col-xs-12 left_padd'>    
        <?= $form->field($model, 'sub_category')->textInput(['maxlength' => true]) ?>
    </div>
    <div class='col-md-12 col-sm-6 col-xs-12 left_padd'> 
        <?= $form->field($model, 'status')->dropDownList(['1' => 'Enable', '0' => 'Disable']) ?>
    </div>
    <div class='col-md-12 col-sm-6 col-xs-12' style="float:right;">
        <div class="form-group" style="float: right;">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-success', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<div class="modal fade" id="modal-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" field_id="product-category">Add Category</h4>
            </div>

            <div class="modal-body">
                <?php $form = ActiveForm::begin(['id' => 'add_category']); ?>
                <div class="rows">
                    <div class='col-md-12 col-sm-6 col-xs-12 left_padd'>    
                        <?= $form->field($model, 'category')->textInput(['maxlength' => true, 'value' => '']) ?>
                        <label class="control-label" for="subcategory-category">Category code</label>
                        <input type="text" id="subcategory-categorycode" readonly="readonly" class="form-control" >
                    </div>
                </div>
                <div class='col-md-12 col-sm-6 col-xs-12' style="float:right;">
                    <div class="form-group" style="float: right;">
                        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-success', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>
                    </div>
                </div>

                <?php ActiveForm::end(); ?>
            </div>

            <div class="modal-footer">
                <!--                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-info">Save changes</button>-->
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#subcategory-category').keyup(function () {
            var name = slug($(this).val());
            $('#subcategory-categorycode').val(slug($(this).val()));
        });
    });
    var slug = function (str) {
        var $slug = '';
        var trimmed = $.trim(str);
        $slug = trimmed.replace(/[^a-z0-9-]/gi, '-').
                replace(/-+/g, '-').
                replace(/^-|-$/g, '');
        return $slug.toLowerCase();
    }
</script>