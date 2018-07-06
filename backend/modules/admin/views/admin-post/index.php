<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use common\models\AdminPost;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AdminPostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Admin Posts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-post-index">

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                </div>
                <div class="panel-body">
                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                    

                    <?= Html::a('<i class="fa-th-list"></i><span> Create Admin Post</span>', ['create'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                    <button class="btn btn-white" id="search-option" style="float: right;">
                        <i class="linecons-search"></i>
                        <span>Search</span>
                    </button>
                    <div class="table-responsive table-striped" style="border: none">
                        <?=
                        GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
//                            'id',
                                'post_name',
//                            [
//                                'attribute' => 'post_name',
//                                'filter' => ArrayHelper::map(AdminPost::find()->all(), 'id', 'post_name'),
//                                'value' => function($data) {
//                                    return AdminPost::findOne($data->id)->post_name;
//                                }
//                            ],
                                [
                                    'attribute' => 'admin',
                                    'filter' => ['1' => 'Yes', '0' => 'No'],
                                    'value' => function($data) {
                                        return $data->admin == 1 ? 'Yes' : 'No';
                                    }
                                ],
//                            'CB',
//                            'UB',
                                // 'DOC',
                                // 'DOU',
                                [
                                    'attribute' => 'status',
                                    'filter' => ['1' => 'Enable', '0' => 'Disable'],
                                    'value' => function($data) {
                                        return $data->status == 1 ? 'Enable' : 'Disable';
                                    }
                                ],
                                ['class' => 'yii\grid\ActionColumn',
                                    'template' => '{update}{delete}'],
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


