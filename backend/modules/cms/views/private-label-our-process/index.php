<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PrivateLabelHowItWorksSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Update Private Label Page';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="private-label-how-it-works-index">

	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


				</div>

				<div class="panel-body">
					<?=
					$this->render('sub_menu', [
					])
					?>
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
					    'columns' => [
						    ['class' => 'yii\grid\SerialColumn'],
						//'id',
						'step',
						    [
						    'attribute' => 'content',
						    'value' => function($data) {
							    $str = substr($data->content, 0, strpos(wordwrap($data->content, 75), "\n"));
							    if (strlen($data->content) > 75) {
								    $dot = ' ....';
							    } else {
								    $dot = '';
							    }
							    return $str . $dot;
						    },
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
								    $url = Url::to(['index', 'id' => $model->id]);
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

