<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use common\models\Gender;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\DemoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bottles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="demo-index">

	<div class="row">
		<div class="col-md-12">
			<div class="page-title">

				<div class="title-env">
					<h1 class="title"><?= Html::encode($this->title) ?></h1>
				</div>
			</div>

		</div>
	</div>
	<div class="row">
		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-body"><div class="demo-create">

						<?=
						$this->render('_form', [
						    'model' => $model,
						])
						?>
					</div>
				</div>
			</div>

		</div>
		<div class="col-md-8">
			<div class="panel panel-default">
				<div class="panel-body table-responsive">
					<button class="btn btn-white" id="search-option" style="float: right;">
						<i class="linecons-search"></i>
						<span>Search</span>
					</button>

					<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

					<?=
					GridView::widget([
					    'dataProvider' => $dataProvider,
					    'filterModel' => $searchModel,
					    'pager' => [
						'firstPageLabel' => 'first',
						'lastPageLabel' => 'last',
						'prevPageLabel' => '<',
						'nextPageLabel' => '>',
						'maxButtonCount' => 3,
					    ],
					    'columns' => [
						    ['class' => 'yii\grid\SerialColumn'],
//                            'id',
						'name',
//                            'text_length',
						'price',
						    [
						    'attribute' => 'bottle_img',
						    'format' => 'raw',
						    'value' => function ($data) {
							    if (isset($data->bottle_img)) {
								    $img = '<img width="120px" src="' . Yii::$app->homeUrl . '../uploads/create_your_own/bottle/' . $data->id . '/small.' . $data->bottle_img . '?' . rand() . '"/>';
							    } else {
								    $img = '';
							    }
							    return $img;
						    },
						],
//                            'CB',
//                            'UB',
//                            'DOC',
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
								    $url = Url::to(['test', 'id' => $model->id]);
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
<script>
	$(document).ready(function () {
		$(".filters").slideToggle();
		$("#search-option").click(function () {
			$(".filters").slideToggle();
		});
	});
</script>


