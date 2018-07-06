<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'User: ' . $model->first_name . ' ' . $model->last_name;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<style>
	#user-gender label{
		margin-right: 25px;
		padding-top: 6px;
	}
</style>
<div class="row">
	<div class="col-md-12">

		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


			</div>
			<div class="panel-body">
				<?= Html::a('<i class="fa-th-list"></i><span> Manage User</span>', ['index'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
				<?= Html::a('<i class="fa fa-shopping-cart"></i><span> View Cart</span>', ['view-cart', 'id' => $model->id], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
				<?= Html::a('<i class="fa fa-heart"></i><span> View Wishlist</span>', ['view-wishlist', 'id' => $model->id], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
				<?= Html::a('<span> Disable User</span>', ['disable-user', 'id' => $model->id], ['class' => 'btn btn-secondary', 'style' => 'float:right;']) ?>

				<div class="panel-body"><div class="user-create">
						<?=
						$this->render('_form', [
						    'model' => $model,
						])
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
