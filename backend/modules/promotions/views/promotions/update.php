<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Promotions */

$this->title = 'Update Promotions';
$this->params['breadcrumbs'][] = ['label' => 'Promotions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="row">
        <div class="col-md-12">

                <div class="panel panel-default">
                        <div class="panel-heading">
                                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                        </div>
                        <div class="panel-body">
                                <?= Html::a('<i class="fa-th-list"></i><span> Manage Promotions</span>', ['index'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                                <div class="panel-body"><div class="promotions-create">
                                                <?=
                                                $this->render('_form', [
                                                    'model' => $model,
                                                ])
                                                ?>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
</div>
