<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use common\models\User;
use kartik\daterange\DateRangePicker;
use kartik\datetime\DateTimePicker;
use common\models\OrderMaster;

/* @var $this yii\web\View */
/* @var $searchModel common\models\OrderMasterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Order Masters';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
        .tab-content{
                background: #f9f9f9 !important;
        }
        .nav.nav-tabs>li>a {
                background-color: #f9f9f9;
        }
        .nav.nav-tabs>li {
                background: #f9f9f9;
        }
        .nav.nav-tabs>li.active>a {
                background-color: #f9f9f9 !important;
        }
        .nav.nav-tabs.nav-tabs-justified, .nav-tabs-justified .nav.nav-tabs {
                background: #f9f9f9;
        }
        .nav.nav-tabs>li>a:hover {
                background-color: #f9f9f9;
        }
        .nav-tabs {
                border-bottom: 1px solid #f9f9f9 !important;
        }
        .hidden-xs{
                padding-left: 5px;
        }
        .admin_status_field{
                padding: 0px 0px !important;
        }
</style>
<div class="order-master-index">

        <div class="row">
                <div class="col-md-12">

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                                </div>
                                <div class="panel-body">

                                        <ul class="nav nav-tabs">
                                                <li class="<?= $order_status == '' ? 'active' : '' ?>">
                                                        <?= Html::a('<span class="visible-xs"><i class="fa-home"></i></span><i class="fa fa-th-list" aria-hidden="true"></i><span class="hidden-xs">All Orders</span>', ['index'], ['class' => '']) ?>
                                                </li>
                                                <li class="<?= $order_status == '0' ? 'active' : '' ?>">
                                                        <?= Html::a('<span class="visible-xs"><i class="fa-home"></i></span><i class="fa fa-th-list" aria-hidden="true"></i><span class="hidden-xs">Pending</span>', ['index', 'order_status' => 0], ['class' => '']) ?>
                                                </li>
                                                <li class="<?= $order_status == '4' ? 'active' : '' ?>">
                                                        <?= Html::a('<span class="visible-xs"><i class="fa-home"></i></span><i class="fa fa-th-list" aria-hidden="true"></i><span class="hidden-xs">Delivered</span>', ['index', 'order_status' => 4], ['class' => '']) ?>
                                                </li>
                                                <li class="<?= $order_status == '5' ? 'active' : '' ?>">
                                                        <?= Html::a('<span class="visible-xs"><i class="fa-home"></i></span><i class="fa fa-th-list" aria-hidden="true"></i><span class="hidden-xs">Cancelled</span>', ['index', 'order_status' => 5], ['class' => '']) ?>
                                                </li>

                                        </ul>


                                        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>



                                        <?php // ech  Html::a('<i class="fa-th-list"></i><span> Create Order Master</span>', ['create'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                                        <div class="table-responsive" style="border: none">
                                                <button class="btn btn-white" id="search-option" style="float: right;">
                                                        <i class="linecons-search"></i>
                                                        <span>Search</span>
                                                </button>
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
                                                            'attribute' => 'order_id',
                                                            'format' => 'raw',
                                                            'value' => function ($data) {
                                                                    if (isset($data->order_id)) {
                                                                            return \yii\helpers\Html::a($data->order_id, ['/order/order-master/view', 'id' => $data->order_id], ['target' => '_blank']);
                                                                    } else {
                                                                            return '';
                                                                    }
                                                            },
                                                        ],
                                                            [
                                                            'attribute' => 'user_id',
                                                            'format' => 'raw',
                                                            'filter' => ArrayHelper::map(User::find()->all(), 'id', 'first_name'),
                                                            'value' => function ($data) {
                                                                    $name = User::findOne($data->user_id);
                                                                    return \yii\helpers\Html::a($name->first_name . ' ' . $name->last_name, ['/user/user/update', 'id' => $data->user_id], ['target' => '_blank']);
                                                            },
                                                        ],
                                                        'net_amount',
                                                            [
                                                            // the attribute
                                                            'attribute' => 'order_date',
                                                            // format the value
                                                            'value' => function ($data) {
                                                                    return date("Y-m-d", strtotime($data->order_date));
                                                            },
                                                            // some styling?
                                                            'headerOptions' => [
                                                                'class' => 'col-md-2'
                                                            ],
                                                            // here we render the widget
                                                            'filter' => DateRangePicker::widget([
                                                                'model' => $searchModel,
                                                                'attribute' => 'created_at_range',
//                                        'startAttribute' => 'date_start',
//                                        'endAttribute' => 'date_end',
                                                                'convertFormat' => true,
                                                                'pluginOptions' => [
                                                                    'locale' => ['format' => 'Y-m-d'],
//                                            'format' => 'Y-m-d',
//                                            'autoUpdateInput' => false
                                                                ],
                                                            ])
                                                        ],
                                                        // 'ship_address_id',
                                                        // 'bill_address_id',
                                                        // 'currency_id',
                                                        // 'user_comment:ntext',
                                                        // 'payment_mode',
                                                        // 'admin_comment',
                                                        [
                                                            'attribute' => 'payment_status',
                                                            'format' => 'raw',
                                                            'filter' => ['0' => 'Pending', '1' => 'Success', '2' => 'Failed', '3' => 'COD'],
                                                            'value' => function ($data) {
                                                                    if (isset($data->payment_status)) {
                                                                            if ($data->payment_status == '0')
                                                                                    $status = 'Pending';
                                                                            if ($data->payment_status == '1')
                                                                                    $status = 'Success';
                                                                            if ($data->payment_status == '2')
                                                                                    $status = 'Failed';
                                                                            if ($data->payment_status == '3')
                                                                                    $status = 'COD';
//                                            return $data->payment_status;
                                                                            return $status;
                                                                    } else {
                                                                            return '';
                                                                    }
                                                            },
                                                        ],
                                                            [
                                                            'attribute' => 'admin_status',
                                                            'format' => 'raw',
                                                            'filter' => ['0' => 'Pending', '1' => 'Order Placed', '2' => 'Order Packed', '3' => 'Order Dispatched', '4' => 'Order Delivered', '5' => 'Cancelled'],
                                                            'value' => function ($data) {
                                                                    return \yii\helpers\Html::dropDownList('admin_status', null, ['0' => 'Pending', '1' => 'Order Placed', '2' => 'Order Packed', '3' => 'Order Dispatched', '4' => 'Order Delivered', '5' => 'Cancelled'], ['options' => [$data->admin_status => ['Selected' => 'selected']], 'class' => 'form-control admin_status_field admin_status', 'id_' => $data->order_id, 'id' => 'status_' . $data->order_id,]);
                                                            },
                                                        ],
                                                        // 'doc',
                                                        // 'shipping_method',
                                                        //    [
                                                        //       'attribute' => 'status',
                                                        //       'filter' => ['4' => 'Success', '1,2,3' => 'Failed'],
                                                        //        'value' => function($data) {
                                                        //           return $data->status == 4 ? 'Success' : 'Failed';
                                                        //      }
                                                        //  ],
                                                        [
                                                            'attribute' => 'expected_delivery_date',
                                                            'format' => 'raw',
                                                            'value' => function ($data) {
                                                                    $order_masters = OrderMaster::find()->where(['order_id' => $data->order_id])->one();
                                                                    return \yii\jui\DatePicker::widget([
                                                                                'dateFormat' => 'dd-MM-yyyy',
                                                                                'id' => $data->order_id,
                                                                                'options' => ['id_' => $data->order_id, 'class' => 'admin_status delivered_date_' . $data->order_id],
                                                                                'value' => $data->expected_delivery_date,
                                                                    ]);
                                                            },
                                                        ],
                                                            [
                                                            'class' => 'yii\grid\ActionColumn',
//                                    'contentOptions' => ['style' => 'width:100px;'],
                                                            'header' => 'Actions',
                                                            'template' => '{view}{print}',
                                                            'buttons' => [
                                                                'view' => function ($url, $model) {
                                                                        return Html::a('<span><i class="fa fa-eye" aria-hidden="true"></i></span>', $url, [
                                                                                    'title' => Yii::t('app', 'view'),
                                                                                    'class' => '',
                                                                        ]);
                                                                },
                                                                'print' => function ($url, $model) {
                                                                        if ($model->status == 4) {
                                                                                return Html::a('<span><i class="fa fa-print" aria-hidden="true"></i></span>', $url, [
                                                                                            'title' => Yii::t('app', 'print'),
                                                                                            'class' => '',
                                                                                            'target' => '_blank',
                                                                                ]);
                                                                        }
                                                                },
                                                            ],
                                                            'urlCreator' => function ($action, $model) {
                                                                    if ($action === 'view') {
                                                                            $url = Url::to(['view', 'id' => $model->order_id]);
                                                                            return $url;
                                                                    }
                                                                    if ($action === 'print') {
                                                                            $url = Url::to(['print', 'id' => $model->order_id]);
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
                $('.admin_status').on('change', function () {
                        var change_id = $(this).attr('id_');
                        var admin_status = $('#status_' + change_id).val();
                        var delivered_date = $('.delivered_date_' + change_id).val();
                        if (delivered_date === "" && admin_status !== '5') {
                                alert('Set Expected Delivery date');
                        } else {
                                $.ajax({
                                        url: homeUrl + 'order/order-master/change-admin-status',
                                        type: "post",
                                        data: {status: admin_status, id: change_id, date: delivered_date},
                                        success: function (data) {
                                                alert('Admin Status Changed Sucessfully');
                                        }, error: function () {
                                        }
                                });
                        }
                });
        });
</script>

