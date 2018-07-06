<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use common\models\StoreLocator;
if (isset($meta_title) && $meta_title != '')
        $this->title = $meta_title;
else
        $this->title = 'Carnation';
?>
<div class="content_breadcum">
    <div class="container">
        <ul class="breadcrumb">
            <li><?= Html::a('<i class="fa fa-home"></i>', ['/site/index']) ?></li>
            <li><a href="">Store Locator</a></li>
        </ul>
        <h1 class="page-title">Store Locator</h1>

    </div>
</div>
<section class="in-main-store-locator">
    <div class="container">
        <div class="row">
            <?php $stores = StoreLocator::find()->where(['status' => '1'])->all();
            foreach ($stores as $store) {?>
            <div class="col-md-4">
                <div class="locator-box">
                    <div class="img">
                        <center>
                            <img src="<?= Yii::$app->homeUrl.'uploads/cms/store-locator/'.$store->id.'/medium.'.$store->image; ?>" class="img-responsive">
                        </center>
                    </div>
                    <div class="cont">
                        <h3><?= $store->location?></h3>
                        <p><?= $store->detail?>. </p>

                    </div>
                </div>
            </div>
            <?php } ?>
            <!--            <div class="col-md-4">
                            <div class="locator-box">
                                <div class="img">
                                    <center>
                                        <img src="<?= Yii::$app->homeUrl; ?>image/catalog/store-locator2.jpg" class="img-responsive">
                                    </center>
                                </div>
                                <div class="cont">
                                    <h3>Dubai</h3>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi accumsan turpis posuere cursus ultricies. </p>
            
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="locator-box">
                                <div class="img">
                                    <center>
                                        <img src="<?= Yii::$app->homeUrl; ?>image/catalog/store-locator3.jpg" class="img-responsive">
                                    </center>
                                </div>
                                <div class="cont">
                                    <h3>Dubai</h3>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi accumsan turpis posuere cursus ultricies. </p>
            
                                </div>
                            </div>
                        </div>-->
        </div>
    </div>
</section>