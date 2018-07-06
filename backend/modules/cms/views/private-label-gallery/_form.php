<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PrivateLabelGallery */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="private-label-gallery-form form-inline">



	<div class="tab-content">
		<div class="tab-pane active" id="general">
			<?php $form = ActiveForm::begin(); ?>
			<div class='col-md-6 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'index_title')->textInput() ?>

			</div>
			<div class='col-md-6 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'index_content')->textarea(['rows' => 3]) ?>

			</div>
			<div class='col-md-6 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'our_process_title')->textarea(['rows' => 3]) ?>

			</div>
			<div class='col-md-6 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'other_title')->textarea(['rows' => 3]) ?>

			</div>
			<div class='col-md-6 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'about_title')->textInput() ?>

			</div>
			<div class='col-md-6 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'about_content')->textarea(['rows' => 3]) ?>

			</div>

			<div class='col-md-6 col-sm-6 col-xs-12 left_padd'>
				<?= $form->field($model, 'banner_image')->fileInput()->label('Banner Image<i> (1349x346)</i>') ?>
				<?php
				if (!$model->isNewRecord) {
					?>
					<img src="<?= Yii::$app->homeUrl . '../uploads/cms/private-label/banner/small.' . $model->banner_image ?>" >
				<?php } ?>


			</div>
			<!--			<div class='col-md-6 col-sm-6 col-xs-12 left_padd'>
			<?php // $form->field($model, 'image')->fileInput()->label('Image<i> (--x--)</i>') ?>
			<?php
			if (!$model->isNewRecord) {
				?>
												    <img src="<?= Yii::$app->homeUrl . '../uploads/cms/private-label/images/small.' . $model->image ?>" >
			<?php } ?>

						</div>-->
			<div class='col-md-4 col-sm-6 col-xs-12' style="float:right;">
				<div class="form-group" style="float: right;">
					<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-success', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>
				</div>
			</div>
			<?php ActiveForm::end(); ?>
		</div>


	</div>
</div>



</div>
