<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\AboutSisterConcern */

$this->title = 'Update About Sister Concern: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'About Sister Concerns', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="row">
        <div class="col-md-12">

                <div class="panel panel-default">
                        <div class="panel-heading">
                                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                        </div>
                        <div class="panel-body">
				<?=  Html::a('<i class="fa-th-list"></i><span> Manage About Sister Concern</span>', ['index'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                                <div class="panel-body"><div class="about-sister-concern-create">
						<?= $this->render('_form', [
                                                'model' => $model,
                                                ]) ?>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
</div>
