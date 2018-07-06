<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\MasterSearchTag;

/* @var $this yii\web\View */
/* @var $model common\models\MasterSearchtagCategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="master-searchtag-category-form form-inline">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class='col-md-12 col-sm-12 col-xs-12 left_padd'> 
            <?= $form->field($model, 'category')->textInput(['maxlength' => true]) ?>

        </div>
        <div class='col-md-12 col-sm-12 col-xs-12 left_padd'>  
            <?php
            if (!$model->isNewRecord) {
                if (isset($model->search_tags)) {
                    $model->search_tags = explode(',', $model->search_tags);
                }
            }
            ?>
            <?= $form->field($model, 'search_tags')->dropDownList(ArrayHelper::map(MasterSearchTag::find()->where(['status' => '1'])->all(), 'id', 'tag_name'), ['class' => 'form-control', 'id' => 'mastersearchtagcategory-search_tags', 'multiple' => 'multiple']) ?>

        </div>
        <div class='col-md-12 col-sm-12 col-xs-12 left_padd'>  
            <?= $form->field($model, 'status')->dropDownList(['1' => 'Enable', '0' => 'Disable']) ?>

        </div>
    </div>
    <div class="row">
        <div class='col-md-12 col-sm-12 col-xs-12'>
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-success', 'style' => 'float:right;']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
<script type="text/javascript">
    jQuery(document).ready(function ($)
    {
        $("#mastersearchtagcategory-search_tags").select2({
            placeholder: 'Choose search Tag',
            allowClear: true
        }).on('select2-open', function ()
        {
            // Adding Custom Scrollbar
            $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
        });
    });
</script>