<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\DemoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Shop By Category';
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


                                        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                                        <?=
                                        GridView::widget([
                                            'dataProvider' => $dataProvider,
                                            'filterModel' => $searchModel,
                                            'columns' => [
                                                    ['class' => 'yii\grid\SerialColumn'],
                                                    [
                                                    'attribute' => 'image',
                                                    'format' => 'raw',
                                                    'value' => function ($data) {
                                                            if (!empty($data->image))
                                                                    $img = '<img src="' . Yii::$app->homeUrl . '../uploads/cms/shop-by-category/' . $data->id . '/small.' . $data->image . '"/>';
                                                            return $img;
                                                    },
                                                    'filter' => '',
                                                ],
                                                'title',
                                                    [
                                                    'attribute' => 'link',
                                                //   'filter' => ['0' => 'Men', '1' => 'Women', '2' => 'All'],
//                                                    'value' => function($data) {
//
//                                                            if ($data->link == 0) {
//                                                                    return 'Men';
//                                                            } else if ($data->link == 1) {
//                                                                    return 'Women';
//                                                            } else if ($data->link == 2) {
//                                                                    return 'All';
//                                                            }
//                                                    }
                                                ],
//
                                                [
                                                    'class' => 'yii\grid\ActionColumn',
                                                    'header' => 'Actions',
                                                    'template' => '{update}',
                                                    'buttons' => [
                                                        'update' => function ($url, $model) {
                                                                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                                                                            'title' => Yii::t('app', 'update'),
                                                                            'class' => '',
                                                                ]);
                                                        },
                                                        'delete' => function ($url, $model) {
                                                                return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                                                            'title' => Yii::t('app', 'delete'),
                                                                            'class' => '',
                                                                            'data' => [
                                                                                'confirm' => 'Are you sure you want to delete this item?',
                                                                            ],
                                                                ]);
                                                        },
                                                    ],
                                                    'urlCreator' => function ($action, $model) {
                                                            if ($action === 'update') {
                                                                    $url = Url::to(['index', 'id' => $model->id]);
                                                                    return $url;
                                                            }
                                                            if ($action === 'delete') {
                                                                    $url = Url::to(['del', 'id' => $model->id]);
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




























