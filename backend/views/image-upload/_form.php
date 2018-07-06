<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ImageUpload */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="image-upload-form form-inline">

    <?php $form = ActiveForm::begin() ?>
    <!--['options' => ['enctype' => 'multipart/form-data']]-->
<?= $form->field($model, 'imagefile')->fileInput() ?>

    <button>Submit</button>

    <?php ActiveForm::end() ?>

</div>
