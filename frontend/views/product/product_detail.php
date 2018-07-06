<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use common\models\Unit;
use common\components\ProductLinksHomeWidget;

$this->title = $product_details->canonical_name;
//$this->params['breadcrumbs'][] = $this->title;
?>
<link href="<?= Yii::$app->homeUrl ?>css/magiczoom.css" rel="stylesheet" type="text/css" media="screen"/>
<script src="<?= Yii::$app->homeUrl ?>js/magiczoom.js" type="text/javascript"></script>
<section class="in-product-detail">
    <div class="container">
        <div class="prod-detail-page">
            <div class="row">
                <div id="content" class="productpage col-sm-12">
                    <div class="row">
                        <div class="col-sm-8 product-left">
                            <div class="preview col">
                                <div class="app-figure" id="zoom-fig">
                                    <?php
                                    $product_image = Yii::$app->basePath . '/../uploads/product/' . $product_details->id . '/profile/' . $product_details->canonical_name . '.' . $product_details->profile;
                                    if (file_exists($product_image)) {
                                        ?>
                                        <a id="Zoom-1" class="MagicZoom" title=""
                                           href="<?= Yii::$app->homeUrl . 'uploads/product/' . $product_details->id . '/profile/' . $product_details->canonical_name . '_big.' . $product_details->profile ?>">
                                            <img src="<?= Yii::$app->homeUrl . 'uploads/product/' . $product_details->id . '/profile/' . $product_details->canonical_name . '_big.' . $product_details->profile ?>?scale.height=400" alt=""/>
                                        </a>
                                        <?php
                                    } else {
                                        ?>
                                        <a id="Zoom-1" class="MagicZoom" title=""
                                           href="<?= Yii::$app->homeUrl . 'uploads/product/gallery_dummy.png' ?>">
                                            <img src="<?= Yii::$app->homeUrl . 'uploads/product/gallery_dummy.png' ?>?scale.height=400" alt=""/>
                                        </a>
                                    <?php }
                                    ?>
                                    <div class="selectors">
                                        <?php
                                        if (file_exists($product_image)) {
                                            ?>
                                            <a data-zoom-id = "Zoom-1" href = "<?= Yii::$app->homeUrl . 'uploads/product/' . $product_details->id . '/profile/' . $product_details->canonical_name . '_big.' . $product_details->profile ?>">
                                                <img srcset = "<?= Yii::$app->homeUrl . 'uploads/product/' . $product_details->id . '/profile/' . $product_details->canonical_name . '_big.' . $product_details->profile ?>" width = "94px" height = "93px" class = "thumb-style"/>
                                            </a>
                                        <?php }
                                        ?>


                                        <?php
                                        $path = Yii::getAlias('@paths') . '/product/' . $product_details->id . '/gallery_large';

                                        if (file_exists($product_image)) {

                                            if (count(glob("{$path}/*")) > 0) {

                                                $k = 0;
                                                foreach (glob("{$path}/*") as $file) {
                                                    if ($k <= '2') {
                                                        $k++;
                                                        $arry = explode('/', $file);
                                                        $img_nmee = end($arry);
                                                        $img_nmees = explode('.', $img_nmee);
                                                        if ($img_nmees['1'] != '') {
                                                            ?>
                                                            <a data-zoom-id="Zoom-1" href="<?= Yii::$app->homeUrl . 'uploads/product/' . $product_details->id . '/gallery_large/' . end($arry) ?>">
                                                                <img srcset="<?= Yii::$app->homeUrl . 'uploads/product/' . $product_details->id . '/gallery_large/' . end($arry) ?>" width="94px" height="93px" class="thumb-style"/>
                                                            </a>
                                                            <?php
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-sm-4 product-right">

                            <h3 class="product-title"><?= $product_details->product_name ?></h3>
                            <div class="rating-wrapper">            
                                <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span>
                                <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span>
                                <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span>
                                <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span>
                                <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span>
                                <a class="review-count" href="#" onclick="$('a[href=\'#tab-review\']').trigger('click'); return false;">0 reviews</a><a class="write-review" href="#" onclick="$('a[href=\'#tab-review\']').trigger('click'); return false;"><i class="fa fa-pencil"></i> Write a review</a>
                            </div>

                            <div class="description">
                                <?php $unit = Unit::findOne($product_details->size_unit); ?>
                                <?php $fregrance = \common\models\Fregrance::findOne($product_details->product_type); ?>
                                <table class="product-description">
                                    <tbody>
                                        <tr><td><span>sizes:</span></td><td class="description-right"><a href=""><?= $product_details->size . $unit->unit_name ?></a></td></tr>
                                        <tr><td><span>Fragrance Type:</span></td><td class="description-right"><?= $fregrance->name ?></td></tr>
                                    </tbody>
                                </table>
                            </div>
                            <ul class="list-unstyled">
                                <?php $price = !empty($product_details->offer_price) ? $product_details->offer_price : $product_details->price ?>
                                <li>
                                    <h4 class="product-price">AED <?= $price ?></h4>
                                </li>
                                <li class="cash-On-delivery">Cash On Delivery Available</li>
                            </ul>
                            <div id="product">
                                <div class="form-group ">
                                    <label class="control-label input-quantity" for="input-quantity">Qty</label>
                                    <select  class="q_ty form-control" name="quantity" id="quantity">
                                        <?php
                                        for ($i = 1; $i <= $product_details->stock; $i++) {
                                            ?>
                                            <option value="<?= $i ?>"><?= $i ?></option>
                                        <?php } ?>
                                    </select>
                                    <input type="hidden" name="product_id" value="<?= $product_details->id ?>">
                                </div>
                                <div class="clearfix"></div>
                                <?php if ($product_details->stock > 0 && $product_details->stock_availability == 1) { ?>
                                    <button type="button" id="button-cart" pro_id="<?= $product_details->canonical_name ?>" data-loading-text="Loading..." class="btn btn-primary btn-lg btn-block add-cart">Add to Cart</button>
                                <?php }
                                ?>
                            </div>

                            <div class="btn-group">
                                <?php if ($product_details->stock > 0 && $product_details->stock_availability == 1) { ?>
                                    <button type="button" class="btn btn-default wishlist" title="Add to WishList" onclick="wishlist.add('28');"><i class="fa fa-heart"></i>Add to WishList</button>
                                <?php }
                                ?>
                            </div>

                            <!-- AddThis Button BEGIN -->


                            <!-- AddThis Button END --> 

                        </div>
                        <div class="col-sm-12" id="tabs_info">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tab-description" data-toggle="tab">Description</a></li>
                                <li><a href="#tab-review" data-toggle="tab">Reviews (0)</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab-description">
                                    <?= $product_details->product_detail ?>
                                </div>
                                <div class="tab-pane" id="tab-review">
                                    <form class="form-horizontal" id="form-review">
                                        <div id="review"></div>
                                        <h4>Write a review</h4>				
                                        <div class="form-group required">
                                            <div class="col-sm-12">
                                                <label class="control-label" for="input-name">Your Name</label>
                                                <input type="text" name="name" value="" id="input-name" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group required">
                                            <div class="col-sm-12">
                                                <label class="control-label" for="input-review">Your Review</label>
                                                <textarea name="text" rows="5" id="input-review" class="form-control"></textarea>
                                                <div class="help-block"><span class="text-danger">Note:</span> HTML is not translated!</div>
                                            </div>
                                        </div>
                                        <div class="form-group required">
                                            <div class="col-sm-12">
                                                <label class="control-label">Rating</label>
                                                &nbsp;&nbsp;&nbsp; Bad&nbsp;
                                                <input type="radio" name="rating" value="1">
                                                &nbsp;
                                                <input type="radio" name="rating" value="2">
                                                &nbsp;
                                                <input type="radio" name="rating" value="3">
                                                &nbsp;
                                                <input type="radio" name="rating" value="4">
                                                &nbsp;
                                                <input type="radio" name="rating" value="5">
                                                &nbsp;Good</div>
                                        </div>
                                        <fieldset>
                                            <legend>Captcha</legend>
                                            <div class="form-group required">
                                                <label class="col-sm-2 control-label" for="input-captcha">Enter the code in the box below</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="captcha" id="input-captcha" class="form-control">
                                                    <img src="index24c7.jpg?route=extension/captcha/basic_captcha/captcha" alt="">
                                                </div>
                                            </div>
                                        </fieldset>

                                        <div class="buttons clearfix">
                                            <div class="pull-right">
                                                <button type="button" id="button-review" data-loading-text="Loading..." class="btn btn-primary">Continue</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<?php if ($product_details->related_product) { ?>


    <section class="home-product-section"><!--home-product-section-->
        <div class="container">
            <div class="main-hometab-heading">Related Products</div>
            <div class="row">
                <?php
                $related_products = explode(',', $product_details->related_product);
                $related_products = array_rand($related_products, 5);
                $j = 0;
                foreach ($related_products as $val) {
                    $j++;
                    ?>
                    <?= ProductLinksHomeWidget::widget(['id' => $val]) ?>
                    <?php
                    if ($k == 6) {
                        break;
                    }
                }
                ?>
            </div>
        </div>
    </section>
    <?php
}
?>
<?php if ($recently_viewed) { ?>


    <section class="home-product-section">
        <div class="container">
            <div class="main-hometab-heading">Recently Viewed</div>
            <div class="row">
                <?php
                $k = 0;
                foreach ($recently_viewed as $val) {
                    $k++;
                    ?>
                    <?= ProductLinksHomeWidget::widget(['id' => $val->product_id]) ?>
                    <?php
                    if ($k == 6) {
                        break;
                    }
                }
                ?>
            </div>
        </div>
    </section>
    <?php
}
?>