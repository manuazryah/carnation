<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\export\ExportMenu;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\SubscribeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Subscribes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subscribe-index">

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

                                                <?= Html::a('<i class="fa fa-eye"></i><span> Bulk View</span>', ['view'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone', 'style' => 'float:right']) ?>

                                                 <?php
                        $gridColumns = [
//                            ['class' => 'yii\grid\SerialColumn'],
                            'email:email',
                            'date',
//                                [
//                                    'attribute' => 'status',
//                                    'filter' => ['1' => 'Enable', '0' => 'Disable'],
//                                    'value' => function($data) {
//                                        return $data->status == 1 ? 'Enable' : 'Disable';
//                                    }
//                                ],
                                ['class' => 'yii\grid\ActionColumn',
                                    'template' => '{delete}',
                                ],
                        ];
                        ?>
                          <?php
                        echo ExportMenu::widget([
                            'dataProvider' => $dataProvider,
                            'columns' => $gridColumns
                        ]);

                        // You can choose to render your own GridView separately
                        echo \kartik\grid\GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'columns' => $gridColumns,
                            'rowOptions' => function($model) {
                                if ($model->status == 0) {
                                    return ['class' => 'non-active-users'];
                                }
                            },
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

