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
		
          <h3 class="product-title">Bright Crystal</h3>
		            <div class="rating-wrapper">            
                                          <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span>
                                                        <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i></span>
                                          <a class="review-count" href="#" onclick="$('a[href=\'#tab-review\']').trigger('click'); return false;">0 reviews</a><a class="write-review" href="#" onclick="$('a[href=\'#tab-review\']').trigger('click'); return false;"><i class="fa fa-pencil"></i> Write a review</a>
		  </div>
              
          <div class="description">
			<table class="product-description"> <!-- Megnor <table> Start -->	
							<tbody><tr><td><span>Brand:</span></td><td class="description-right"><a href="index54e6.html?route=product/manufacturer/info&amp;manufacturer_id=5">HTC</a></td></tr>
							<tr><td><span>Product Code:</span></td><td class="description-right">Product 1</td></tr>
							<tr><td><span>Reward Points:</span></td><td class="description-right">400</td></tr>
							<tr><td><span>Availability:</span></td><td class="description-right">In Stock</td></tr>
			</tbody></table>	<!-- Megnor <table> End -->	
		</div>
                    <ul class="list-unstyled">
                        <li>
              <h4 class="product-price">$122.00</h4>
            </li>
                                    <li class="price-tax">Ex Tax:<span>$100.00</span></li>
                                    <li class="cash-On-delivery">Cash On Delivery Available</li>
                                  </ul>
                    <div id="product">
                                    <div class="form-group ">
              <label class="control-label" for="input-quantity">Qty</label>
              <input type="text" name="quantity" value="1" size="2" id="input-quantity" class="form-control">
              <input type="hidden" name="product_id" value="28">
              
            </div>
            <button type="button" id="button-cart" data-loading-text="Loading..." class="btn btn-primary btn-lg btn-block">Add to Cart</button>
                      </div>
		  
		    <div class="btn-group">
            <button type="button" class="btn btn-default wishlist" title="Add to WishList" onclick="wishlist.add('28');"><i class="fa fa-heart"></i>Add to WishList</button>
			<span class="separator">|</span>
            <button type="button" class="btn btn-default compare" title="Add to Compare" onclick="compare.add('28');"><i class="fa fa-area-chart"></i>Add to Compare</button>
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
            <div class="tab-pane active" id="tab-description"><p>
	HTC Touch - in High Definition. Watch music videos and streaming content in awe-inspiring high definition clarity for a mobile experience you never thought possible. Seductively sleek, the HTC Touch HD provides the next generation of mobile functionality, all at a simple touch. Fully integrated with Windows Mobile Professional 6.1, ultrafast 3.5G, GPS, 5MP camera, plus lots more - all delivered on a breathtakingly crisp 3.8" WVGA touchscreen - you can take control of your mobile world with the HTC Touch HD.</p>
<p>
	<strong>Features</strong></p>
<ul>
	<li>
		Processor Qualcomm® MSM 7201A™ 528 MHz</li>
	<li>
		Windows Mobile® 6.1 Professional Operating System</li>
	<li>
		Memory: 512 MB ROM, 288 MB RAM</li>
	<li>
		Dimensions: 115 mm x 62.8 mm x 12 mm / 146.4 grams</li>
	<li>
		3.8-inch TFT-LCD flat touch-sensitive screen with 480 x 800 WVGA resolution</li>
	<li>
		HSDPA/WCDMA: Europe/Asia: 900/2100 MHz; Up to 2 Mbps up-link and 7.2 Mbps down-link speeds</li>
	<li>
		Quad-band GSM/GPRS/EDGE: Europe/Asia: 850/900/1800/1900 MHz (Band frequency, HSUPA availability, and data speed are operator dependent.)</li>
	<li>
		Device Control via HTC TouchFLO™ 3D &amp; Touch-sensitive front panel buttons</li>
	<li>
		GPS and A-GPS ready</li>
	<li>
		Bluetooth® 2.0 with Enhanced Data Rate and A2DP for wireless stereo headsets</li>
	<li>
		Wi-Fi®: IEEE 802.11 b/g</li>
	<li>
		HTC ExtUSB™ (11-pin mini-USB 2.0)</li>
	<li>
		5 megapixel color camera with auto focus</li>
	<li>
		VGA CMOS color camera</li>
	<li>
		Built-in 3.5 mm audio jack, microphone, speaker, and FM radio</li>
	<li>
		Ring tone formats: AAC, AAC+, eAAC+, AMR-NB, AMR-WB, QCP, MP3, WMA, WAV</li>
	<li>
		40 polyphonic and standard MIDI format 0 and 1 (SMF)/SP MIDI</li>
	<li>
		Rechargeable Lithium-ion or Lithium-ion polymer 1350 mAh battery</li>
	<li>
		Expansion Slot: microSD™ memory card (SD 2.0 compatible)</li>
	<li>
		AC Adapter Voltage range/frequency: 100 ~ 240V AC, 50/60 Hz DC output: 5V and 1A</li>
	<li>
		Special Features: FM Radio, G-Sensor</li>
</ul>
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
                <div class="box related">

                    <?= $product_details->product_detail ?>
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
                                    $related_products = array_rand($related_products,5);
//                                    print_r($related_products);
                                    foreach ($related_products as $val) {
                                            ?>
                                            <?= ProductLinksHomeWidget::widget(['id' => $val]) ?>
                                            <?php
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
                    foreach ($recently_viewed as $val) {
                        ?>
                        <?= ProductLinksHomeWidget::widget(['id' => $val->product_id]) ?>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </section>
    <?php
}
?>