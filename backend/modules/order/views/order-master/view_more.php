<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use common\models\User;
use common\models\Product;
use common\models\Characters;
use common\models\Scent;
use common\models\Gender;
use common\models\Notes;
use common\models\Bottle;

/* @var $this yii\web\View */
/* @var $searchModel common\models\OrderMasterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Custom Perfume Order Details';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-master-index">

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>


                </div>
                <div class="panel-body">
                    <?= Html::a('<i class="fa-th-list"></i><span> Manage Order </span>', ['index'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone']) ?>
                    <div class="table-responsive" style="border: none">
                        <?=
                        GridView::widget([
                            'dataProvider' => $dataProvider,
//                            'filterModel' => $searchModel,
                            'columns' => [
//                                ['class' => 'yii\grid\SerialColumn'],
                                [
                                    'attribute' => 'gender',
                                    'value' => function($data) {
                                        if (isset($data->gender)) {
                                            return Gender::findOne($data->gender)->gender;
                                        } else {
                                            return '';
                                        }
                                    }
                                ],
                                [
                                    'attribute' => 'character_id',
                                    'value' => function($data) {
                                        if (isset($data->character_id)) {
                                            return Characters::findOne($data->character_id)->name;
                                        } else {
                                            return '';
                                        }
                                    }
                                ],
                                [
                                    'attribute' => 'scent',
                                    'value' => function($data) {
                                        if (isset($data->scent)) {
                                            return Scent::findOne($data->scent)->scent;
                                        } else {
                                            return '';
                                        }
                                    }
                                ],
                                [
                                    'attribute' => 'note',
                                    'value' => function($data) {
                                        if (isset($data->note)) {
                                            $note = explode(',', $data->note);
                                            $result = '';
                                            $i = 0;
                                            if (!empty($note)) {
                                                foreach ($note as $val) {

                                                    if ($i != 0) {
                                                        $result .= ',';
                                                    }
                                                    $note_name = Notes::findOne($val);
                                                    $result .= $note_name->notes;
                                                    $i++;
                                                }
                                            }
                                            return $result;
                                        } else {
                                            return '';
                                        }
                                    }
                                ],
                                [
                                    'attribute' => 'bottle',
                                    'value' => function($data) {
                                        if (isset($data->bottle)) {
                                            return Bottle::findOne($data->bottle)->name;
                                        } else {
                                            return '';
                                        }
                                    }
                                ],
                                [
                                    'attribute' => 'label_1',
                                    'label' => 'Label',
                                    'value' => function($data) {
                                        $label1 = '';
                                        $label2 = '';
                                        if (isset($data->label_1)) {
                                            $label1 = $data->label_1;
                                        }
                                        if (isset($data->label_2)) {
                                            $label2 = $data->label_2;
                                        }
                                        return $label1 . ' ' . $label2;
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
<style>
    .summary{
        display: none;
    }
</style>