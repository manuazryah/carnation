<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model common\models\Showrooms */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="showrooms-form form-inline">

	<?php $form = ActiveForm::begin(); ?>

        <div class='col-md-12 col-sm-12 col-xs-12 left_padd'>    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

	</div>

	<div class='col-md-12 col-sm-12 col-xs-12 left_padd'>
		<?=
		$form->field($model, 'address')->widget(CKEditor::className(), [
		    'options' => ['rows' => 6],
		    'preset' => 'basic'
		])
		?>
	</div>


	<div class='col-md-12 col-sm-12 col-xs-12 left_padd'>
		<?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

	</div><div class='col-md-12 col-sm-12 col-xs-12 left_padd'>    <?= $form->field($model, 'map')->textInput(['maxlength' => true]) ?>

	</div><div class='col-md-12 col-sm-12 col-xs-12 left_padd'>    <?= $form->field($model, 'status')->dropDownList(['1' => 'Enable', '0' => 'Disable']) ?>

	</div>
	<div class='col-md-12 col-sm-12 col-xs-12 left_padd'>
		<?= $form->field($model, 'image')->fileInput()->label('Image<i> (358x260)</i>') ?>
		<?php
		if (!$model->isNewRecord) {
			?>
			<img src="<?= Yii::$app->homeUrl . '../uploads/cms/showrooms/' . $model->id . '/small.' . $model->image ?>" >
		<?php } ?>

	</div>
        <div class='col-md-4 col-sm-6 col-xs-12' style="float:right;">
                <div class="form-group" style="float: right;">
			<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-success', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>
                </div>
        </div>

	<?php ActiveForm::end(); ?>

</div>
