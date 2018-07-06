<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                </div>
                <div class="panel-body">


                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>



                    <?php // Html::a('<i class="fa-th-list"></i><span> Create User</span>', ['create'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                    <div class="table-responsive" style="border: none">
                        <button class="btn btn-white" id="search-option" style="float: right;">
                            <i class="linecons-search"></i>
                            <span>Search</span>
                        </button>
                        <?=
                        GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'rowOptions' => function ($model, $index, $widget, $grid) {
                                $url = 'http://' . Yii::$app->getRequest()->serverName . Yii::$app->homeUrl . 'user/user/update?id=' . $model->id;
                                return ['data-id' => $model->id, 'onclick' => "window.location.href='{$url}'", 'onmouseover' => "this.style.backgroundColor='rgba(167, 167, 167, 0.52)',this.style.cursor='pointer'", 'onmouseout' => "this.style.backgroundColor=''"];
                            },
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
//                                        'id',
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
                                        if($model->gender == 1){
                                            
                                        }
                                        return $model->dob;
                                    },
                                ],
                                // 'gender',
                                 'mobile_no',
                                // 'username',
                                // 'auth_key',
                                // 'password_hash',
                                // 'password_reset_token',
                                // 'email:email',
                                // 'status',
                                // 'created_at',
                                // 'updated_at',
//                                ['class' => 'yii\grid\ActionColumn'],
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

