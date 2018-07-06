<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\MasterBank;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\BankAccounts */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
	.another_bank{
		color: #ea1714;
		font-size: 17px;
	}
	label{
		font-weight: 600 !important;
		margin-bottom: 7px;
	}


</style>

<div class="bank-accounts-form">



	<div class="form-group ">
		<label class="control-label">Label 1 font size</label>
		<input type="number" id="label_1_font_size" class="form-control" name="label_1_font_size"  step="1" value="<?= $data['label_1']['font_size'] ?>">
	</div>
	<?= $form->field($model, 'label_1')->textInput(['maxlength' => true, 'id' => 'label_1_text', 'autocomplete' => 'off']) ?>
	<div class="form-group ">
		<label class="control-label">Label 2 font size</label>
		<input type="number" id="label_2_font_size" class="form-control" name="label_2_font_size"  step="1" value="<?= $data['label_1']['font_size'] ?>">
	</div>
	<?= $form->field($model, 'label_2')->textInput(['maxlength' => true, 'id' => 'label_2_text', 'autocomplete' => 'off']) ?>
	<?= $form->field($model, 'label_1_length')->hiddenInput()->label(false); ?>
	<?= $form->field($model, 'label_2_length')->hiddenInput()->label(false); ?>
	<?php
	if (!$model->isNewRecord) {
		?>

		<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>




		<?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>



		<?= $form->field($model, 'bottle_img')->fileInput() ?>



		<?php
	}
	?>










</div>
<script>
	$("#label_1_font_size").bind('keyup mouseup', function () {

		var fontsize = $("#label_1_font_size").val();
		$('#label_1_font_size').val(fontsize);
		$('#label_1').css("font-size", fontsize + 'px');
	});
	$("#label_1_text").keyup(function () {
		$('#bottle-label_1_length').val($('#label_1_text').val().length);
		var label_1 = $('#label_1_text').val();
		$('#label_1').text(label_1);
	});
	$("#label_2_font_size").bind('keyup mouseup', function () {
		var fontsize = $("#label_2_font_size").val();
		$('#label_2_font_size').val(fontsize);
		$('#label_2').css("font-size", fontsize + 'px');
	});
	$("#label_2_text").keyup(function () {
		var label_2 = $('#label_2_text').val();
		$('#bottle-label_2_length').val($('#label_2_text').val().length);
		$('#label_2').text(label_2);
	});
</script>
