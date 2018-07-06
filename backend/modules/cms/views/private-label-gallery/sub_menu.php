<?php

use yii\helpers\Html;
?>
<ul class="nav nav-tabs">
	<li class="active">
		<?= Html::a('<span class="visible-xs"><i class="fa-home"></i></span>
							<span class="hidden-xs">Gallery</span>', ['/cms/private-label-gallery/update?id=1'], ['class' => '']) ?>

	</li>
	<li>
		<?= Html::a('<span class="visible-xs"><i class="fa-home"></i></span>
							<span class="hidden-xs">How It Works</span>', ['/cms/private-label-how-it-works/index'], ['class' => '']) ?>

	</li>
	<li>
		<?= Html::a('<span class="visible-xs"><i class="fa-home"></i></span>
							<span class="hidden-xs">Benefits</span>', ['/cms/private-label-benefits/index'], ['class' => '']) ?>

	</li>
	<li>
		<?= Html::a('<span class="visible-xs"><i class="fa-home"></i></span>
							<span class="hidden-xs">Our Process</span>', ['/cms/private-label-our-process/index?id=1'], ['class' => '']) ?>

	</li>
	<li>
		<?= Html::a('<span class="visible-xs"><i class="fa-home"></i></span>
							<span class="hidden-xs">Testimonials</span>', ['/cms/testimonials/index'], ['class' => '']) ?>

	</li>
	<li>
		<?= Html::a('<span class="visible-xs"><i class="fa-home"></i></span>
							<span class="hidden-xs">Brands</span>', ['/cms/private-label-logos/index'], ['class' => '']) ?>
	</li>




</ul>