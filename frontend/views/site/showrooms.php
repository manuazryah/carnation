<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;

if (isset($meta_title) && $meta_title != '')
    $this->title = $meta_title;
else
    $this->title = 'Carnation';
?>

<div class="pad-20 hide-xs"></div>

<div class="container">
    <div class="breadcrumb">
        <span class="current-page">Our Showrooms</span>
        <ol class="path">
            <li><?= Html::a('Home', ['/site/index'], ['class' => '']) ?></li>
            <li class="active">Showrooms</li>
        </ol>
    </div>
</div>

<div id="showrooms">
    <div class="container">
        <div class="row">
            <?php foreach ($showrooms as $showroom) {
                ?>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" >
                    <div class="showrooms">

                        <div class="col-lg-12  col-md-12  col-sm-6  col-xs-12 pad-0" style="min-height: 260px;
                             max-height: 260px;">
                            <div class="content addr_p">
                                <h3><?= $showroom->title ?></h3>
                                <?= $showroom->address ?>

                                <p class="txt-green"><?= $showroom->email ?></p>
                            </div>
                        </div>
                        <div class="showroom-location col-lg-12  col-md-12  col-sm-6  col-xs-12">
                            <div class="showroom-img"><img src="<?= Yii::$app->homeUrl; ?>uploads/cms/showrooms/<?= $showroom->id ?>/large.<?= $showroom->image ?>" class="img-responsive"/></div>
                            <div class="showroom-location-map"><?= $showroom->map ?></div>
                        </div>


                    </div>
                </div>
                <?php
            }
            ?>


        </div>
    </div>
</div>

<div class="pad-20"></div>

<!--<div class="pad-20"></div>-->
