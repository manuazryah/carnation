<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use common\models\Category;
use common\models\SubCategory;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products - Out of Stock';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

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
                                                            [
                                                            'attribute' => 'category',
                                                            'filter' => ArrayHelper::map(Category::find()->orderBy(['category' => SORT_ASC])->all(), 'id', 'category'),
                                                            'value' => function($data) {
                                                                    return Category::findOne($data->category)->category;
                                                            }
                                                        ],
                                                        'product_name',
                                                            [
                                                            'attribute' => 'stock',
                                                            'format' => 'raw',
                                                            'value' => function ($data) {
                                                                    return $data->stock;
                                                            },
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



