<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Fregrance;
use common\models\CmsOthers;

$youtube_video = CmsOthers::find()->where(['id' => 7])->one();
?>
<section id="main-slider">
	<div id="bootstrap-touch-slider" class="carousel bs-slider fade  control-round indicators-line" data-ride="carousel" data-pause="hover" data-interval="5000" >

		<!-- Indicators -->
		<ol class="carousel-indicators">
			<?php
			$j = 0;
			foreach ($slider as $value) {
				?>
				<li data-target="#bootstrap-touch-slider" data-slide-to="<?= $j ?>" class="<?= $j == 0 ? 'active' : '' ?>"></li>
				<?php
				$j++;
			}
			?>
		</ol>

		<!-- Wrapper For Slides -->
		<div class="carousel-inner" role="listbox">

			<?php
			$k = 0;
			foreach ($slider as $value) {
				?>
				<div class="item <?= $k == 0 ? 'active' : '' ?>">

					<!-- Slide Background -->
					<img src="<?= Yii::$app->homeUrl; ?>uploads/cms/slider/<?= $value->id ?>/large.<?= $value->img ?>" alt="Bootstrap Touch Slider"  class="slide-image"/>
					<!--<div class="bs-slider-overlay"></div>-->

					<div class="container">
						<div class="row">
							<!-- Slide Text Layer -->
							<div class="slide-text slide_style_right">
								<p data-animation="animated fadeInLeft"><?= $value->slider_first_tittle ?></p>
								<h3 data-animation="animated zoomInRight"><?= $value->slider_second_tittle ?></h3>
								<?php if (isset($value->slider_link) && $value->slider_link != '') { ?>
									<a href="<?= $value->slider_link ?>" target="_blank" class="start-shopping" data-animation="animated fadeInLeft">start shopping</a>
								<?php } ?>
								<?php // Html::a('start shopping', ['/product/index', 'id' => $catag->category_code], ['class' => 'start-shopping', 'target' => '_blank', 'data-animation' => 'animated fadeInLeft']) ?>
							</div>
						</div>
					</div>
				</div>
				<?php
				$k++;
			}
			?>

		</div><!-- End of Wrapper For Slides -->

		<!-- Left Control -->
		<a class="left carousel-control" href="#bootstrap-touch-slider" role="button" data-slide="prev">
			<span class="fa fa-angle-left" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>

		<!-- Right Control -->
		<a class="right carousel-control" href="#bootstrap-touch-slider" role="button" data-slide="next">
			<span class="fa fa-angle-right" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>

	</div> <!-- End  bootstrap-touch-slider Slider -->
</section>

