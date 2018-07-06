<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\HomeManagementSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Home Managements';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="home-management-index">

        <div class="row">
                <div class="col-md-12">

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                                </div>
                                <div class="panel-body">


                                        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>



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
                                                        'heading',
//                                                        'products',
                                                        ['attribute' => 'products',
                                                            'value' => function($model) {
                                                                    return $model->Products($model->products);
                                                            }
                                                        ],
                                                            [
                                                            'attribute' => 'image',
                                                            'format' => 'raw',
                                                            'value' => function ($data) {
                                                                    if (isset($data->image)) {
                                                                            $img = '<img width="120px" src="' . Yii::$app->homeUrl . '../uploads/cms/home-management/small.' . $data->image . '?' . rand() . '"/>';
                                                                    } else {
                                                                            $img = '';
                                                                    }
                                                                    return $img;
                                                            },
                                                        ],
                                                        // 'sort_order',
                                                        ['class' => 'yii\grid\ActionColumn',
                                                            'template' => '{update}'],
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

