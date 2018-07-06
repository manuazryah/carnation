<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model common\models\Principals */

$this->title = 'Update Terms & Conditions';
$this->params['breadcrumbs'][] = ['label' => 'Principals', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="row">
	<div class="col-md-12">

		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


			</div>
			<div class="panel-body">
				<div class="panel-body"><div class="principals-create">
						<div class="principals-form form-inline">

							<?php $form = ActiveForm::begin(); ?>

							<div class='col-md-12 col-sm-12 col-xs-12 left_padd'>
								<?=
								$form->field($model, 'terms_conditions', ['options' => ['class' => 'form-group']])->widget(CKEditor::className(), [
								    'options' => ['rows' => 2],
								    'preset' => 'custom', 'clientOptions' => ['height' => 'auto']
								])
								?>

							</div>
							<div class='col-md-12 col-sm-12 col-xs-12'>
								<div class="form-group">
									<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-success', 'style' => 'margin-top: 18px; height: 36px; width:100px;float:right;']) ?>
								</div>
							</div>

							<?php ActiveForm::end(); ?>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
