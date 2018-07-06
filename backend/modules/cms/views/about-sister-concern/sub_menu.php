<?php

use yii\helpers\Html;
?>
<ul class="nav nav-tabs">
    <li >
        <?= Html::a('<span class="visible-xs"><i class="fa-home"></i></span>
							<span class="hidden-xs">About Us</span>', ['/cms/about/update?id=1'], ['class' => '']) ?>

    </li>
    <li>
        <?= Html::a('<span class="visible-xs"><i class="fa-home"></i></span>
							<span class="hidden-xs">Our Strategic Approach</span>', ['/cms/about-our-strategic/index?id=1'], ['class' => '']) ?>

    </li>
    <li class="active">
        <?= Html::a('<span class="visible-xs"><i class="fa-home"></i></span>
							<span class="hidden-xs">Sister Concern</span>', ['/cms/about-sister-concern/index'], ['class' => '']) ?>

    </li>





</ul>