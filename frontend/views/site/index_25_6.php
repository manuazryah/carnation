<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\components\ProductLinksHomeWidget;
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
if (!empty($about)) {
        ?>
        <div class="subbanner_outer">
                <div class="subbanner_half sub_half1" id="subbanner">
                        <div class="customNavigation"> <a class="btn prev">&nbsp;</a> <a class="btn next">&nbsp;</a> </div>
                        <div class="subbanner_half1_inner product-carousel" id="subbanner-carousel">
                                <?php
                                $path = Yii::getAlias('@paths') . '/cms/about/' . $about->id;
                                
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
                                                        <div class="slider-item" style="background-image: url(<?= Yii::$app->homeUrl; ?>uploads/cms/about/<?= $about->id ?>/<?= end($arry) ?>);"> <a><img src="<?= Yii::$app->homeUrl; ?>uploads/cms/about/<?= $about->id ?>/<?= end($arry) ?>" alt="<?= end($arry) ?>"></a>
                                                        </div>
                                                        <?php
                                                }
                                              }   
                                        }
                                } else {
                                        ?>
                                        <div class="slider-item" style="background-image: url(image/catalog/cms-banner-01.jpg);"> <a href="#"><img src="<?= yii::$app->homeUrl; ?>image/catalog/cms-banner-01.jpg" alt=""></a>
                                        </div>
                                        <div class="slider-item" style="background-image: url(image/catalog/sub-Banner-2.jpg);"> <a href="#"><img src="<?= yii::$app->homeUrl; ?>image/catalog/sub-Banner-2.jpg" alt=""></a>
                                        </div>
                                <?php }
                                ?>
                        </div>
                        <div class="subbanner_default_width" style="display: none; visibility: hidden;">&nbsp;</div>
                </div>
                <div class="subbanner_half sub_half2">
                        <div class="subbanner_half2_inner">
                                <div class="banner-title">
                                        <h1 class="simple-type small-title"><?= $about->index_title ?></h1>
                                </div>
                                <div class="service-subbanner">
                                        <?= $about->index_content ?>
                                </div>
                        </div>
                </div>
        </div>
        <?php
}
?>

<?php
$k = 0;
foreach ($home_datas as $home_data) {
        if ($home_data->type == 1) {
                if (isset($home_data->products)) {
                        ?>
                        <div class="hometab container">
                                <div class="hometab-heading">Top Categories</div>
                                <div id="tab-latest" class="tab-content">
                                        <div class="box">
                                                <div class="box-content">
                                                        <div class="customNavigation"> <a class="prev fa fa-long-arrow-left">&nbsp;</a> <a class="next fa fa-long-arrow-right">&nbsp;</a> </div>
                                                        <div class="box-product product-carousel" id="tablatest-carousel">
                                                                <?php
                                                                $products = explode(',', $home_data->products);
                                                                foreach ($products as $top_categorie) {
                                                                        ?>
                                                                        <?= ProductLinksHomeWidget::widget(['id' => $top_categorie]) ?>
                                                                        <?php
                                                                }
                                                                ?>
                                                        </div>
                                                </div>
                                        </div>
                                        <span class="tablatest_default_width" style="display:none; visibility:hidden"></span> </div>
                        </div>
                        <?php
                }
        } else if ($home_data->type == 2) {
                ?>

                <div class="cms_outer">
                        <div class="cms_outer_inner container">
                                <div class="cms-banner-inner"> <a href="#"> <img src="<?= yii::$app->homeUrl; ?>uploads/cms/home-management/large.<?= $home_data->image; ?>" alt="Sub Banner image"></a>
                                        <div class="border-banner">
                                                <div class="inner-border">
                                                        <!--<div class="content-text-banner">
                                                                <div class="banner-text1">up to 75% off On fashion</div>
                                                                <div class="banner-text2">Looking Fashion <span> style in smell</span></div>
                                                                <div class="shop_button"> <a href="#">shop Now</a> </div>
                                                        </div>-->
                                                </div>
                                        </div>
                                </div>
                        </div>
                </div>

        <?php
        } else if ($home_data->type == 3) {
                if (isset($home_data->products)) {
                        ?>
                        <div class="hometab container">
                                <div class="hometab-heading">Featured</div>
                                <div id="tab-special" class="tab-content">
                                        <div class="box">
                                                <div class="box-content">
                                                        <div class="customNavigation"> <a class="prev fa fa-long-arrow-left">&nbsp;</a> <a class="next fa fa-long-arrow-right">&nbsp;</a> </div>
                                                        <div class="box-product product-carousel" id="tabspecial-carousel">
                                                                <?php
                                                                $featured_products = explode(',', $home_data->products);
                                                                foreach ($featured_products as $featured) {
                                                                        ?>
                                                                        <?= ProductLinksHomeWidget::widget(['id' => $featured]) ?>
                                                                        <?php
                                                                }
                                                                ?>
                                                        </div>
                                                </div>
                                        </div>
                                        <span class="tabspecial_default_width" style="display:none; visibility:hidden"></span> </div>
                        </div>

                        <?php
                }
        }
}
?>
<span class="featured_default_width" style="display:none; visibility:hidden"></span>
<div class="parallex" data-source-url="">
        <div class="parallex_inner container">
                <div class="parllaex-third parallex1">
                        <div class="pa-icon"> </div>
                        <div class="pa-contant">
                                <div class="pa-content1">FREE SHIPPING</div>
                                <div class="pa-content2">on order over $150.00</div>
                        </div>
                        <div class="pa-button"><a href="#">Shop Now</a></div>
                </div>
                <div class="parllaex-third parallex2">
                        <div class="pa-icon"> </div>
                        <div class="pa-contant">
                                <div class="pa-content1">FREE RETURN</div>
                                <div class="pa-content2">free 90 days return</div>
                        </div>
                        <div class="pa-button"><a href="#">Shop Now</a></div>
                </div>
                <div class="parllaex-third parallex3">
                        <div class="pa-icon"> </div>
                        <div class="pa-contant">
                                <div class="pa-content1">MEMBER DISCOUNT</div>
                                <div class="pa-content2">free register</div>
                        </div>
                        <div class="pa-button"><a href="#">Shop Now</a></div>
                </div>
        </div>
