<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
?>
<div class="pad-20 hide-xs"></div>

<div class="container">
    <div class="breadcrumb">
        <span class="current-page">Featured Products</span>
        <ol class="path">
            <li><?= Html::a('<span>Home</span>', ['index'], ['class' => '']) ?></li>
            <li><?= Html::a('<span>our products</span>', ['/product/index', 'id' => $catag->category_code], ['class' => '']) ?></li>
            <li class="active">Featured Products</li>
        </ol>
    </div>
</div>

<div id="our-product">
    <div class="container">
        <div class="input-group gender-selection">
            <div id="radioBtn" class="btn-group">
                <span>Type:</span>
                <a class="btn btn-primary btn-sm active" data-toggle="happy" data-title="Y">Women</a>
                <a class="btn btn-primary btn-sm notActive" data-toggle="happy" data-title="N">Men</a>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="col-lg-3 col-md-3 col-sm-12 left-accordation">
            <div class="panel panel-default">
                <div class="panel-body lit-blue">
                    <div class="slide-container">
                        <div class="list-group" id="mg-multisidetabs">
                            <a href="#" class="list-group-item active-head "><span>Other Products</span><span class="glyphicon glyphicon-menu-down mg-icon pull-right"></span></a>
                            <div class="panel list-sub" style="display: block">
                                <div class="panel-body">
                                    <div class="list-group">
                                        <a href="#" class="list-group-item active"><span>Our featured products</span><span class="fa fa-caret-right pull-left"></span></a>
                                        <!--                                        <div class="panel list-sub">
                                                                                    <div class="panel-body">
                                                                                        <div class="list-group">
                                                                                            <a href="#" class="list-group-item">Button Ups<span class="glyphicon glyphicon-menu-right mg-icon pull-right"></span></a>
                                                                                            <div class="panel list-sub">
                                                                                                <div class="panel-body">
                                                                                                    <a href="#" class="list-group-item">Long Sleeve</a>
                                                                                                    <a href="#" class="list-group-item">Short Sleeve</a>
                                                                                                    <a href="#" class="list-group-item">Cutoff Sleeve</a>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>-->
                                        <a href="#" class="list-group-item"><span class="fa fa-caret-left pull-left"></span><span>international brands</span></a>
                                        <a href="#" class="list-group-item"><span class="fa fa-caret-left pull-left"></span><span>new arrivals</span></a>
                                        <a href="#" class="list-group-item"><span class="fa fa-caret-left pull-left"></span><span>trending</span></a>
                                        <a href="#" class="list-group-item"><span class="fa fa-caret-left pull-left"></span><span>something special</span></a>
                                    </div>
                                </div>
                            </div>
                        </div><!-- ./ end list-group -->
                    </div><!-- ./ end slide-container -->
                </div><!-- ./ end panel-body -->
            </div><!-- ./ end panel panel-default-->
        </div><!-- ./ endcol-lg-6 col-lg-offset-3 -->

        <div class="col-md-9 product-list">
            <div class="international-brands">
                <!--========= 1st slide =========-->
                <div class="item active">
                    <div class="col-xs-12 col-sm-6 col-md-4 gp_products_item">
                        <div class="gp_products_inner">
                            <div class="gp_products_item_image">
                                <a href="<?= Yii::$app->homeUrl; ?>site/product-detail">
                                    <img src="<?= Yii::$app->homeUrl; ?>images/featured-products/1.png" alt="1" />
                                </a>
                            </div>
                            <ul class="text-center">
                                <a href="#"><li><i class="fa fa-facebook"></i></li></a>
                                <a href="#"><li><i class="fa fa-twitter"></i></li></a>
                                <a href="#"><li><i class="fa fa-linkedin"></i></li></a>
                            </ul>
                            <div class="gp_products_item_caption">
                                <ul class="gp_products_caption_name">
                                    <li><a href="#">Waves</a></li>
                                    <li><a href="#">Davidoff Men Cool Water Natural Spray</a></li>
                                </ul>
                                <ul class="gp_products_caption_rating">
                                    <li>AED 200.00</li>
                                    <li class="center">AED 400.00</li>
                                    <li class="pull-right"><a href="#">(40%OFF)</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!--========= 2nd slide =========-->
                <div class="item">
                    <div class="col-xs-12 col-sm-6 col-md-4 gp_products_item">
                        <div class="gp_products_inner">
                            <div class="gp_products_item_image">
                                <a href="<?= Yii::$app->homeUrl; ?>site/product-detail">
                                    <img src="<?= Yii::$app->homeUrl; ?>images/featured-products/2.png" alt="2" />
                                </a>
                            </div>
                            <ul class="text-center">
                                <a href="#"><li><i class="fa fa-facebook"></i></li></a>
                                <a href="#"><li><i class="fa fa-twitter"></i></li></a>
                                <a href="#"><li><i class="fa fa-linkedin"></i></li></a>
                            </ul>
                            <div class="gp_products_item_caption">
                                <ul class="gp_products_caption_name">
                                    <li><a href="#">Waves</a></li>
                                    <li><a href="#">Davidoff Men Cool Water Natural Spray</a></li>
                                </ul>
                                <ul class="gp_products_caption_rating">
                                    <li>AED 200.00</li>
                                    <li>AED 400.00</li>
                                    <li class="pull-right"><a href="#">(40%OFF)</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!--========= 3rd slide =========-->
                <div class="item">
                    <div class="col-xs-12 col-sm-6 col-md-4 gp_products_item">
                        <div class="gp_products_inner">
                            <div class="gp_products_item_image">
                                <a href="<?= Yii::$app->homeUrl; ?>site/product-detail">
                                    <img src="<?= Yii::$app->homeUrl; ?>images/featured-products/3.png" alt="3" />
                                </a>
                            </div>
                            <ul class="text-center">
                                <a href="#"><li><i class="fa fa-facebook"></i></li></a>
                                <a href="#"><li><i class="fa fa-twitter"></i></li></a>
                                <a href="#"><li><i class="fa fa-linkedin"></i></li></a>
                            </ul>
                            <div class="gp_products_item_caption">
                                <ul class="gp_products_caption_name">
                                    <li><a href="#">Waves</a></li>
                                    <li><a href="#">Davidoff Men Cool Water Natural Spray</a></li>
                                </ul>
                                <ul class="gp_products_caption_rating">
                                    <li>AED 200.00</li>
                                    <li>AED 400.00</li>
                                    <li class="pull-right"><a href="#">(40%OFF)</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!--========= 4th slide =========-->
                <div class="item">
                    <div class="col-xs-12 col-sm-6 col-md-4 gp_products_item">
                        <div class="gp_products_inner">
                            <div class="gp_products_item_image">
                                <a href="<?= Yii::$app->homeUrl; ?>site/product-detail">
                                    <img src="<?= Yii::$app->homeUrl; ?>images/featured-products/4.png" alt="4" />
                                </a>
                            </div>
                            <ul class="text-center">
                                <a href="#"><li><i class="fa fa-facebook"></i></li></a>
                                <a href="#"><li><i class="fa fa-twitter"></i></li></a>
                                <a href="#"><li><i class="fa fa-linkedin"></i></li></a>
                            </ul>
                            <div class="gp_products_item_caption">
                                <ul class="gp_products_caption_name">
                                    <li><a href="#">Waves</a></li>
                                    <li><a href="#">Davidoff Men Cool Water Natural Spray</a></li>
                                </ul>
                                <ul class="gp_products_caption_rating">
                                    <li>AED 200.00</li>
                                    <li>AED 400.00</li>
                                    <li class="pull-right"><a href="#">(40%OFF)</a></li>
                                </ul>
                            </div>
                        </div>
                    </div> <!--*-*-*-*-*-*-*-*-*-*- END BOOTSTRAP CAROUSEL *-*-*-*-*-*-*-*-*-*-->
                </div>

                <!--========= 5th slide =========-->
                <div class="item">
                    <div class="col-xs-12 col-sm-6 col-md-4 gp_products_item">
                        <div class="gp_products_inner">
                            <div class="gp_products_item_image">
                                <a href="<?= Yii::$app->homeUrl; ?>site/product-detail">
                                    <img src="<?= Yii::$app->homeUrl; ?>images/featured-products/4.png" alt="4" />
                                </a>
                            </div>
                            <ul class="text-center">
                                <a href="#"><li><i class="fa fa-facebook"></i></li></a>
                                <a href="#"><li><i class="fa fa-twitter"></i></li></a>
                                <a href="#"><li><i class="fa fa-linkedin"></i></li></a>
                            </ul>
                            <div class="gp_products_item_caption">
                                <ul class="gp_products_caption_name">
                                    <li><a href="#">Waves</a></li>
                                    <li><a href="#">Davidoff Men Cool Water Natural Spray</a></li>
                                </ul>
                                <ul class="gp_products_caption_rating">
                                    <li>AED 200.00</li>
                                    <li>AED 400.00</li>
                                    <li class="pull-right"><a href="#">(40%OFF)</a></li>
                                </ul>
                            </div>
                        </div>
                    </div> <!--*-*-*-*-*-*-*-*-*-*- END BOOTSTRAP CAROUSEL *-*-*-*-*-*-*-*-*-*-->
                </div>

                <!--========= 6th slide =========-->
                <div class="item">
                    <div class="col-xs-12 col-sm-6 col-md-4 gp_products_item">
                        <div class="gp_products_inner">
                            <div class="gp_products_item_image">
                                <a href="<?= Yii::$app->homeUrl; ?>site/product-detail">
                                    <img src="<?= Yii::$app->homeUrl; ?>images/featured-products/4.png" alt="4" />
                                </a>
                            </div>
                            <ul class="text-center">
                                <a href="#"><li><i class="fa fa-facebook"></i></li></a>
                                <a href="#"><li><i class="fa fa-twitter"></i></li></a>
                                <a href="#"><li><i class="fa fa-linkedin"></i></li></a>
                            </ul>
                            <div class="gp_products_item_caption">
                                <ul class="gp_products_caption_name">
                                    <li><a href="#">Waves</a></li>
                                    <li><a href="#">Davidoff Men Cool Water Natural Spray</a></li>
                                </ul>
                                <ul class="gp_products_caption_rating">
                                    <li>AED 200.00</li>
                                    <li>AED 400.00</li>
                                    <li class="pull-right"><a href="#">(40%OFF)</a></li>
                                </ul>
                            </div>
                        </div>
                    </div> <!--*-*-*-*-*-*-*-*-*-*- END BOOTSTRAP CAROUSEL *-*-*-*-*-*-*-*-*-*-->
                </div>
            </div>
        </div>

    </div>
</div>

<div class="pad-20"></div>
