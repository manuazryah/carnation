<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AboutSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Abouts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="about-index">

	<div class="row">
		<div class="col-md-12">

			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


				</div>
				<div class="panel-body">


					<?php // echo $this->render('_search', ['model' => $searchModel]); ?>



					<?= Html::a('<i class="fa-th-list"></i><span> Create About</span>', ['create'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
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
							//  'id',
							'index_title',
							//'index_content:ntext',
							'about_title',
							//'about_content:ntext',
							// 'chairman_image',
							// 'chairman_name',
							// 'chairman_position',
							// 'chairman_message:ntext',
							'about_image',
							// 'CB',
							// 'UB',
							// 'DOC',
							// 'DOU',
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

