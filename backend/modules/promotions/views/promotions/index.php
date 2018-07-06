<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PromotionsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Promotions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="promotions-index">

        <div class="row">
                <div class="col-md-12">

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                                </div>
                                <div class="panel-body">


                                        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>



                                        <?= Html::a('<i class="fa-th-list"></i><span> Create Promotions</span>', ['create'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
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
                                                            [
                                                            'attribute' => 'promotion_type',
                                                            'value' => function($model) {
                                                                    if ($model->promotion_type == '1') {
                                                                            return 'Unique Product Code';
                                                                    } else if ($model->promotion_type == '2') {
                                                                            return 'User Specified Code';
                                                                    } else if ($model->promotion_type == '3') {
                                                                            return 'Common Code';
                                                                    } else if ($model->promotion_type == '4') {
                                                                            return 'Brand Code';
                                                                    }
                                                            },
                                                            'filter' => [1 => 'Unique Product Code', 2 => 'User Specified Code', 3 => 'Common Code', 4 => 'Brand Code'],
                                                        ],
                                                        'promotion_code',
                                                            [
                                                            'class' => 'yii\grid\ActionColumn',
                                                            'template' => '{update}{delete}'
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

