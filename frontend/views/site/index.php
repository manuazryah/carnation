<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\components\ProductLinksHomeWidget;
use common\models\HomeCategory;

if (isset($meta_title) && $meta_title != '')
    $this->title = $meta_title;
else
    $this->title = 'Carnation';
?>

<div class="main-slider">
    <div id="spinner"></div>
    <div id="slideshow0" class="owl-carousel" style="opacity: 1;">
        <?php
        if (!empty($sliders)) {
            foreach ($sliders as $slider) {
                ?>
                <div class="item"> <a href="#"><img src="<?= Yii::$app->homeUrl; ?>uploads/cms/slider/<?= $slider->id ?>/large.<?= $slider->img ?>" alt="<?= $slider->alt_tag_content != '' ? $slider->alt_tag_content : '' ?>" class="img-responsive" /></a> </div>
                <?php
            }
        }
        ?>
    </div>
</div>
<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery("#slideshow0").owlCarousel({
            items: 6,
            autoPlay: 4000,
            singleItem: true,
            navigation: true,
            navigationText: ['<i class="fa fa-chevron-left fa-5x"></i>', '<i class="fa fa-chevron-right fa-5x"></i>'],
            pagination: true,
            transitionStyle: "fade"
        });
    });</script> 
<script type="text/javascript">
    // Can also be used with $(document).ready()
    $(window).load(function () {
        $("#spinner").fadeOut("slow");
    });</script>

<?php
$k = 0;
foreach ($home_datas as $home_data) {
    if ($home_data->type == 1) {
        if (isset($home_data->products)) {
            ?>
            <section class="home-product-section"><!--home-product-section-->
                <div class="container">
                    <div class="main-hometab-heading"><?= $home_data->heading ?></div>
                    <div class="row">
                        <?php
                        $a = 0;
                        $products = explode(',', $home_data->products);
                        foreach ($products as $top_categorie) {
                            if ($a < 10) {
                                ?>
                                <?= ProductLinksHomeWidget::widget(['id' => $top_categorie]) ?>
                                <?php
                            }
                            $a++;
                        }
                        ?>
                    </div>
                </div>
            </section><!--home-product-section-->
            <?php
        }
    }
}
?>
<section class="home-category"><!--home-category-->
    <div class="container">
        <div class="category-box">
            <div class="row">
                <?php $homecategory = HomeCategory::findOne(1); ?>

                <div class="col-sm-6">
                    <div class="img-box">
                        <a href="<?= $homecategory->url1?>"><img src="<?= Yii::$app->homeUrl; ?>uploads/cms/home-category/image1.<?= $homecategory->image ?>" class="img-responsive" /></a>
                        <h3 class="head-1"><?= $homecategory->title1; ?></h3>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-sm-6 col-xs-6">
                            <div class="img-box">
                                <a href="<?= $homecategory->url2?>"><img src="<?= Yii::$app->homeUrl; ?>uploads/cms/home-category/image2.<?= $homecategory->image2 ?>" class="img-responsive" /></a>
                                <h3 class="head-1"><?= $homecategory->title2; ?></h3>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-6">
                            <div class="img-box">
                                <a href="<?= $homecategory->url3?>"><img src="<?= Yii::$app->homeUrl; ?>uploads/cms/home-category/image3.<?= $homecategory->image3 ?>" class="img-responsive" /></a>
                                <h3 class="head-1"><?= $homecategory->title3; ?></h3>
                            </div>
                        </div>
                        <div class="col-sm-12 col-xs-12">
                            <div class="img-box">
                                <a href="<?= $homecategory->url4?>"><img src="<?= Yii::$app->homeUrl; ?>uploads/cms/home-category/image4.<?= $homecategory->image4 ?>" class="img-responsive" /></a>
                                <h3 class="head-1"><?= $homecategory->title4; ?></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!--home-category-->

<?php
foreach ($home_datas as $home_data) {
    if ($home_data->type == 3) {
        ?> 
        <section class="home-product-section"><!--home-product-section-->
            <div class="container">
                <div class="main-hometab-heading"><?= $home_data->heading ?></div>
                <div class="row">
                    <?php
                    $products = explode(',', $home_data->products);
                    $b = 0;
                    foreach ($products as $top_categorie) {
                        if ($b < 10) {
                            ?>
                            <?= ProductLinksHomeWidget::widget(['id' => $top_categorie]) ?>
                            <?php
                        }
                        $b++;
                    }
                    ?>
                </div>
            </div>
        </section><!--home-product-section-->

    <?php } else if ($home_data->type == 2) {
        ?>
        <section class="home-offer-section"><!--home-offer-section-->
            <div class="container">
                <div class="img-box"><img src="<?= yii::$app->homeUrl; ?>uploads/cms/home-management/large.<?= $home_data->image; ?>" class="img-responsive" /></div>
            </div>
        </section><!--home-offer-section-->  
    <?php } ?>


    <?php if ($home_data->type == 4) { ?> 
        <section class="home-product-section"><!--home-product-section-->
            <div class="container">
                <div class="main-hometab-heading"><?= $home_data->heading ?></div>
                <div class="row">
                    <?php
                    $products = explode(',', $home_data->products);
                    $c = 0;
                    foreach ($products as $top_categorie) {
                        if ($c < 10) {
                            ?>
                            <?= ProductLinksHomeWidget::widget(['id' => $top_categorie]) ?>
                            <?php
                        }
                        $c++;
                    }
                    ?>
                </div>
            </div>
        </section><!--home-product-section-->
        <?php
    }
}
?>
<section class="home-Brands">
    <div class="container">
        <div class="main-hometab-heading">Our Brands</div> 
        <div class="content">
            <div class="slider lazy-clients">
                <?php foreach ($brands as $each_brand) { ?>
                    <?php
                    $brand_image = Yii::$app->basePath . '/../uploads/cms/brands/' . $each_brand->id . '/small.' . $each_brand->image;
                    if (file_exists($brand_image)) {
                        ?>
                        <div class="Brands-box"> <img src="<?= yii::$app->homeUrl; ?>uploads/cms/brands/<?= $each_brand->id ?>/large.<?= $each_brand->image ?>" alt="" title="" class="img-responsive"> </div>
                    <?php } else { ?>
                        <div class="Brands-box"> <img class="img-responsive" src="<?= Yii::$app->homeUrl . 'uploads/cms/brands/no-image.jpg' ?>" alt="<?= $each_brand->brand ?>" /> </div>
                        <?php } ?>
                    <?php } ?>
            </div>
        </div> 
    </div>
</section>