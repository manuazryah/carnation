<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Product;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Wishlist';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                </div>
                <div class="panel-body">
                    <?= Html::a('<i class="fa-th-list"></i><span> Manage User</span>', ['index'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                    <div class="table-responsive" style="border: none">
                        <?=
                        GridView::widget([
                            'dataProvider' => $dataProvider,
                            'rowOptions' => function ($model, $index, $widget, $grid) {
                                $url = 'http://' . Yii::$app->getRequest()->serverName . Yii::$app->homeUrl . 'product/product/update?id=' . $model->product;
                                return ['data-id' => $model->product, 'onclick' => "window.location.href='{$url}'", 'onmouseover' => "this.style.backgroundColor='rgba(167, 167, 167, 0.52)',this.style.cursor='pointer'", 'onmouseout' => "this.style.backgroundColor=''"];
                            },
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                                [
                                    'attribute' => 'product',
                                    'label' => 'Product Image',
                                    'format' => 'raw',
                                    'value' => function ($data) {
                                        if (isset($data->product)) {
                                            $product = common\models\Product::findOne($data->product);
                                            $img = '<img width="" src="' . Yii::$app->homeUrl . '../uploads/product/' . $product->id . '/profile/' . $product->canonical_name . '_thumb.' . $product->profile . '"/>';
                                        } else {
                                            $img = '';
                                        }
                                        return $img;
                                    },
                                ],
                                [
                                    'attribute' => 'product',
                                    'label' => 'Product Name',
                                    'format' => 'raw',
                                    'value' => function ($data) {
                                        if (isset($data->product)) {
                                            return Product::findOne($data->product)->product_name;
                                        } else {
                                            return '';
                                        }
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