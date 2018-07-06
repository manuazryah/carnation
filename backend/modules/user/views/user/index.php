<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\export\ExportMenu;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
        .fa-check{
                color: green;
        }
        .fa-ban{
                color:red;
        }

</style>
<div class="user-index">

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                </div>

                <div class="panel-body">




                    <?php // Html::a('<i class="fa-th-list"></i><span> Create User</span>', ['create'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone'])  ?>
                    <div class="table-responsive" style="border: none">
                        <button class="btn btn-white" id="search-option" style="float: right;">
                            <i class="linecons-search"></i>
                            <span>Search</span>
                        </button>
                        <?php
                        $gridColumns = [
//                            ['class' => 'yii\grid\SerialColumn'],
                            'first_name',
                            'last_name',
                            'email',
                            [
                                'attribute' => 'dob',
                                'label' => 'Date of Birth',
                                'value' => function ($model) {
                                    return $model->dob;
                                },
                            ],
                            [
                                'attribute' => 'gender',
                                'value' => function ($model) {
                                    if ($model->gender == 1) {
                                        return 'Male';
                                    } else {
                                        return "Female";
                                    }
                                },
                            ],
                            [
                                'attribute' => 'mobile_no',
                                'value' => function ($model) {
                                    if ($model->mobile_no) {
                                        return $model->mobile_no;
                                    } else {
                                        return "-";
                                    }
                                },
                            ],
                            [
                                'attribute' => 'email_verification',
                                'header'=>'Email Verified / Not',
                                'filter' => ['1' => 'Verified', '0' => 'Not Verified'],
                                'value' => function($data) {
                                    return $data->email_verification == 1 ? 'Verified' : 'Not Verified';
                                }
                            ],
//                            ['class' => 'yii\grid\ActionColumn'],
                              [
                                                        'class' => 'yii\grid\ActionColumn',
                                                        'contentOptions' => [],
                                                        'header' => 'Actions',
                                                        'template' => '{approve}{disable}{update}',
                                                        'buttons' => [
                                                            'approve' => function ($url, $model) {
                                                                    if ($model->status == 0) {
                                                                            return Html::a('<i class="fa fa-check" aria-hidden="true"></i>', $url, [
                                                                                        'title' => Yii::t('app', 'Click here to active this user'),
                                                                                        'class' => 'actions',
                                                                            ]);
                                                                    }
                                                            },
                                                            'disable' => function ($url, $model) {
                                                                    if ($model->status == 1) {
                                                                            return Html::a('<i class="fa fa-ban" aria-hidden="true"></i>', $url, [
                                                                                        'title' => Yii::t('app', 'Click here to disable this user'),
                                                                                        'class' => 'actions',
                                                                            ]);
                                                                    }
                                                            },
                                                        ],
                                                        'urlCreator' => function ($action, $model) {

                                                                if ($action === 'approve') {
                                                                        $url = Url::to(['approve', 'id' => $model->id]);
                                                                        return $url;
                                                                }
                                                                if ($action === 'disable') {
                                                                        $url = Url::to(['disable', 'id' => $model->id]);
                                                                        return $url;
                                                                }

                                                                if ($action === 'update') {
                                                                        $url = Url::to(['update', 'id' => $model->id]);
                                                                        return $url;
                                                                }
                                                        }
                                                    ],
                        ];
                        ?>
                        <?php
                        echo ExportMenu::widget([
                            'dataProvider' => $dataProvider,
                            'columns' => $gridColumns
                        ]);

                        // You can choose to render your own GridView separately
                        echo \kartik\grid\GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'columns' => $gridColumns,
                            'rowOptions' => function($model) {
                                     if ($model->status == 0) {
                                                return ['class' => 'non-active-users'];
                                      }
                            },
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