<section id="content-area">
	<div class="index-about">
		<div class="container">
			<div class="row">
				<div class="about-content">
					<h1><?= $about->index_title ?></h1>
					<?= $about->index_content; ?>
					<button class="black"><?= Html::a('<span>know more</span>', ['/site/about'], ['class' => '']) ?></button>
				</div>
			</div>
		</div>
	</div>

	<div class="category-grid sec-pad">
		<h1>shop by category</h1>
		<?php
		$shops = common\models\ShopByCategory::find()->where(['status' => 1])->orderBy(['id' => SORT_ASC])->all();
		$s = 0;
		$link = '';
		foreach ($shops as $shops_by) {
			$s++;
			?>
			<div style="<?= $s == 0 ? 'border-left: 0px;' : '' ?>" class=" <?= $s == 4 ? 'col-md-8' : 'col-md-4' ?>">
				<a href="<?= $shops_by->link ?>"><img class="img-responsive" src="<?= Yii::$app->homeUrl; ?>uploads/cms/shop-by-category/<?= $shops_by->id ?>/large.<?= $shops_by->image ?>"/></a>
			</div>

		<?php }
		?>
	</div>
	<?php
	if (!empty($featured_products)) {
		?>
	        <div class="featured-pro sec-pad">

			<h1>our featured products</h1>
			<div class="col-md-12 product-list" style="padding: 0px 50px;">
				<div class="international-brands">
					<?php
					foreach ($featured_products as $featured_product) {
						?>
						<div class="item ">
							<div class="col-xs-12 col-sm-6 col-md-3 gp_products_item">
								<div class="gp_products_inner">
									<div class="gp_products_item_image">
										<a href="<?= Yii::$app->homeUrl . 'product-detail/' . $featured_product->canonical_name ?>">
											<?php
											$product_image = Yii::$app->basePath . '/../uploads/product/' . $featured_product->id . '/profile/' . $featured_product->canonical_name . '.' . $featured_product->profile;
											if (file_exists($product_image)) {
												?>
												<img src="<?= Yii::$app->homeUrl . 'uploads/product/' . $featured_product->id . '/profile/' . $featured_product->canonical_name . '.' . $featured_product->profile ?>" height="100%" alt="1" />
												<?php
											} else {
												?>
												<img src="<?= Yii::$app->homeUrl . 'uploads/product/dummy_perfume.png' ?>" height="100%" alt="1" />
											<?php }
											?>
										</a>
										<?= Html::a(' <div class="img-overlay"></div>', 'product-detail/' . $featured_product->canonical_name, []) ?>
										<!--<div class="img-overlay"></div>-->
									</div>
									<ul class="text-center">
										<input type="hidden" value="1" class="q_ty">
										<?= Html::a('<li><i class="fa fa-shopping-cart"></i></li>', '#', ['class' => 'add_to_cart', 'id' => $featured_product->canonical_name]) ?>
										<?= Html::a('<li><i class="fa fa-heart"></i></li>', 'javascript:void(0)', ['class' => 'add_to_wish_list', 'id' => $featured_product->id]) ?>
										<?= Html::a('<li><i class="fa fa-eye"></i></li>', ['/product-detail/'.$featured_product->canonical_name], ['class' => '']) ?>
									</ul>

									<div class="gp_products_item_caption">

										<ul class="gp_products_caption_name">
											<li><a href="<?= Yii::$app->homeUrl . 'product-detail/' . $featured_product->canonical_name ?>"><?= $featured_product->product_name ?></a></li>
											<?php $product_type = Fregrance::findOne($featured_product->product_type); ?>
											<li><a href="<?= Yii::$app->homeUrl . 'product-detail/' . $featured_product->canonical_name ?>"><?= $product_type->name; ?></a></li>
										</ul>
										<ul class="gp_products_caption_rating">
											<?php
											if ($featured_product->offer_price != "0") {
												$percentage = round(100 - (($featured_product->offer_price / $featured_product->price) * 100));
												?>
												<li>AED <?= $featured_product->offer_price; ?></li>
												<li class="center">AED <?= $featured_product->price; ?></li>
												<li class="pull-right"><a href="#">(<?= $percentage ?>%OFF)</a></li>
												<?php
											} else {
												?>
												<li class="center">AED <?= $featured_product->price; ?></li>
											<?php } ?>
										</ul>

									</div>
								</div>
							</div>
						</div>
	<?php } ?>
					<button class="black"><?= Html::a('View more', ['product/index', 'featured' => 1]) ?></button>
				</div>
			</div>
			<!--			<div class="product-slider">
							<div id="adv_gp_products_4_columns_carousel" class="carousel slide four_shows_one_move gp_products_carousel_wrapper" data-ride="carousel" data-interval="2000">
								========= Wrapper for slides =========
								<div class="carousel-inner" role="listbox">
	<?php
	$index = 0;

	foreach ($featured_products as $featured_product) {
		?>
																											<div class="item <?= $index == 0 ? "active" : "" ?>">
																											<div class="col-xs-12 col-sm-6 col-md-3 gp_products_item">
																											<div class="gp_products_inner">
																											<div class="gp_products_item_image">
																											<a href="<?= Yii::$app->homeUrl; ?>site/product-detail">
																											<img src="<?= Yii::$app->homeUrl; ?>uploads/product/<?= $featured_product->id ?>/profile/<?= $featured_product->canonical_name ?>.<?= $featured_product->profile ?>" alt="1" />
																											</a>
																											<div class="img-overlay"></div>
																											</div>
																											<ul class="text-center">
																											<a href="#"><li><i class="fa fa-facebook"></i></li></a>
																											<a href="#"><li><i class="fa fa-twitter"></i></li></a>
																											<a href="#"><li><i class="fa fa-linkedin"></i></li></a>
																											</ul>
																											<div class="gp_products_item_caption">
																											<ul class="gp_products_caption_name">
																											<li><a href="#"><?= $featured_product->product_name ?></a></li>

		<?php $product_type = Fregrance::findOne($featured_product->product_type); ?>
																											<li><a href="#"><?= $product_type->name; ?></a></li>
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
		<?php
		$index++;
	}
	?>

								</div>

								======= Navigation Buttons =========

								======= Left Button =========
								<a class="left carousel-control gp_products_carousel_control_left" href="#adv_gp_products_4_columns_carousel" role="button" data-slide="prev">
									<span class="fa fa-angle-left gp_products_carousel_control_icons" aria-hidden="true"></span>
									<span class="sr-only">Previous</span>
								</a>

								======= Right Button =========
								<a class="right carousel-control gp_products_carousel_control_right" href="#adv_gp_products_4_columns_carousel" role="button" data-slide="next">
									<span class="fa fa-angle-right gp_products_carousel_control_icons" aria-hidden="true"></span>
									<span class="sr-only">Next</span>
								</a>

							</div> *-*-*-*-*-*-*-*-*-*- END BOOTSTRAP CAROUSEL *-*-*-*-*-*-*-*-*-*
						</div>-->

	        </div>
	<?php
}
?>
	<div class="private-label sec-pad">
		<h1>private label manu facturing</h1>
		<div class="private-bg" style="background-image: url(images/index-private-label-bg.jpg);">
			<div class="container">
				<div class="row">
					<div class="private-cntnt">
						<h2>create your brand</h2>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
						<button class="green">create now</button>
					</div>
				</div>
			</div>

		</div>
	</div>
