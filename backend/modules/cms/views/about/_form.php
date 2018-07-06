<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model common\models\About */
/* @var $form yii\widgets\ActiveForm */
//echo strlen($model->chairman_message);exit;
?>

<div class="about-form form-pos">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class='col-md-12 col-sm-12 col-xs-12 left_padd'>
            <?=
            $form->field($model, 'carnation_history')->widget(CKEditor::className(), [
                'options' => ['rows' => 3],
                'preset' => 'custom'
            ])
            ?>
        </div>
        <div class='col-md-6 col-sm-6 col-xs-12 left_padd'>
            <?=
            $form->field($model, 'our_vision')->widget(CKEditor::className(), [
                'options' => ['rows' => 6],
                'preset' => 'custom'
            ])
            ?>
        </div>
        <div class='col-md-6 col-sm-6 col-xs-12 left_padd'>
            <?=
            $form->field($model, 'our_mission')->widget(CKEditor::className(), [
                'options' => ['rows' => 6],
                'preset' => 'custom'
            ])
            ?>
        </div>
        <div class='col-md-6 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'index_title')->textInput(['maxlength' => true]) ?>

        </div>

        <div class='col-md-6 col-sm-6 col-xs-12 left_padd'>    <?= $form->field($model, 'chairman_name')->textInput(['maxlength' => true]) ?>

        </div>
        <div class='col-md-6 col-sm-6 col-xs-12 left_padd'>
            <?=
            $form->field($model, 'index_content')->widget(CKEditor::className(), [
                'options' => ['rows' => 6],
                'preset' => 'custom'
            ])
            ?>
        </div>
        <div class='col-md-6 col-sm-6 col-xs-12 left_padd'>
            <?=
            $form->field($model, 'chairman_message')->widget(CKEditor::className(), [
                'options' => ['rows' => 6],
                'preset' => 'custom'
            ])
            ?>
        </div>

        <div class='col-md-6 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'about_image[]')->fileInput(['multiple' => true])->label('Index Images<i> (748x580)</i>') ?>
            <?php
            $path = Yii::getAlias('@paths') . '/cms/about/' . $model->id;
            if (count(glob("{$path}/*")) > 0) {
                $k = 0;
                foreach (glob("{$path}/*") as $file) {
                 if(!is_dir($file)){
                    $k++;
                    $arry = explode('/', $file);
                    $img_nmee = end($arry);

                    $img_nmees = explode('.', $img_nmee);
                    if ($img_nmees['1'] != '') {
                        ?>

                        <div class = "col-md-4 img-box" id="<?= $k; ?>">
                            <div class="news-img">
                                <img class="img-responsive" src="<?= Yii::$app->homeUrl . '../uploads/cms/about/' . $model->id . '/' . end($arry) ?>">
                                <?= Html::a('<i class="fa fa-remove"></i>', ['/cms/about/remove', 'path' => Yii::$app->basePath . '/../uploads/cms/about/' . $model->id . '/' . end($arry)], ['class' => 'gal-img-remove']) ?>
                            </div> 
                        </div>


                        <?php
                    }
                    if ($k % 4 == 0) {
                        ?>
                        <div class="clearfix"></div>
                        <?php
                    }
                    }
                }
            }
            ?>

        </div>
        <div class='col-md-6 col-sm-6 col-xs-12 left_padd'>
            <?= $form->field($model, 'chairman_image')->fileInput()->label('Chairman Image<i> (270x330)</i>') ?>

            <?php
            if (!$model->isNewRecord) {
                ?>

                <div class = "col-md-2 img-box">
                    <img src="<?= Yii::$app->homeUrl . '../uploads/cms/about/' . $model->id . '/chairman/' . 'small.' . $model->chairman_image ?>" >
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="row">
        <div class='col-md-12 col-sm-12 col-xs-12' >
            <div class="form-group" >
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-success', 'style' => 'margin-top: 18px; height: 36px; width:100px;float:right']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<style>
    .img-box {
        margin: 10px 0px;
    }
    .news-img {
        border: 1px solid #e4dede;
    }
    .gal-img-remove {
        position: absolute;
        top: 6px;
        right: 25px;
        font-size: 16px;
        color: red;
    }
    .gal-img-remove:hover {
        color: red;
    }
</style>

