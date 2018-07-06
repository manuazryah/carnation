<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ContactPageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Contact Pages';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-page-index">

	<div class="row">
		<div class="col-md-12">

			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


				</div>
				<div class="panel-body">


					<?php // echo $this->render('_search', ['model' => $searchModel]); ?>



					<?= Html::a('<i class="fa-th-list"></i><span> Create Contact Page</span>', ['create'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
					<button class="btn btn-white" id="search-option" style="float: right;">
						<i class="linecons-search"></i>
						<span>Search</span>
					</button>
					<div class="table-responsive" style="border: none">
						<?=
						GridView::widget([
						    'dataProvider' => $dataProvider,
						    'filterModel' => $searchModel,
						    'columns' => [
							    ['class' => 'yii\grid\SerialColumn'],
							// 'id',
							//'map',
							'content:ntext',
							'accounts_info:ntext',
							'administration_info:ntext',
							'marketing_info:ntext',
							// 'business_info:ntext',
							// 'marketing_address:ntext',
							// 'date_1:ntext',
							['class' => 'yii\grid\ActionColumn'],
						    ],
						]);
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function () {
		$(".filters").slideToggle();
		$("#search-option").click(function () {
			$(".filters").slideToggle();
		});
	});
</script>

