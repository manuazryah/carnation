<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\HomeCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Home Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="home-category-index">

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                </div>
                <div class="panel-body">

                    
                                                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                    


                    <?=  Html::a('<i class="fa-th-list"></i><span> Create Home Category</span>', ['create'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                    <button class="btn btn-white" id="search-option" style="float: right;">
                        <i class="linecons-search"></i>
                        <span>Search</span>
                    </button>
                    <div class="table-responsive" style="border: none">
                                                                            <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                                        'id',
            'title1',
            'url1',
            'image',
            'title2',
            // 'url2',
            // 'image2',
            // 'title3',
            // 'url3',
            // 'image3',
            // 'title4',
            // 'url4',
            // 'image4',
            // 'UB',
            // 'DOU',

                            ['class' => 'yii\grid\ActionColumn'],
                            ],
                            ]); ?>
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

