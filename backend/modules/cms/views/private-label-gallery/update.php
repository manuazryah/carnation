<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\PrivateLabelGallery */

$this->title = 'Update Private Label Page';
$this->params['breadcrumbs'][] = ['label' => 'Private Label Galleries', 'url' => ['index']];
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
				<?=
				$this->render('sub_menu', [
				])
				?>

                                <div class="panel-body"><div class="private-label-gallery-create">
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