</div>
<div class="testimonials" id="testimonial">
        <div class="homepage-testimonial-inner container">
                <div class="testimonial_inner">
                        <div class="cms-box-heading">Clients Say</div>
                        <div class="homepage-testimonials-inner products block_content">
                                <div class="customNavigation"><a class="btn prev">&nbsp;</a> <a class="btn next">&nbsp;</a></div>
                                <div class="products product-carousel" id="testimonial-carousel">
                                        <div class="slider-item">
                                                <div class="peoplesay-block">
                                                        <div class="test-image"><img src="<?= yii::$app->homeUrl; ?>image/catalog/user1.jpg" alt=""></div>
                                                        <div class="test-content">
                                                                <div class="test-desc">
                                                                        <p>Maecenas nec fringilla felis Nulla ultrices pulvinar magna in iaculis Ut tellus eros sodales faucibus sapien Lorem Ipsum has been the industrys standard. Lorem Ipsum the industrys standard .</p>
                                                                </div>
                                                        </div>
                                                </div>
                                        </div>
                                        <div class="slider-item">
                                                <div class="peoplesay-block">
                                                        <div class="test-image"><img src="<?= yii::$app->homeUrl; ?>image/catalog/user2.jpg" alt=""></div>
                                                        <div class="test-content">
                                                                <div class="test-desc">
                                                                        <p>Maecenas nec fringilla felis Nulla ultrices pulvinar magna in iaculis Ut tellus eros sodales faucibus sapien Lorem Ipsum has been the industrys standard. Lorem Ipsum has been the industrys standard with dumpty Text.</p>
                                                                </div>
                                                        </div>
                                                </div>
                                        </div>
                                        <div class="slider-item">
                                                <div class="peoplesay-block">
                                                        <div class="test-image"><img src="<?= yii::$app->homeUrl; ?>image/catalog/user1.jpg" alt=""></div>
                                                        <div class="test-content">
                                                                <div class="test-desc">
                                                                        <p>Maecenas nec fringilla felis Nulla ultrices pulvinar magna in iaculis Ut tellus eros sodales faucibus sapien Lorem Ipsum has been the industrys standard. Lorem Ipsum has been the industrys standard with dumpty Text.</p>
                                                                </div>
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                        </div>
                </div>
                <div class="testimonial_default_width" style="display: none; visibility: hidden;">&nbsp;</div>
        </div>
