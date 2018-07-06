<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ContactUsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Contact Us';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-us-index">

        <div class="row">
                <div class="col-md-12">

                        <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                                </div>
                                <div class="panel-body">


                                        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>



                                        <div class="table-responsive" style="border: none">
                                                <button class="btn btn-white" id="search-option" style="float: right;">
                                                        <i class="linecons-search"></i>
                                                        <span>Search</span>
                                                </button>

                                                <?php
                                                $gridColumns = [
                                                        ['class' => 'yii\grid\SerialColumn'],
                                                    'first_name',
                                                    'last_name',
                                                    'email:email',
                                                    'mobile_no',
                                                  
                                                    'reason',
                                                    
                                                        ['class' => 'yii\grid\ActionColumn',
                                                        'template' => '{delete}'],
                                                ];

                                                $exportColumns = [
                                                    'first_name',
                                                    'last_name',
                                                    'email:email',
                                                    'mobile_no',
                                                  
                                                    'reason',
                                                  
                                                ];

                                                echo ExportMenu::widget([
                                                    'dataProvider' => $dataProvider,
                                                    'filterModel' => $searchModel,
                                                    'columns' => $exportColumns,
                                                ]);

                                                echo \kartik\grid\GridView::widget([
                                                    'dataProvider' => $dataProvider,
                                                    'filterModel' => $searchModel,
                                                    'columns' => $gridColumns
                                                ]);
                                                ?>

                                                <?php
                                                GridView::widget([
                                                    'dataProvider' => $dataProvider,
                                                    'filterModel' => $searchModel,
                                                    'columns' => [
                                                            ['class' => 'yii\grid\SerialColumn'],
                                                        'first_name',
                                                        'last_name',
                                                        'email:email',
                                                        'mobile_no',
                                                        'country',
                                                        'reason',
                                                        'date',
                                                            ['class' => 'yii\grid\ActionColumn',
                                                            'template' => '{delete}'],
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

