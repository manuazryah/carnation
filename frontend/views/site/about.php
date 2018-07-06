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
            <li><a href="">About Us</a></li>
        </ul>
        <h1 class="page-title">About Us</h1>

    </div>
</div>  
<section class="in-about-section">
    <div class="container">

        <div class="cont-box">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-4">
                    <div class="img-box">
                        <img src="<?= Yii::$app->homeUrl; ?>image/catalog/profile-img.png" class="img-responsive">
                        <div class="img-cont"><small>Director's Message</small><h4><?= $about->chairman_name ?></h4></div> 
                    </div>
                </div>
                <div class="col-lg-9 col-md-8 col-sm-8">
                    <div class="right-box">
                        <?= $about->chairman_message ?>
                        <div class="signature"><img src="<?= yii::$app->homeUrl; ?>image/catalog/signature.png" class="img-responsive"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="in-about-history">
    <div class="container">
        <div class="row">
            <div class="col-lg-2 col-md-3 col-sm-3"><img src="<?= Yii::$app->homeUrl; ?>image/catalog/about-years.png" class="img-responsive" ></div>
            <div class="col-lg-10 col-md-9 col-sm-9">
                <h3>Carnation History</h3>
                <?= $about->carnation_history ?>
            </div>
        </div>
    </div>
</section>
<section class="in-vision-section"><!--home-services -->
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="cont-box">
                    <span>01</span>
                    <h3>Our Vision</h3>
                    <?= $about->our_vision ?>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="cont-box">
                    <span>02</span>
                    <h3>Our Mission</h3>
                    <?= $about->our_mission ?>
                </div>
            </div>

        </div>
    </div>
</section>