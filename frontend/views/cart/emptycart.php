<?php

use yii\helpers\Html;

$this->title = 'Shopping Cart';
?>
<div class="cart-page pbtm40  anyflexbox woocommerce-cart">
    <div class="content_breadcum" style="background-position: 50% 0px;"></div>
    <div data-vc-full-width="true" data-vc-full-width-init="true" class="vc_row wpb_row vc_row-fluid  vc_custom_ vc_row-has-fill   vc_hidden" style="position: relative; left: 0px; box-sizing: border-box; width: 1349px; padding-left: 0px; padding-right: 0px; margin: 0 auto; margin-bottom: 35px; margin-top: 15px; background: #1a1a1a; opacity: 1; ">
        <div class="container">
            <!--<h1 class="page-title">Contact Us</h1>-->
            
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div id="wpo-content" class="wpo-content col-xs-12 no-sidebar">
                <article id="post-8" class="post-8 page type-page status-publish hentry">
                    <div class="content emptycart">
                        <div class="woocommerce">
                            <div class="empty-img">
                                <img class="img-responsive" src="<?= Yii::$app->homeUrl; ?>image/empty-cart.png"/>
                            </div>
                            <!--<div class="lit-blue mob-checkout-buttons sub-total hidden-lg hidden-md hidden-sm">-->
                            <h3><span>Your Shopping Cart is Empty</span></h3>
                            <div class="col-md-12">
                                <?= Html::a('<button class="green2">Continue shopping</button>', ['site/index'], ['class' => 'button']) ?>
                            </div>

                        </div>
                    </div>
                    <!-- .entry-content -->
                </article>
                <!-- #post -->
            </div>
        </div>
    </div>
</div>
<div class="pad-20 hide-xs"></div>