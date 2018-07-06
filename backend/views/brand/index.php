<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\BrandSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Brands';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="brand-index">

        <div class="row">
                <div class="col-md-12">

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                                </div>
                                <div class="panel-body">


                                        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>



                                        <?= Html::a('<i class="fa-th-list"></i><span> Create Brand</span>', ['create'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
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
//                                'id',
                                                        [
                                                            'attribute' => 'image',
                                                            'format' => 'raw',
                                                            'value' => function ($data) {
                                                                    if (isset($data->image)) {
                                                                            $img = '<img width="120px" src="' . Yii::$app->homeUrl . '../uploads/cms/brands/' . $data->id . '/small.' . $data->image . '?' . rand() . '"/>';
                                                                    } else {
                                                                            $img = '';
                                                                    }
                                                                    return $img;
                                                            },
                                                        ],
                                                        'brand',
//                                'CB',
//                                'UB',
//                                'DOC',
                                                        [
                                                            'attribute' => 'status',
                                                            'filter' => ['1' => 'Enable', '0' => 'Disable'],
                                                            'value' => function($data) {
                                                                    return $data->status == 1 ? 'Enable' : 'Disable';
                                                            }
                                                        ],
                                                        // 'DOU',
                                                        // 'status',
                                                        ['class' => 'yii\grid\ActionColumn',
                                                            'template' => '{update}{delete}'],
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

