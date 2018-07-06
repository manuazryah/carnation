<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form form-inline">

	<?php $form = ActiveForm::begin(); ?>
	<div class="rows">
		<div class='col-md-12 col-sm-6 col-xs-12 left_padd'>
			<?= $form->field($model, 'main_category')->dropDownList(['1' => 'Our Products', '2' => 'International Products']) ?>
		</div>
		<div class='col-md-12 col-sm-6 col-xs-12 left_padd'>
			<?= $form->field($model, 'category')->textInput(['maxlength' => true, 'autocomplete' => 'off']) ?>
		</div>
		<div class='col-md-12 col-sm-6 col-xs-12 left_padd'>
			<?= $form->field($model, 'category_code')->textInput(['maxlength' => true, 'readOnly' => true]) ?>
		</div>
		<div class='col-md-12 col-sm-6 col-xs-12 left_padd'>
			<?= $form->field($model, 'meta_title')->textInput(['maxlength' => true]) ?>

		</div>
		<div class='col-md-12 col-sm-6 col-xs-12 left_padd'>
			<?= $form->field($model, 'meta_description')->textInput(['maxlength' => true]) ?>

		</div>
		<div class='col-md-12 col-sm-6 col-xs-12 left_padd'>
			<?= $form->field($model, 'meta_keyword')->textInput(['maxlength' => true]) ?>

		</div>
		<div class='col-md-12 col-sm-6 col-xs-12 left_padd'>
			<?= $form->field($model, 'page_url')->textInput(['maxlength' => true]) ?>

		</div>
		<div class='col-md-12 col-sm-6 col-xs-12 left_padd'>
			<?= $form->field($model, 'status')->dropDownList(['1' => 'Enable', '0' => 'Disable']) ?>
		</div>
	</div>
	<div class='col-md-12 col-sm-6 col-xs-12' style="float:right;">
		<div class="form-group" style="float: right;">
			<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-success', 'style' => 'margin-top: 18px; height: 36px; width:100px;float:right;']) ?>
		</div>
	</div>

	<?php ActiveForm::end(); ?>

</div>

<script>
	$(document).ready(function () {
		$('#category-category').keyup(function () {
			var name = slug($(this).val());
			$('#category-category_code').val(slug($(this).val()));
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
