<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;

if (isset($meta_title) && $meta_title != '')
    $this->title = $meta_title;
else
    $this->title = 'Carnation';
?>

<div class="content_breadcum">
    <div class="container">
        <ul class="breadcrumb">
            <li><?= Html::a('<i class="fa fa-home"></i>', ['/site/index']) ?></li>
            <li><a href="">Privacy Policy</a></li>
        </ul>
        <h1 class="page-title">Privacy Policy</h1>

    </div>
</div>


<div class="container">
    <div class="row">
        <div class="col-md-12 commingsoon" style="margin: 100px 0;">
            <img src="<?= Yii::$app->homeUrl ?>image/Under-Construction.jpg" class="img-responsive">
        </div>
    </div>
</div>