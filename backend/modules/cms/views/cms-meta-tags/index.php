<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CmsMetaTagsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Meta Tags';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cms-meta-tags-index">

	<div class="row">
		<div class="col-md-12">

			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


				</div>
				<div class="panel-body">


					<?php // echo $this->render('_search', ['model' => $searchModel]); ?>



					<?php // Html::a('<i class="fa-th-list"></i><span> Create Cms Meta Tags</span>', ['create'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
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
							'page_title',
//							'meta_title',
							[
							    'attribute' => 'meta_title',
							    'value' => function($data) {
								    if (strlen($data->meta_title) > 20) {
									    $result = substr($data->meta_title, 0, 20) . '.....';
								    } else {
									    $result = $data->meta_title;
								    }
								    return $result;
							    }
							],
							    [
							    'attribute' => 'meta_description',
							    'value' => function($data) {
								    if (strlen($data->meta_description) > 30) {
									    $result = substr($data->meta_description, 0, 30) . '.....';
								    } else {
									    $result = $data->meta_description;
								    }
								    return $result;
							    }
							],
							    [
							    'attribute' => 'meta_keyword',
							    'value' => function($data) {
								    if (strlen($data->meta_keyword) > 25) {
									    $result = substr($data->meta_keyword, 0, 25) . '.....';
								    } else {
									    $result = $data->meta_keyword;
								    }
								    return $result;
							    }
							],
//							'meta_description:ntext',
//							'meta_keyword:ntext',
							//'CB',
							// 'UB',
							// 'DOC',
							// 'DOU',
							// 'page_title',
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

