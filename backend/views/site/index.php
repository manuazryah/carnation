<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\AdminPost;
use yii\helpers\ArrayHelper;
use common\models\OrderMaster;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AdminUsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>
<style>
    .table>thead:first-child>tr:first-child>th {
        width: 0px;
        white-space: nowrap;
    }
    .purchase-clickable-row:hover{
        cursor: pointer;
    }
    .sales-clickable-row:hover{
        cursor: pointer;
    }
    .row-style{
        margin-left: 0px;
        margin-right: 0px;
    }
</style>
<div class="row">
    <?php
    $order_total = OrderMaster::getOrderTotal();
    $pending_order_total = OrderMaster::getPendingOrderTotal();
    $order_delivered_total = OrderMaster::getDeliveredTotal();
    $canceled_order_total = OrderMaster::getCanceledTotal();
    ?>
    <div class="col-sm-12">
        <div class="col-sm-3">
            <?=
            Html::a(
                    '<div class="xe-widget xe-counter" data-count=".num" data-from="0" data-to="' . $order_total . '" data-suffix="" data-duration="2">
                <div class="xe-icon">
                    <i class="fa fa-shopping-cart" aria-hidden="true" style="background: #03A9F4;"></i>
                </div>
                <div class="xe-label">
                    <strong class="num">99.9%</strong>
                    <span>Total Order</span>
                </div>
            </div>'
                    , ['order/order-master'], ['class' => 'profile-link'])
            ?>
        </div>

        <div class="col-sm-3">
            <?=
            Html::a(
                    '<div class="xe-widget xe-counter xe-counter-info" data-count=".num" data-from="0" data-to="' . $pending_order_total . '" data-duration="" data-easing="true">
                <div class="xe-icon">
                    <i class="fa fa-exclamation-triangle" aria-hidden="true" style="background-color: #FFC107;"></i>
                </div>
                <div class="xe-label">
                    <strong class="num">2,470</strong>
                    <span>Order Pending</span>
                </div>
            </div>'
                    , ['order/order-master', 'order_status' => '0'], ['class' => 'profile-link'])
            ?>
        </div>
        <div class="col-sm-3">
            <?=
            Html::a(
                    '<div class="xe-widget xe-counter xe-counter-purple" data-count=".num" data-from="0" data-to="' . $order_delivered_total . '" data-suffix="" data-duration="" data-easing="false">
                <div class="xe-icon">
                    <i class="fa fa-check" aria-hidden="true" style="background-color: #73b700;"></i>
                </div>
                <div class="xe-label">
                    <strong class="num">117k</strong>
                    <span>Order Delivered</span>
                </div>
            </div>'
                    , ['order/order-master', 'order_status' => '4'], ['class' => 'profile-link'])
            ?>

        </div>
        <div class="col-sm-3">
<?=
            Html::a(
                    '<div class="xe-widget xe-counter xe-counter-info" data-count=".num" data-from="0" data-to="'. $canceled_order_total .'" data-duration="" data-easing="true">
                <div class="xe-icon">
                    <i class="fa fa-times" aria-hidden="true" style="background-color: #F44336;"></i>
                </div>
                <div class="xe-label">
                    <strong class="num">2,470</strong>
                    <span>Order Canceled</span>
                </div>
            </div>'
                    , ['order/order-master', 'order_status' => '5'], ['class' => 'profile-link'])
            ?>
        </div>
        

    </div>
</div>

<div class="row row-style">
    <div class="col-sm-6">

        <div class="panel panel-default" style="height: 480px;">
            <div class="panel-heading">
                Recent Orders
            </div>
            <div class="table-responsive" style="min-height: 340px;">
                <table class="table">
                    <thead>
                        <tr style="text-align: center;">
                            <th width="">Order ID</th>
                            <th width="">User Name</th>
                            <th width="">Order Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($recent_orders)) {
                            foreach ($recent_orders as $recent) {
                                ?>
                                <tr>
                                    <td>
                                        <?php if (isset($recent->order_id)) { ?>
                                            <?= Html::a($recent->order_id, ['/order/order-master/view', 'id' => $recent->order_id], ['class' => '', 'target' => '_blank']) ?>
                                            <?php
                                        } else {
                                            echo '';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php if (isset($recent->user_id)) { ?>
                                            <?= Html::a(\common\models\User::findOne($recent->user_id)->first_name, ['/user/user/update', 'id' => $recent->user_id], ['class' => '', 'target' => '_blank']) ?>
                                            <?php
                                        } else {
                                            echo '';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $status = '';
                                        if ($recent->admin_status == 0) {
                                            $status = 'Pending';
                                        } elseif ($recent->admin_status == 1) {
                                            $status = 'Order Placed';
                                        } elseif ($recent->admin_status == 2) {
                                            $status = 'Order Packed';
                                        } elseif ($recent->admin_status == 3) {
                                            $status = 'Order Dispatched';
                                        } elseif ($recent->admin_status == 4) {
                                            $status = 'Order Delivered';
                                        } elseif ($recent->admin_status == 5) {
                                            $status = 'Cancelled';
                                        }
                                        echo $status;
                                        ?>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div>
                <?= Html::a('<i class="fa-share"></i><span> View More</span>', ['order/order-master/index'], ['class' => 'btn btn-blue btn-icon btn-icon-standalone btn-icon-standalone-right', 'style' => 'margin-top: 8px;float:right;', 'target' => '_blank']) ?>
            </div>
        </div>

    </div>
    <div class="col-sm-6">

        <div class="panel panel-default" style="height: 480px;">
            <div class="panel-heading">
                Out of stock notification
            </div>
            <div  class="table-responsive" style="min-height: 210px;">
                <table class="table">
                    <thead>
                        <tr style="text-align: center;">
                            <th width="">Product Name</th>
                            <th width="">Available Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($products)) {
                            foreach ($products as $value) {
                                ?>
                                <tr>
                                    <td>
                                        <?php if (isset($value->canonical_name)) { ?>
                                            <?= Html::a($value->canonical_name, ['/product/product/update', 'id' => $value->id], ['class' => '', 'target' => '_blank']) ?>
                                            <?php
                                        } else {
                                            echo '';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($value->stock == 0) {
                                            echo 'No stock';
                                        } else {
                                            echo $value->stock;
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div>
                                <?= Html::a('<i class="fa-share"></i><span> View More</span>', ['product/product/stock-notification'], ['class' => 'btn btn-blue btn-icon btn-icon-standalone btn-icon-standalone-right', 'style' => 'margin-top: 8px;float:right;']) ?>
                        </div>
        </div>

    </div>
</div>

<script>
    jQuery(document).ready(function ($) {
        $(".purchase-clickable-row").click(function () {
            var current_row_id = $(this).attr('id').match(/\d+/);
            window.location = '<?= Yii::$app->homeUrl; ?>sales/purchase-invoice-details/view?id=' + current_row_id;
        });

        $(".sales-clickable-row").click(function () {
            var current_row_id = $(this).attr('id').match(/\d+/);
            window.location = '<?= Yii::$app->homeUrl; ?>sales/sales-invoice-details/view?id=' + current_row_id;
        });
    });
</script>