</div>
<div class="container">
        <div class="row">
                <div id="content" class="col-sm-12">
                        <div class="box">
                                <div class="box-heading"><a href="#">Latest Blog</a></div>
                                <div class="box-content">
                                        <div class="box-product  owl-carousel blogcarousel " id="blog-carousel">

                                                <?php foreach ($blogs as $blog) {
                                                        ?>
                                                        <div class="blog-item">
                                                                <div class="product-block">
                                                                        <div class="blog-left">
                                                                                <!--                                                                                <h4><a href="index4b1d.html?route=information/blogger&amp;blogger_id=4">Quisque egestas</a> </h4>-->
                                                                                <div class="blog-image"> <img src="<?= yii::$app->homeUrl; ?>uploads/cms/from-blog/<?= $blog->id ?>/large.<?= $blog->image ?>" alt="Latest Blog" title="Latest Blog" class="img-thumbnail" />
                                                                                        <div class="post-image-hover"> </div>
                                                                                        <p class="post_hover"><a class="icon zoom" title="Click to view Full Image " href="<?= yii::$app->homeUrl; ?>uploads/cms/from-blog/<?= $blog->id ?>/large.<?= $blog->image ?>" data-lightbox="example-set"><i class="fa fa-search-plus"></i> </a><a class="icon readmore_link" title="Click to view Read More " href="index4b1d.html?route=information/blogger&amp;blogger_id=4"><i class="fa fa-link"></i></a></p>
                                                                                </div>
                                                                        </div>
                                                                        <div class="blog-right">
                                                                                <div class="date-time"><?= date('F d Y', strtotime($blog->blog_date)) ?></div>
                                                                                <div class="blog-desc"> <?= substr($blog->content, 0, 100); ?> </div>
                                                                                <div class="view-blog">
                                                                                        <div class="read-more"> <a href="#">Read More</a> </div>
                                                                                        <!--<div class="write-comment"> <a href="index4b1d.html?route=information/blogger&amp;blogger_id=4"> 0 Comments</a> </div>-->
                                                                                </div>
                                                                        </div>
                                                                </div>
                                                        </div>

<?php } ?>
                                        </div>
                                </div>
                        </div>
                        <span class="blog_default_width" style="display:none; visibility:hidden"></span>
                        <script type="text/javascript">

                                $(document).ready(function () {
                                        $('.blogcarousel').owlCarousel({
                                                items: 3,
                                                autoPlay: 10000,
                                                singleItem: false,
                                                navigation: true,
                                                navigationText: ['<i class="prev fa fa-long-arrow-left"></i>', '<i class="next fa fa-long-arrow-right"></i>'],
                                                pagination: true,
                                                itemsDesktop: [1000, 2],
                                                itemsDesktopSmall: [979, 2]
                                        });
                                });
                        </script>
                        <script type="text/javascript">

                                $(document).ready(function flex() {
                                        $('.blog_page .blog-image').each(function () {
                                                var that = $(this);
                                                var url = that.find('img').attr('src');
                                                that.css({'background-image': 'url("' + url + '")'});
                                                var that1 = $('.blog_page .blog-image img');
                                                that1.css('display', 'none');

                                        });
                                });

                        </script>
                        <div id="carousel-0" class="banners-slider-carousel">
                                <div class="box-heading">Brands</div>
                                <div class="customNavigation"> <a class="prev fa fa-long-arrow-left">&nbsp;</a> <a class="next fa fa-long-arrow-right">&nbsp;</a></div>
                                <div class="product-carousel" id="module-0-carousel">

 <?php foreach ($brands as $each_brand) { ?>
                                                <div class="slider-item">
                                                        <div class="product-block">
                                                                <?php
                                                                $brand_image = Yii::$app->basePath . '/../uploads/cms/brands/' . $each_brand->id . '/large.' . $each_brand->image;
                                                                if (file_exists($brand_image )) {
                                                                        ?>
                                                                        <div class="product-block-inner"> <img src="<?= yii::$app->homeUrl; ?>uploads/cms/brands/<?= $each_brand->id ?>/large.<?= $each_brand->image ?>" alt="<?= $each_brand->brand ?>" /> </div>
                                                                <?php } else { ?>
                                                                        <div class="product-block-inner"> <img src="<?= Yii::$app->homeUrl . 'uploads/cms/brands/no-image.jpg' ?>" alt="<?= $each_brand->brand ?>" /> </div>
                                                                <?php } ?>
                                                        </div>
                                                </div>
                                        <?php } ?>

                                </div>
                        </div>
                        <span class="module_default_width" style="display:none; visibility:hidden"></span></div>
        </div>
</div>