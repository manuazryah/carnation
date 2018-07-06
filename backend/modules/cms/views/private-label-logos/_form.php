<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PrivateLabelLogos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="private-label-logos-form form-inline">

	<?php $form = ActiveForm::begin(); ?>

        <div class='col-md-12 col-sm-12 col-xs-12 left_padd'>    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

	</div><div class='col-md-12 col-sm-12 col-xs-12 left_padd'>
		<?= $form->field($model, 'status')->dropDownList(['1' => 'Enable', '0' => 'Disable']) ?>

	</div>
	<div class='col-md-12 col-sm-12 col-xs-12 left_padd'>
		<?= $form->field($model, 'image')->fileInput()->label('Image<i> (190x125)</i>') ?>
		<?php
		if (!$model->isNewRecord) {
			?>
			<img src="<?= Yii::$app->homeUrl . '../uploads/cms/logos/' . $model->id . '/small.' . $model->image ?>" >
		<?php } ?>

	</div>
        <div class='col-md-4 col-sm-6 col-xs-12' style="float:right;">
                <div class="form-group" style="float: right;">
			<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-success', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>
                </div>
        </div>

	<?php ActiveForm::end(); ?>

</div>
