<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\MasterSearchtagCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Master Searchtag Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="master-searchtag-category-index">
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
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            'id',
                            'category',
//                            'search_tags',
                            [
                                'attribute' => 'status',
                                'filter' => ['1' => 'Enable', '0' => 'Disable'],
                                'value' => function($data) {
                                    return $data->status == 1 ? 'Enable' : 'Disable';
                                }
                            ],
                            // 'DOC',
                            // 'DOU',
                            // 'status',
                            [
                                    'class' => 'yii\grid\ActionColumn',
                                    'header' => 'Action',
//          'headerOptions' => ['style' => 'color:#337ab7'],
                                    'template' => '{update}{delete}',
                                    'buttons' => [
                                        'preview' => function ($url, $model) {
                                            return Html::a('<span class="fa fa-share"></span>', $url, [
                                                        'title' => Yii::t('app', 'Preview'),
                                                        'target' => '_blank',
                                            ]);
                                        },
//
                                    ],
                                    'urlCreator' => function ($action, $model, $key, $index) {
                                        
                                        if ($action === 'update') {
                                            $url = Url::to(['index', 'id' => $model->id]);
                                            return $url;
                                        }
                                        if ($action === 'delete') {
                                            $url = 'delete?id=' . $model->id;
                                            return $url;
                                        }
//
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

