<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Json;

/* @var $this yii\web\View */
/* @var $model common\models\UserImg */

$this->title = 'Create User Img';
$this->params['breadcrumbs'][] = ['label' => 'User Imgs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$data = Json::decode($model->data_positions);
?>
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css">
<style type="text/css">
    .bgimg {
        z-index: 3;
        position: relative;

    }
    
    .datas {
        padding: 0.5em;
        font-weight: bolder;
        color: black;
        position: absolute;
        background-color: rgba(151, 152, 152, 0.4);

    }
    .data_style{
        font-weight: bolder;
        color: black;
        position: absolute;

        line-height: 12px;
        background-color: rgba(151, 152, 152, 0.4);
        cursor: all-scroll;
    }
    #label_1{
        top:<?= $data['label_1']['top'] . 'px' ?>;
        left:<?= $data['label_1']['left'] . 'px' ?>;
        width:<?= $data['label_1']['width'] . 'px' ?>;
        font-size: <?= $data['label_1']['font_size'] . 'px' ?>;

    }
    #label_2{
        top:<?= $data['label_2']['top'] . 'px' ?>;
        left:<?= $data['label_2']['left'] . 'px' ?>;
        width:<?= $data['label_2']['width'] . 'px' ?>;
        font-size: <?= $data['label_2']['font_size'] . 'px' ?>;

    }
    #image{
        width:<?= $data['image']['width'] . 'px' ?>;
        height:<?= $data['image']['height'] . 'px' ?>;
        left:<?= $data['image']['left'] . 'px' ?>;
        top:<?= $data['image']['top'] . 'px' ?>;

    }



</style>
<div class="container">
    <div class = "row">
        <?php $form = ActiveForm::begin(['id' => 'cheque_form', 'options' => ['enctype' => 'multipart/form-data', 'method' => 'post'], 'action' => Yii::$app->homeUrl . 'create_your_own/bottle/save-layout']) ?>
        <div class="col-md-3">

            <div class="bank-accounts-create panel">

                <h1 style="font-size: 20px">&nbsp;</h1>
                <?=
                $this->render('bottle_design_form', [
                    'model' => $model,
                    'form' => $form,
                    'data' => $data,
                ])
                ?>

            </div>
        </div>
        <div class = "col-md-9">

            <div class = "panel panel-default">
                <div class = "panel-heading">
                    <?= Html::a('<i class="fa-th-list"></i><span> Manage Bottle </span>', ['index'], ['class' => 'btn btn-warning  btn-icon btn-icon-standalone', 'style' => 'float:right;margin-right: 23px;']) ?>
                    <h3 class="title">update bottle design:</h3>

                </div>
                <div class="panel-body">





                    <div class="bgimg" style="width:<?= $model->image_width ?>px;height:<?= $model->image_height ?>px;background-image: url(<?= Yii::$app->homeUrl ?>../uploads/create_your_own/bottle/<?= $model->id ?>/large.<?= $model->bottle_img ?>)">
                            <!--<img class="cheque_image"src='<?= Yii::$app->homeUrl ?>../uploads/create_your_own/bottle/<?= $model->id ?>/large.<?= $model->bottle_img ?>' style="" id="chq_image">-->
                        <div id="image" class="data_style" style="">
                        </div>
                        <div id="label_1" class="data_style"><?= $model->label_1 ?></div>
                        <div id="label_2" class="data_style"><?= $model->label_2 ?></div>
                    </div>
                    <input type="hidden" name="model_id" value="<?= $model->id ?>" id="model_id">
                    <input type="hidden" name="label_1_x" value="" id="label_1_x">
                    <input type="hidden" name="label_1_y" value="" id="label_1_y">
                    <input type="hidden" name="label_1_width" value="" id="label_1_width">
                    <input type="hidden" name="label_2_x" value="" id="label_2_x">
                    <input type="hidden" name="label_2_y" value="" id="label_2_y">
                    <input type="hidden" name="label_2_width" value="" id="label_2_width">
                    <input type="hidden" name="image_x" value="" id="image_x">
                    <input type="hidden" name="image_y" value="" id="image_y">
                    <input type="hidden" name="image_width" value="" id="image_width">
                    <input type="hidden" name="image_height" value="" id="image_height">


                    <div class="form-group" >
                        <input value="Save" type="submit" onclick="function()" class="btn btn-primary" style="margin-top: 18px;" id="save">
                    </div>


                </div>
            </div>
        </div>
        <?php ActiveForm::end() ?>
    </div>
</div>


<script>
    $(document).ready(function () {

        $("#image").css({position: 'absolute'});


        setTimeout(function () {
        }, 30);
        $('#label_1').draggable(
                {
                    drag: function () {
                        var offset = $(this).position();
                        var xPos = offset.left;
                        var yPos = offset.top;
                        $('#label_1_x').val(xPos);
                        $('#label_1_y').val(yPos);
                    }
                }).resizable({
            handles: 'e, w',
            stop: function (event, ui) {
                $('#label_1_width').val($('#label_1').width());
            }
        });
        $('#label_2').draggable(
                {
                    drag: function () {
                        var offset = $(this).position();
                        var xPos = offset.left;
                        var yPos = offset.top;
                        $('#label_2_x').val(xPos);
                        $('#label_2_y').val(yPos);
                    }
                }).resizable({
            handles: 'e, w',
            stop: function (event, ui) {
                $('#label_2_width').val($('#label_2').width());
            }
        });
        $('#image').draggable(
                {
                    drag: function () {
                        var offset = $(this).position();
                        var xPos = offset.left;
                        var yPos = offset.top;
                        $('#image_x').val(xPos);
                        $('#image_y').val(yPos);
                    }
                }).resizable({
            handles: 'n, e, s, ne, se, sw, nw',
            stop: function (event, ui) {
                $('#image_width').val($('#image').width());
                $('#image_height').val($('#image').height());
            }
        });

//		$("#img_div").resizable({
//			resize: function (e, ui) {
//				console.log(ui.size);
//				$('#image_width').val(ui.size.width);
//				$('#image_height').val(ui.size.height);
//			}
//		});
    });</script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

