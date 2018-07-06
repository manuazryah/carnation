<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CmsOthersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Others';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cms-others-index">

	<div class="row">
		<div class="col-md-12">

			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


				</div>
				<div class="panel-body">


					<?php // echo $this->render('_search', ['model' => $searchModel]); ?>



					<div class="table-responsive" style="border: none">
						<button class="btn btn-white" id="search-option" style="float: right;">
							<i class="linecons-search"></i>
							<span>Search</span>
						</button>
						<?=
						GridView::widget([
						    'dataProvider' => $dataProvider,
						    'filterModel' => $searchModel,
						    'columns' => [
							    ['class' => 'yii\grid\SerialColumn'],
							//'id',
							'title',
							'content:ntext',
							    [
							    'attribute' => 'status',
							    'filter' => ['1' => 'Enable', '0' => 'Disable'],
							    'value' => function($data) {
								    return $data->status == 1 ? 'Enable' : 'Disable';
							    }
							],
							//'CB',
							// 'UB',
							// 'DOC',
							// 'DOU',
							[
							    'class' => 'yii\grid\ActionColumn',
//                                    'contentOptions' => ['style' => 'width:100px;'],
							    'header' => 'Actions',
							    'template' => '{update}',
							    'buttons' => [
								'update' => function ($url, $model) {
									return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
										    'title' => Yii::t('app', 'update'),
										    'class' => '',
									]);
								},
							    ],
							    'urlCreator' => function ($action, $model) {
								    if ($action === 'update') {
									    $url = Url::to(['update', 'id' => $model->id]);
									    return $url;
								    }
							    }
							],
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

