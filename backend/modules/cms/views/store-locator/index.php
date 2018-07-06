<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\StoreLocatorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Store Locators';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="store-locator-index">

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                </div>
                <div class="panel-body">


                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>



                    <?= Html::a('<i class="fa-th-list"></i><span> Create Store Locator</span>', ['create'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
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
//                                'id',
                                'location',
                                [
                                    'attribute' => 'image',
                                    'format' => 'raw',
                                    'value' => function ($data) {
                                        if (isset($data->image)) {
                                            $img = '<img  src="' . Yii::$app->homeUrl . '../uploads/cms/store-locator/' . $data->id . '/thumb.' . $data->image . '?' . rand() . '"/>';
                                        } else {
                                            $img = '';
                                        }
                                        return $img;
                                    },
                                ],
                                'detail:ntext',
                                [
                                    'attribute' => 'status',
                                    'filter' => ['1' => 'Enable', '0' => 'Disable'],
                                    'value' => function($data) {
                                        return $data->status == 1 ? 'Enable' : 'Disable';
                                    }
                                ],
                                // 'CB',
                                // 'UB',
                                // 'DOC',
                                // 'DOU',
                                [
                                    'class' => 'yii\grid\ActionColumn',
//                                    'contentOptions' => ['style' => 'width:100px;'],
                                    'header' => 'Actions',
                                    'template' => '{update}{delete}',
                                    'buttons' => [
                                        'update' => function ($url, $model) {
                                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                                                        'title' => Yii::t('app', 'update'),
                                                        'class' => '',
                                            ]);
                                        },
                                    ],
                                    'urlCreator' => function ($action, $model) {
                                        if ($action === 'update') {
                                            $url = Url::to(['update', 'id' => $model->id]);
                                            return $url;
                                        }
                                        if ($action === 'delete') {
                                            $url = Url::to(['delete', 'id' => $model->id]);
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
    });
</script>

