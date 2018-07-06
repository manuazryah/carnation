<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Subscribe */

$this->title = 'Subscribes';
$this->params['breadcrumbs'][] = ['label' => 'Subscribes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
        <div class="col-md-12">

                <div class="panel panel-default">
                        <div class="panel-heading">
                                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                        </div>
                        <div class="panel-body">
                                <?= Html::a('<i class="fa-th-list"></i><span> Manage Subscribe</span>', ['index'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                                <div class="panel-body"><div class="subscribe-view">


                                                <div class="table-responsive">
                                                        <table id="example-1"  class="table table-striped table-bordered" cellspacing="0" width="100%">
                                                                <thead>
                                                                        <tr>

                                                                                <th>Email</th>
                                                                        </tr>
                                                                </thead>

                                                                <tbody>


                                                                        <tr>
                                                                                <td>

                                                                                        <?php
                                                                                        $i = 0;
                                                                                        foreach ($model as $value) {
                                                                                                $i++;
                                                               echo  '<span style ="display:none">'.$i.'</span>'.$value->email .', ';
                                                                                                if ($i % 100 == 0)
                                                                                                        echo'</td></tr><tr><td>';
                                                                                        }
                                                                                        ?>
                                                                                </td>



                                                                        </tr>
                                                                </tbody>

                                                        </table>

                                                </div>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
</div>



<link rel="stylesheet" href="<?= Yii::$app->homeUrl; ?>js/table/dataTables.bootstrap.css">
<script src="<?= Yii::$app->homeUrl; ?>js/table/jquery.dataTables.min.js"></script>

<script src="<?= Yii::$app->homeUrl; ?>js/table/dataTables.bootstrap.js"></script>
<script src="<?= Yii::$app->homeUrl; ?>js/table/jquery.dataTables.yadcf.js"></script>
<script src="<?= Yii::$app->homeUrl; ?>js/table/dataTables.tableTools.min.js"></script>
<script type="text/javascript">
        $(document).ready(function ($)
        {
                $("#example-1").dataTable({
                        aLengthMenu: [
                                [30, 50, 100, -1], [30, 50, 100, "All"]
                        ]
                });


        });
</script>

<style>
        #example-1_filter{
                display: none;
        }.dataTables_wrapper .table thead>tr .sorting:before, .dataTables_wrapper .table thead>tr .sorting_asc:before, .dataTables_wrapper .table thead>tr .sorting_desc:before{
                display: none;
        }
</style>