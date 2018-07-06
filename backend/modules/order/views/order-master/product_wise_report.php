<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use common\models\User;
use kartik\daterange\DateRangePicker;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel common\models\OrderMasterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Product Wise Report';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-master-index">

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                </div>
                <div class="panel-body">
                    <div class="row" style="margin-left: 0px;">
                        <?php
                        $items = \common\models\Product::findAll(['status' => 1]);
                        ?>
                        <?php $form = ActiveForm::begin(); ?>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="item_id">Product</label>
                                    <select id="item-id" class="form-control" name="item_id[]" aria-required="true" aria-invalid="true" multiple="multiple">
                                        <option value="">-Choose Product-</option>
                                        <?php foreach ($items as $item) { ?>
                                            <option value="<?= $item->id ?>" <?php
                                            if ($item_id != '') {
                                                if (in_array($item->id, $item_id)) {
                                                    echo 'selected';
                                                }
                                            }
                                            ?>><?= $item->product_name ?>
                                            </option>
                                        <?php }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="from_date">From Date</label>
                                    <?php
                                    echo DatePicker::widget([
                                        'name' => 'from_date',
                                        'value' => $from_date,
                                        //'language' => 'ru',
                                        'dateFormat' => 'yyyy-MM-dd',
                                        'options' => ['class' => 'form-control']
                                    ]);
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="to_date">To Date</label>
                                    <?php
                                    echo DatePicker::widget([
                                        'name' => 'to_date',
                                        'value' => $to_date,
                                        //'language' => 'ru',
                                        'dateFormat' => 'yyyy-MM-dd',
                                        'options' => ['class' => 'form-control']
                                    ]);
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <?= Html::submitButton('Search', ['class' => 'btn btn-secondary']) ?>
                                </div>
                            </div>
                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>

                     <div class="table-responsive">
                        <table>
                            <tr style="font-size: 17px;color: #3b3737;">
                                <th>Total Product</th>
                                <?php
                                $total = 0;
                                $k = 0;
                                foreach ($model as $value) {
                                    $k++;
                                    $total += $value['net_amount'];
                                }
                                $grandtotal = sprintf('%0.2f', $total);
                                ?>
                                <th>&nbsp;&nbsp;:&nbsp;&nbsp;</th>
                                <th><?= $k ?></th>
                                <th>&nbsp;&nbsp;&nbsp;&nbsp;Total Amount</th>
                                <th>&nbsp;&nbsp;:&nbsp;&nbsp;</th>
                                <th><?= $grandtotal ?></th>
                            </tr>
                        </table>
                    </div>

                    <div class="row table-responsive" style="margin-left: 0px;">
                        <div class="panel-body">
                            <script type="text/javascript">
                                $(document).ready(function ()
                                {
                                    $("#example-1").dataTable({
                                        aLengthMenu: [
                                            [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]
                                        ]
                                    });
                                });
                            </script>
                            <table id="example-1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Total Quantity</th>
                                        <th>Total Amount</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    if (!empty($model)) {
                                        foreach ($model as $value) {
                                            ?>
                                            <tr style="text-align:left;" class='' id="">
                                                <td>
                                                    <?php if (isset($value['product_id'])) { ?>
                                                        <?= Html::a(\common\models\Product::findOne($value['product_id'])->product_name, ['/product/product/update', 'id' => $value['product_id']], ['target' => '_blank']) ?>
                                                    <?php }
                                                    ?>
                                                </td>
                                                <td><?= $value['total_quantity'] ?></td>
                                                <td><?= $value['net_amount'] ?></td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" href="<?= Yii::$app->homeUrl; ?>js/datatables/dataTables.bootstrap.css">
<script src="<?= Yii::$app->homeUrl; ?>js/datatables/js/jquery.dataTables.min.js"></script>

<!-- Imported scripts on this page -->
<script src="<?= Yii::$app->homeUrl; ?>js/datatables/dataTables.bootstrap.js"></script>
<script src="<?= Yii::$app->homeUrl; ?>js/datatables/yadcf/jquery.dataTables.yadcf.js"></script>
<script src="<?= Yii::$app->homeUrl; ?>js/datatables/tabletools/dataTables.tableTools.min.js"></script>

<link rel="stylesheet" href="<?= Yii::$app->homeUrl; ?>js/select2/select2.css">
<link rel="stylesheet" href="<?= Yii::$app->homeUrl; ?>js/select2/select2-bootstrap.css">
<script src="<?= Yii::$app->homeUrl; ?>js/select2/select2.min.js"></script>



<script>
                                $(document).ready(function () {
                                    $("#item-id").select2({
                                        placeholder: '--Select Item--',
                                        allowClear: true
                                    }).on('select2-open', function ()
                                    {
                                        $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
                                    });
                                });
</script>