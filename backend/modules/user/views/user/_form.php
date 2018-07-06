<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form form-inline">

	<?php $form = ActiveForm::begin(); ?>
	<div class="row" style="margin-left: 0px;">
		<div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
			<?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

		</div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
			<?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

		</div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
			<?= $form->field($model, 'country')->dropDownList(['1' => 'UAE']); ?>

		</div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
			<?=
			$form->field($model, 'dob')->widget(\yii\jui\DatePicker::classname(), [
			    //'language' => 'ru',
			    'dateFormat' => 'yyyy-MM-dd',
			    'options' => ['class' => 'form-control', 'placeholder' => 'Date']])->label('Date Of Birth')
			?>

		</div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
			<?= $form->field($model, 'gender')->radioList(array('1' => 'Male', 2 => 'Female')); ?>

		</div><div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
			<?= $form->field($model, 'mobile_no')->textInput(['maxlength' => true]) ?>

		</div>

		<div class='col-md-4 col-sm-6 col-xs-12 left_padd'>
			<?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

		</div>
	</div>
	<div class="row">
		<div class='col-md-4 col-sm-6 col-xs-12' style="float:left;">
			<div class="form-group" style="">
				<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-success', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>
			</div>
		</div>
	</div>
	<?php ActiveForm::end(); ?>

</div>
