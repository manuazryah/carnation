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

$this->title = 'Products';
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



                    <?= Html::a('<i class="fa-th-list"></i><span> Create Product</span>', ['create'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                    <button class="btn btn-white" id="search-option" style="float: right;">
                        <i class="linecons-search"></i>
                        <span>Search</span>
                    </button>
                    <div class="table-responsive" style="border: none">
                        <?=
                        GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'rowOptions' => function ($model, $key, $index, $grid) {
                                return ['id' => $model['id']];
                            },
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                                 [
                                    'class' => 'yii\grid\ActionColumn',
                                    'header' => 'Action',
//          'headerOptions' => ['style' => 'color:#337ab7'],
                                    'template' => '{update}{delete}{preview}',
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
                                        if ($action === 'preview') {
                                            $url = Yii::$app->homeUrl . '../product/product_detail?product=' . $model->canonical_name;
                                            return $url;
                                        }
//
                                        if ($action === 'update') {
                                            $url = 'update?id=' . $model->id;
                                            return $url;
                                        }
                                        if ($action === 'delete') {
                                            $url = 'delete?id=' . $model->id;
                                            return $url;
                                        }
//
                                    }
                                ],
//                                        'id',
//                                'category',
                                [
                                    'attribute' => 'category',
                                   'filter' => ArrayHelper::map(Category::find()->orderBy(['category' => SORT_ASC])->all(), 'id', 'category'),
                                    'value' => function($data) {
                                        return Category::findOne($data->category)->category;
                                    }
                                ],
//                                [
//                                    'attribute' => 'subcategory',
//                                    'filter' => ArrayHelper::map(SubCategory::find()->all(), 'id', 'sub_category'),
//                                    'value' => function($data) {
//                                        return SubCategory::findOne($data->subcategory)->sub_category;
//                                    }
//                                ],
//            'subcategory',
                                'product_name',
//                                'canonical_name',
                                // 'item_ean',
                                // 'brand',
                                // 'gender_type',
                                // 'price',
                                [
                                    'attribute' => 'price',
//'headerOptions' => ['style' => 'width:50% !important'],
                                    'format' => 'raw',
                                    'value' => function ($data) {
                                        return \yii\helpers\Html::textInput('price', $data->price, ['class' => 'form-control product_form', 'id' => 'product_price_' . $data->id]);
                                    },
                                ],
                                [
                                    'attribute' => 'offer_price',
                                    'format' => 'raw',
                                    'value' => function ($data) {
                                        return \yii\helpers\Html::textInput('offer_price', $data->offer_price, ['class' => 'form-control product_form', 'id' => 'product_offerprice_' . $data->id])
                                                .'<label id="offer_price_' . $data->id . '" style="color:#cc3f44"class="hide">Offer price must be less than price</label>';
                                    },
                                ],
                                // 'offer_price',
                                // 'currency',
                                [
                                    'attribute' => 'stock',
                                    'format' => 'raw',
                                    'value' => function ($data) {
                                        return \yii\helpers\Html::textInput('stock', $data->stock, ['class' => 'form-control product_form', 'id' => 'product_stock_' . $data->id]);
                                    },
                                ],
                                // 'stock_unit',
                                [
                                    'attribute' => 'stock_availability',
                                    'format' => 'raw',
                                    'filter' => ['1' => 'Available', '0' => 'Not Available'],
                                    'value' => function ($data) {
                                        return \yii\helpers\Html::dropDownList('stock_availability', null, ['1' => 'Available', '0' => 'Not Available'], ['options' => [$data->stock_availability => ['Selected' => 'selected']], 'class' => 'form-control product_form', 'id' => 'product_stockavailable_' . $data->id,]);
                                    },
                                ],
                                [
                                    'attribute' => 'featured_product',
                                    'format' => 'raw',
                                    'filter' => ['1' => 'Yes', '0' => 'No'],
                                    'value' => function ($data) {
                                        return \yii\helpers\Html::dropDownList('featured_product', null, ['1' => 'Yes', '0' => 'No'], ['options' => [$data->featured_product => ['Selected' => 'selected']], 'class' => 'form-control product_form', 'id' => 'product_featuredproduct_' . $data->id,]);
                                    },
                                ],
                                [
                                    'attribute' => 'sort',
                                    'format' => 'raw',
                                    'value' => function ($data) {
                                        return \yii\helpers\Html::textInput('sort', $data->sort, ['class' => 'form-control product_form', 'id' => 'product_sort_' . $data->id]);
                                    },
                                ],
                                [
                                    'class' => 'yii\grid\ActionColumn',
                                    'header' => 'Action',
//          'headerOptions' => ['style' => 'color:#337ab7'],
                                    'template' => '{update}{delete}{preview}',
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
                                        if ($action === 'preview') {
                                            $url = Yii::$app->homeUrl . '../product/product-detail?product=' . $model->canonical_name;
                                            return $url;
                                        }
//
                                        if ($action === 'update') {
                                            $url = 'update?id=' . $model->id;
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
        $('.product_form').on('change', function () {
            var change = $(this).attr('id');
            var res = change.split("_");
            var price = parseInt($('#product_price_' + res['2']).val());
            var offerprice = $('#product_offerprice_' + res['2']).val();
            if (offerprice) {
                offerprice = parseInt(offerprice);
            }
            var stock = $('#product_stock_' + res['2']).val();
            var availablity = $('#product_stockavailable_' + res['2']).val();
            var featured = $('#product_featuredproduct_' + res['2']).val();
            var sort = $('#product_sort_' + res['2']).val();
            var id = res['2'];
            if (price > '0' && offerprice >= '0') {
                if (price > offerprice) {
                $('#offer_price_' + res['2']).addClass('hide');
            $.ajax({
                url: homeUrl + 'product/product/ajaxchange_product',
                type: "post",
                data: {price: price, offerprice: offerprice, stock: stock, availablity: availablity, id: id, featured: featured, sort: sort},
                success: function (data) {
                    var $data = JSON.parse(data);
                    if ($data.msg === "success") {
                        alert($data.title);
//                    $('#' + form).append($('<option value="' + $data.id + '" >' + $data.tag + '</option>'));
//                    $('#modal-4').modal('toggle');
                    } else {
                        alert($data.title);
                    }
//
                }, error: function () {
//
                }
            });
            } else {
                $('#offer_price_' + res['2']).removeClass('hide');
            }
           }
        });
    });
</script>

<style>
td a{
padding: 4px !important;
}
</style>