<?php if (count($international_products) > 0) { ?>
	        <div class="international-brands sec-pad">
			<h1>international brands</h1>
			<div class="product-slider">
				<div id="adv_gp_products_7_columns_carousel" class="carousel slide four_shows_one_move gp_products_carousel_wrapper" data-ride="carousel" data-interval="2000">
					<!--========= Wrapper for slides =========-->
					<div class="carousel-inner" role="listbox">

	<?php
	$z = 0;
	foreach ($international_products as $international) {
		$z++;
		?>
							<div class="item <?php
							if ($z == 1) {
								echo ' active';
							}
							?>">
								<div class="col-xs-12 col-sm-6 col-md-3 gp_products_item">
									<div class="gp_products_inner">
										<div class="gp_products_item_image">
											<a href="<?= Yii::$app->homeUrl . 'product-detail/' . $international->canonical_name ?>">
		<?php
		$product_images = Yii::$app->basePath . '/../uploads/product/' . $international->id . '/profile/' . $international->canonical_name . '.' . $international->profile;
		if (file_exists($product_images)) {
			?>
													<img src="<?= Yii::$app->homeUrl . 'uploads/product/' . $international->id . '/profile/' . $international->canonical_name . '.' . $international->profile ?>" height="100%" alt="1" />
													<?php
												} else {
													?>
													<img src="<?= Yii::$app->homeUrl . 'uploads/product/dummy_perfume.png' ?>" height="100%" alt="1" />
												<?php }
												?>
											</a>
												<?= Html::a(' <div class="img-overlay"></div>', 'product-detail/' . $international->canonical_name, []) ?>
										</div>
										<ul class="text-center">
											<a href="#"><li><i class="fa fa-facebook"></i></li></a>
											<a href="#"><li><i class="fa fa-twitter"></i></li></a>
											<a href="#"><li><i class="fa fa-linkedin"></i></li></a>
										</ul>
										<div class="gp_products_item_caption">
											<ul class="gp_products_caption_name">
												<li><a href="<?= Yii::$app->homeUrl . 'product-detail/' . $international->canonical_name ?>"><?= $international->product_name ?></a></li>
		<?php $product_type = Fregrance::findOne($international->product_type); ?>
												<li><a href="<?= Yii::$app->homeUrl . 'product-detail/' . $international->canonical_name ?>"><?= $product_type->name; ?></a></li>
											</ul>
											<ul class="gp_products_caption_rating">
		<?php
		if ($international->offer_price != "0") {
			$percentage = round(100 - (($international->offer_price / $international->price) * 100));
			?>
													<li>AED <?= $international->offer_price; ?></li>
													<li class="center">AED <?= $international->price; ?></li>
													<li class="pull-right"><a href="#">( <?= $percentage ?>%OFF)</a></li>
			<?php
		} else {
			?>
													<li class="center">AED <?= $international->price; ?></li>
												<?php } ?>
											</ul>
										</div>
									</div>
								</div>
							</div>
	<?php } ?>





					</div>

					<!--======= Navigation Buttons =========-->

					<!--======= Left Button =========-->
					<a class="left carousel-control gp_products_carousel_control_left" href="#adv_gp_products_7_columns_carousel" role="button" data-slide="prev">
						<span class="fa fa-angle-left gp_products_carousel_control_icons" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a>

					<!--======= Right Button =========-->
					<a class="right carousel-control gp_products_carousel_control_right" href="#adv_gp_products_7_columns_carousel" role="button" data-slide="next">
						<span class="fa fa-angle-right gp_products_carousel_control_icons" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a>

				</div> <!--*-*-*-*-*-*-*-*-*-*- END BOOTSTRAP CAROUSEL *-*-*-*-*-*-*-*-*-*-->
			</div>
	        </div>
<?php } ?>

	<div class="blog sec-pad">
		<h1>From our blog</h1>
		<div class="container">
			<div class="row">
