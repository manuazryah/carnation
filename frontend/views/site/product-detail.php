<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
?>
<div class="pad-20"></div>
<div class="container">
    <div class="breadcrumb">
        <span class="current-page">product</span>
        <ol class="path">
            <li><?= Html::a('<span>Home</span>', ['index'], ['class' => '']) ?></li>
            <li><?= Html::a('<span>product details</span>', ['site/product-detail'], ['class' => '']) ?></li>
        </ol>
    </div>
</div>
<div id="product-page">
    <div class="container">
        <div class="row">

            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 product-img-view-box">
                <!--                <div class="xzoom-container app-figure" id="zoom-fig">
                                    <img class="xzoom" id="xzoom-default" src="images/products/escape2.png" xoriginal="images/products/escape2.png" />
                                    <div class="xzoom-thumbs">
                                        <a href="images/products/escape2.png"><img class="xzoom-gallery" width="80" height="80" src="images/products/escape2.png"  xpreview="images/products/escape2.png"></a>
                                        <a href="images/products/metal.png"><img class="xzoom-gallery" width="80" height="80" src="images/products/metal.png"></a>
                                        <a href="images/gallery/original/03_r_car.jpg"><img class="xzoom-gallery" width="80" src="images/gallery/preview/03_r_car.jpg" title="The description goes here"></a>
                                        <a href="images/gallery/original/04_g_car.jpg"><img class="xzoom-gallery" width="80" src="images/gallery/preview/04_g_car.jpg" title="The description goes here"></a>
                                    </div>
                                </div>        -->


                <div class="app-figure" id="zoom-fig">
                    <a id="Zoom-1" class="MagicZoom" title="" href="<?= Yii::$app->homeUrl; ?>images/products/escape2.png">
                        <img src="<?= Yii::$app->homeUrl; ?>images/products/escape2.png?scale.height=400" alt=""/>
                    </a>
                    <div class="selectors">
                        <a data-zoom-id="Zoom-1" href="<?= Yii::$app->homeUrl; ?>images/products/escape.png" data-image="<?= Yii::$app->homeUrl; ?>images/products/escape2.png?scale.height=400">
                            <img srcset="<?= Yii::$app->homeUrl; ?>images/products/escape2.png?scale.width=112 2x" src="<?= Yii::$app->homeUrl; ?>images/products/escape2tumb.png?scale.width=56"/>
                        </a>
                        <a data-zoom-id="Zoom-1" href="<?= Yii::$app->homeUrl; ?>images/products/metal.png" data-image="<?= Yii::$app->homeUrl; ?>images/products/metal.png?scale.height=400">
                            <img srcset="<?= Yii::$app->homeUrl; ?>images/products/metal.png?scale.width=112 2x" src="<?= Yii::$app->homeUrl; ?>images/products/metaltumb.png?scale.width=56"/>
                        </a>
                        <a data-zoom-id="Zoom-1"  href="<?= Yii::$app->homeUrl; ?>images/products/passion.png" data-image="<?= Yii::$app->homeUrl; ?>images/products/passion.png?scale.height=400" >
                            <img srcset="<?= Yii::$app->homeUrl; ?>images/products/passion.png?scale.width=112 2x" src="<?= Yii::$app->homeUrl; ?>images/products/passiontumb.png?scale.width=56"/>
                        </a>
                    </div>
                </div>
                <span class="company-speciality col-md-12">Safe and Secure Payments. Easy returns. 100% Authentic products.</span>
            </div>
            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12 details">
                <h3 class="product-title">David of Cool Water Natural Spray</h3>
                <div class="rating">
                    <div class="stars">
                        <div class="lead">
                            <div id="stars-existing" class="starrr" data-rating='4'></div>
                        </div>
                    </div>
                </div>
                <p class="price">200.00 AED  <span>318.00 AED</span> </p>
                <p class="message">FREE Shipping on orders over 150.00 AED</p>
                <div class="hr-box">
                    <h5 class="sizes">sizes:
                        <span class="size active-box" data-toggle="tooltip" title="xtra large">100ml</span>
                        <span class="size" data-toggle="tooltip" title="large">90ml</span>
                        <span class="size" data-toggle="tooltip" title="medium">50ml</span>
                        <span class="size" data-toggle="tooltip" title="small">30ml</span>
                    </h5>
                    <br/>
                    <h5 class="type">Fragrance Type:
                        <span class="not-available active-box" data-toggle="tooltip" title="Many In store">Eau de Parfum</span>
                        <!--<span class="not-available" data-toggle="tooltip" title="Not In store">Arabic Parfum</span>-->
                    </h5>
                </div>
                <p class="product-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt  nisi ut aliquip ex ea commodo consequat....</p>
                <h5 class="availability">availability:
                    <span>many in stock</span>
                </h5>
                <div class="col-lg-12 col-md-12 hidden-sm hidden-xs pad-0">
                    <select min="0" max="5" id="number_passengers"  name="quantity" id="quantity">

                        <option value="1">1</option>

                        <option value="2">2</option>

                        <option value="3">3</option>

                        <option value="4">4</option>

                        <option value="5">5</option>

                        <option value="6">6</option>

                        <option value="7">7</option>

                        <option value="8">8</option>

                        <option value="9">9</option>

                        <option value="10">10</option>

                    </select>
                                    <!--<input type="number" min="0" max="5" id="number_passengers" value="1">-->

                    <div class="action">
                        <a href="#" class="start-shopping">add to cart</a>
                        <a href="#" class="start-shopping">buy now</a>
                    </div>
                    <div class="share">
                        <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                        <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                        <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                        <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
            <div class="hidden-lg hidden-md col-sm-12 col-xs-12 product-option-buttons">
                <select min="0" max="5" id="number_passengers"  name="quantity" id="quantity">

                    <option value="1">1</option>

                    <option value="2">2</option>

                    <option value="3">3</option>

                    <option value="4">4</option>

                    <option value="5">5</option>

                    <option value="6">6</option>

                    <option value="7">7</option>

                    <option value="8">8</option>

                    <option value="9">9</option>

                    <option value="10">10</option>

                </select>
                                <!--<input type="number" min="0" max="5" id="number_passengers" value="1">-->

                <div class="action">
                    <a href="#" class="start-shopping">add to cart</a>
                    <a href="#" class="start-shopping">buy now</a>
                </div>
                <div class="share">
                    <ul>
                        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-plus" aria-hidden="true"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="pad-30 hidden-sm hidden-md"></div>
    <div class="container">
        <div class="product-info-tab">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#info">More Info</a></li>
                <li><a data-toggle="tab" href="#reviews">Reviews</a></li>
            </ul>

            <div class="tab-content">
                <div id="info" class="tab-pane fade in active">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui official. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt..</p>
                </div>
                <div id="reviews" class="tab-pane fade">
                    <div class="review-adding-sec">
                        <h4>Customer Reviews</h4>
                        <div class="rating">
                            <div class="stars">
                                <div class="lead">
                                    <div id="stars-existing" class="starrr" data-rating='2'><p class="review-base">Based on 2 Reviews</p> <a class="add-review" href="#">add review</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="customer-reviews">
                        <p class="subject"> Sooo Good</p>
                        <i>vishal on Jul 30, 2017</i>
                        <p class="message">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat...</p>
                        <div class="report-span"><a href="#">Report as Inappropriate</div>
                    </div>
                    <div class="customer-reviews">
                        <p class="subject"> Sooo Good</p>
                        <i>vishal on Jul 30, 2017</i>
                        <p class="message">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat...</p>
                        <div class="report-span"><a href="#">Report as Inappropriate</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="pad-30"></div>
    <div class="container">
        <div class="international-brands">
            <h1>Recently viewed</h1>
            <div class="product-slider">
                <div id="adv_gp_products_1_columns_carousel" class="carousel slide four_shows_one_move gp_products_carousel_wrapper" data-ride="carousel" data-interval="2000">
                    <!--========= Wrapper for slides =========-->
                    <div class="carousel-inner" role="listbox">

                        <!--========= 1st slide =========-->
                        <div class="item active">
                            <div class="col-xs-12 col-sm-6 col-md-3 gp_products_item">
                                <div class="gp_products_inner">
                                    <div class="gp_products_item_image">
                                        <a href="<?= Yii::$app->homeUrl; ?>product-detail">
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
                            <div class="col-xs-12 col-sm-6 col-md-3 gp_products_item">
                                <div class="gp_products_inner">
                                    <div class="gp_products_item_image">
                                        <a href="<?= Yii::$app->homeUrl; ?>product-detail">
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
                            <div class="col-xs-12 col-sm-6 col-md-3 gp_products_item">
                                <div class="gp_products_inner">
                                    <div class="gp_products_item_image">
                                        <a href="<?= Yii::$app->homeUrl; ?>product-detail">
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
                            <div class="col-xs-12 col-sm-6 col-md-3 gp_products_item">
                                <div class="gp_products_inner">
                                    <div class="gp_products_item_image">
                                        <a href="<?= Yii::$app->homeUrl; ?>product-detail">
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
                            </div>
                        </div>

                    </div>

                    <!--======= Navigation Buttons =========-->

                    <!--======= Left Button =========-->
                    <a class="left carousel-control gp_products_carousel_control_left" href="#adv_gp_products_1_columns_carousel" role="button" data-slide="prev">
                        <span class="fa fa-angle-left gp_products_carousel_control_icons" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>

                    <!--======= Right Button =========-->
                    <a class="right carousel-control gp_products_carousel_control_right" href="#adv_gp_products_1_columns_carousel" role="button" data-slide="next">
                        <span class="fa fa-angle-right gp_products_carousel_control_icons" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>

                </div> <!--*-*-*-*-*-*-*-*-*-*- END BOOTSTRAP CAROUSEL *-*-*-*-*-*-*-*-*-*-->
            </div>
        </div>
        <div class="pad-30"></div>
        <div class="international-brands">
            <h1>Recently viewed</h1>
            <div class="product-slider">
                <div id="adv_gp_products_8_columns_carousel" class="carousel slide four_shows_one_move gp_products_carousel_wrapper" data-ride="carousel" data-interval="2000">
                    <!--========= Wrapper for slides =========-->
                    <div class="carousel-inner" role="listbox">

                        <!--========= 1st slide =========-->
                        <div class="item active">
                            <div class="col-xs-12 col-sm-6 col-md-3 gp_products_item">
                                <div class="gp_products_inner">
                                    <div class="gp_products_item_image">
                                        <a href="<?= Yii::$app->homeUrl; ?>product-detail">
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
                            <div class="col-xs-12 col-sm-6 col-md-3 gp_products_item">
                                <div class="gp_products_inner">
                                    <div class="gp_products_item_image">
                                        <a href="<?= Yii::$app->homeUrl; ?>product-detail">
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
                            <div class="col-xs-12 col-sm-6 col-md-3 gp_products_item">
                                <div class="gp_products_inner">
                                    <div class="gp_products_item_image">
                                        <a href="<?= Yii::$app->homeUrl; ?>product-detail">
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
                            <div class="col-xs-12 col-sm-6 col-md-3 gp_products_item">
                                <div class="gp_products_inner">
                                    <div class="gp_products_item_image">
                                        <a href="<?= Yii::$app->homeUrl; ?>product-detail">
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
                            </div>
                        </div>

                    </div>

                    <!--======= Navigation Buttons =========-->

                    <!--======= Left Button =========-->
                    <a class="left carousel-control gp_products_carousel_control_left" href="#adv_gp_products_8_columns_carousel" role="button" data-slide="prev">
                        <span class="fa fa-angle-left gp_products_carousel_control_icons" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>

                    <!--======= Right Button =========-->
                    <a class="right carousel-control gp_products_carousel_control_right" href="#adv_gp_products_8_columns_carousel" role="button" data-slide="next">
                        <span class="fa fa-angle-right gp_products_carousel_control_icons" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>

                </div> <!--*-*-*-*-*-*-*-*-*-*- END BOOTSTRAP CAROUSEL *-*-*-*-*-*-*-*-*-*-->
            </div>
        </div>

    </div>


</div>

</div>
<div class="pad-20"></div>
