<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use common\models\User;
use common\models\Product;
use yii\helpers\Url;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $searchModel common\models\OrderMasterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Order Details';
$this->params['breadcrumbs'][] = $this->title;

if (isset($orderid))
	$order_master = common\models\OrderMaster::find()->where(['order_id' => $orderid])->one();
?>
<style>
        .summary{
                display: none;
        }
	.print_button{
		float: right;
	}
	.print_button i{
		font-size: 20px;
		color: #1355ce;
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


					<?php // echo $this->render('_search', ['model' => $searchModel]);  ?>



					<?= Html::a('<i class="fa-th-list"></i><span> Manage Order </span>', ['index'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
					<?= Html::a('<i class="fa fa-print"></i>', ['print', 'id' => $order_master->order_id], ['class' => 'print_button', 'target' => '_blank']) ?>
                                        <div class="table-responsive" style="border: none">
                                                <!--                                                <button class="btn btn-white" id="search-option" style="float: right;">
                                                                                                        <i class="linecons-search"></i>
                                                                                                        <span>Search</span>
                                                                                                </button>-->
						<?php
						if (!empty($order_master)) {
							$bill_address = \common\models\UserAddress::findOne($order_master->bill_address_id);
							$customer = User::findOne($order_master->user_id);
							?>
							<div class="row" style="margin-top:10px">

								<!--								<div class="col-md-3 col-lg-3 bill-address-div order-div">
																	<div class="div-pdng">
																		<b class="bill-address">Order Details</b>
																			<p class="first-p"> Order No: 82364</p>
																		<p>Customer : Testing tset</p>
																		<p>Net amount : 191,00</p>
																		<table class="table" style="margin-top:5px;color: #000000bd;">
																			<tr>
																				<td>Order No</td>
																				<td> : </td>
																				<td><?= $order_master->order_id ?></td>
																			</tr>

																			<tr>
																				<td>Customer</td>
																				<td> : </td>
																				<td><?= $customer->first_name . ' ' . $customer->last_name ?></td>
																			</tr>

																			<tr>
																				<td>Net Amount</td>
																				<td> : </td>
																				<td><?= $order_master->net_amount ?></td>
																			</tr>
																		</table>
																	</div>
																</div>-->


								<div class="col-md-12 col-lg-12 bill-address-div order-div" >
									<div class="col-md-6">
										<div class="div-pdng" >
											<b class="bill-address">Billing Address</b>
											<p class="first-p" style="color:#000000bd;"><?= $bill_address->name ?></p>
											<p style="color:#000000bd;"><?= $bill_address->address ?></p>
											<p style="color:#000000bd;"><?= $bill_address->location ?></p>
											<p style="color:#000000bd;"><?= $bill_address->landmark ?></p>
											<p style="color:#000000bd;">Tel : <?= $bill_address->mobile_number ?></p>
                                                                                        <p style="color:#000000bd;"><?= $order_master->other_details ?></p>
										</div>
									</div>
									<div class="col-md-6">
										<?php
										$ship_address = \common\models\UserAddress::findOne($order_master->ship_address_id);
										if (!empty($ship_address)) {
											?>
											<div class="div-pdng" >

												<b class="bill-address">Shipping Address</b>
												<p class="first-p" style="color:#000000bd;"><?= $ship_address->name ?></p>
												<p  style="color:#000000bd;"><?= $ship_address->address ?></p>
												<p style="color:#000000bd;"><?= $ship_address->location ?></p>
												<p style="color:#000000bd;"><?= $ship_address->landmark ?></p>
												<p style="color:#000000bd;">Tel : <?= $ship_address->mobile_number ?></p>

											</div>
										<?php } ?>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-lg-6 bill-address-div " style="color:#000000bd">
									<div class="div-pdng order-div">
										<b class="bill-address">Bill Details</b>
										<table class="table" style="margin-top:5px;color: #000000bd;">
                                                                                        <tr>
                                                                                                <td>Order No</td>
                                                                                                <td> : </td>
                                                                                                <td><b><?= $order_master->order_id ?></b></td>

                                                                                                <td>Order Date</td>
                                                                                                <td> : </td>
                                                                                                <td><b><?= date('d-m-Y', strtotime($order_master->order_date)) ?></b></td>
                                                                                        </tr>

                                                                                        <tr>
                                                                                                <td>Customer</td>
                                                                                                <td> : </td>
                                                                                                <td><b><?= $customer->first_name . ' ' . $customer->last_name ?></b></td>

                                                                                                <td>Total</td>
                                                                                                <td> : </td>
                                                                                                <?php
                                                                                                $total = $order_master->total_amount - $order_master->tax_amount;
                                                                                                ?>
                                                                                                <td><b><?= $total ?></b></td>
                                                                                        </tr>


                                                                                        <tr>
                                                                                                <td>Tax Amount</td>
                                                                                                <td> : </td>
                                                                                                <?php
                                                                                                if (!empty($order_master->tax_amount)) {
                                                                                                        ?>
                                                                                                        <td><b><?= $order_master->tax_amount ?></b></td>
                                                                                                <?php } else { ?>
                                                                                                        <td><b>0.00</b></td>
                                                                                                <?php } ?>


                                                                                                <td>Shipping Amount</td>
                                                                                                <td> : </td>
                                                                                                <td><b><?= $order_master->shipping_charge ?></b></td>
                                                                                        </tr>



                                                                                        <tr>
                                                                                                <?php
                                                                                                $settings = common\models\Settings::findOne(5);
                                                                                                if (!empty($order_master->gift_wrap == 1)) {
                                                                                                        ?>
                                                                                                        <td>Gift Wrap Amount</td>
                                                                                                        <td> : </td>
                                                                                                        <td><b><?= $settings->value; ?></b></td>
                                                                                                <?php } ?>
                                                                                                 <?php
                                                                                                if ($promotion_amount > 0) {
                                                                                                        ?>
                                                                                                        <td>Coupon Code</td>
                                                                                                        <td> : </td>
                                                                                                        <td><b><?= $promotion_amount ?></b></td>
                                                                                                <?php } ?>
                                                                                        </tr>

                                                                                        <tr>
                                                                                                <td>Net Amount</td>
                                                                                                <td> : </td>
                                                                                                <td><b><?= $order_master->net_amount ?></b></td>

                                                                                                <?php if ($order_master->payment_status == 3 || $order_master->payment_status == 1) { ?>
                                                                                                        <td>Payment Method</td>
                                                                                                        <td> : </td>
                                                                                                        <td><b>
                                                                                                                        <?php
                                                                                                                        if ($order_master->payment_status == 3) {
                                                                                                                                echo 'COD';
                                                                                                                        } else {
                                                                                                                                echo 'Credit/Debit Card Payment';
                                                                                                                        }
                                                                                                                        ?>
                                                                                                                </b></td>
                                                                                                <?php } ?>
                                                                                        </tr>
                                                                                </table>
									</div>
								</div>

								<div class="col-md-6 col-lg-6 bill-address-div " style="color:#000000bd">
									<div class="div-pdng order-div" >
										<b class="bill-address">User Comment</b>
										<p class="first-p" style="color:#000000bd;"><?= $order_master->user_comment ?></p>
									</div>
								</div>



							</div>
						<?php } ?>
                                                <div style="margin-top: 10px">
							<?=
							GridView::widget([
							    'dataProvider' => $dataProvider,
							    'filterModel' => $searchModel,
							    'columns' => [
								    ['class' => 'yii\grid\SerialColumn'],
								'order_id',
								    [
								    'attribute' => 'product_id',
								    'header' => 'Product',
								    'value' => function($data) {
									    if ($data->item_type == 1) {
										    $name = 'Custom Perfume';
									    } else {
										    $name = Product::findOne($data->product_id)->product_name;
									    }
									    return $name;
								    }
								],
								'quantity',
								'amount',
								'rate',
//
								[
								    'attribute' => 'status',
								    'filter' => ['1' => 'Delivered', '0' => 'Not Delivered'],
								    'value' => function($data) {
									    return $data->status == 1 ? 'Delivered' : 'Not Delivered';
								    }
								],
//                                    [
//                                        'attribute' => 'delivered_date',
//                                        'format' => 'raw',
//                                        'value' => function ($data) {
//                                            $order_masters = OrderMaster::find()->where(['order_id' => $data->order_id])->one();
////                                            if ($order_masters->status != 4 && $order_masters->status != 5) {
//                                            if ($data->status != 4 ) {
////                                                if ($data->assigned_to == Yii::$app->user->identity->id || Yii::$app->user->identity->post_id == 1) {
//                                                    return DateTimePicker::widget([
//                                                                'name' => 'delivered_date',
//                                                                'id' => 'date-' . $data->id,
//                                                                'options' => ['class' => 'delivered_date'],
//                                                                'type' => DateTimePicker::TYPE_INPUT,
//                                                                'value' => $data->delivered_date,
//                                                                'pluginOptions' => [
//                                                                    'autoclose' => true,
//                                                                    'format' => 'yyyy-mm-dd hh:ii:ss'
//                                                                ]
//                                                    ]);
////                                                } else {
////                                                    return $data->delivered_date;
////                                                }
//                                            } else {
//                                                return $data->delivered_date;
////                                                return $data->delivered_date;
//                                            }
//                                        },
////                                        'filter' => DateRangePicker::widget(['model' => $searchModel, 'attribute' => 'delivered_date', 'pluginOptions' => ['format' => 'yyyy-mm-dd hh:ii:ss', 'autoUpdateInput' => false]]),
//                                    ],
								    [
								    'class' => 'yii\grid\ActionColumn',
								    'template' => '{view-more}',
								    'buttons' => [
									'view-more' => function ($url, $model) {
										if ($model->item_type == 1) {
											return Html::a('<span><i class="fa fa-arrow-right" aria-hidden="true"></i></span>', $url, [
												    'title' => Yii::t('app', 'view more'),
												    'class' => '',
											]);
										}
									},
								    ],
								    'urlCreator' => function ($action, $model) {
									    if ($action === 'view-more') {
										    $url = Url::to(['view-more', 'id' => $model->id]);
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
</div>


<script>
	$(document).ready(function () {
		$(".filters").slideToggle();
		$("#search-option").click(function () {
			$(".filters").slideToggle();
		});
	});
</script>