<?php
foreach ($from_blogs as $from_blogs) {
	?>
					<div class="blog-box col-md-4 col-sm-4  col-xs-12">
						<div class="img-box">
							<img class="img-responsive" src="<?= Yii::$app->homeUrl ?>uploads/cms/from-blog/<?= $from_blogs->id ?>/large.<?= $from_blogs->image ?>"/>
						</div>
						<h5><?= $from_blogs->title; ?></h5>
						<ul class="date">
							<li><i class="fa fa-calendar-check-o" aria-hidden="true"></i><?= date('M d Y', strtotime($from_blogs->blog_date)) ?></li>
						</ul>
						<p><?= substr($from_blogs->content, 0, 150); ?></p>
	<?php // Html::a('know more', ['blog-detail?id=' . $from_blogs->id])      ?>
	<?= Html::a('know more', ['blog-detail', 'id' => $from_blogs->id]) ?>
					</div>
						<?php
					}
					?>
				<button class="black"><?= Html::a('View more', ['our-blog']) ?></button>

			</div>
		</div>
	</div>

	<div class="newsletter sec-pad">
		<div class="container">
			<div class="row">
				<div style="padding-right: 50px;" class="col-md-7 col-sm-7">
					<h3>Subscribe</h3>
					<h4>our newsletter</h4>
					<p>Subscribe to our newsletter and stay updated on the <br/>exclusive deals  and special offers!</p>
					<div class="col-md-12 col-sm-12 col-xs-12 search">
<?php $form = ActiveForm::begin(); ?>
						<div class="input-group">
<?= $form->field($model, 'email')->textInput(['placeholder' => 'Email Address....', 'class' => 'form-control SearchBar'])->label(FALSE) ?>
							<span class="input-group-btn">
						<?= Html::submitButton('<span class="SearchIcon">Subscribe</span>', ['class' => 'btn btn-defaul SearchButton']) ?>
							</span>
						</div>
								<?php ActiveForm::end(); ?>
					</div>
				</div>
				<div class="col-md-5 col-sm-5">
					<div id="youtube-vid">
<?= $youtube_video->content ?>
					</div>
				</div>
			</div>
		</div>
	</div>

</section>