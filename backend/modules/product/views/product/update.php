<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Product */

$this->title = 'Update Product: ' . $model->canonical_name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
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
                <?php 
                $url = Yii::$app->homeUrl . '../product-detail/' . $model->canonical_name;
                ?>
                <?= Html::a('<i class="fa-th-list"></i><span> Manage Product</span>', ['index'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                <?= Html::a('<i class="fa-bars"></i><span> Copy</span>', ['product/copy?id=' . $model->id], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                <?= Html::a('<i class="fa-share"></i><span> Preview</span>', $url, ['class' => 'btn btn-warning  btn-icon btn-icon-standalone', 'target' => '_blank'], ['title' => Yii::t('app', 'Preview'), 'target' => '_blank',]) ?>
               
                <div class="panel-body"><div class="product-create">
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
