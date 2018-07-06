<?php

use yii\helpers\Html;

//use yii\widgets\Pjax;
?>
<div class="wpo-sidebar wpo-sidebar-1 col-xs-12 col-sm-4 col-sm-pull-8 col-md-3 col-md-pull-9">
    <div class="sidebar-inner">
        <aside id="woocommerce_product_categories-3" class="widget clearfix woocommerce widget_product_categories sidebar-element">
            <div class="box-heading"><span>Brands</span></div>
            <div id="" class="pic-container" style="overflow:scroll;width: 100%; height:500px;">
                <ul class="product-categories">

                    <!--<li class="cat-item cat-item-238 current-cat cat-parent"><a href="">Brands</a>-->
                    <?php // echo '<pre>'; print_r($submenu); ?>
                    <ul class="children">
                        <form>
                            <?php
                            foreach ($brand_list as $brand) {
                                ?>
                                <li class="cat-item cat-item-239">
                                    <!--<input class="test" type="checkbox" id="<?= $brand->brand ?>" name="vehicle" value="<?= $brand->brand ?>"><label for="<?= $brand->brand ?>"><?= $brand->brand ?></label><br>-->
                                    <?= Html::a(strtoupper($brand->brand), '/product/brand?brand=' . $brand->brand, ['class' => '']) ?>
                                </li>
                            <?php } ?>

                        </form>
                    </ul>
                    <!--</li>-->

                </ul>
            </div>
        </aside>
        <aside id="woocommerce_product_categories-3" class="widget clearfix woocommerce widget_product_categories sidebar-element">
            <div class="box-heading"><span>Fragrances</span></div>
            <div id="" class="pic-container" style="overflow:scroll;width: 100%; height:150px;">
                <ul class="product-categories">

                    <li class="cat-item cat-item-238 current-cat cat-parent"><a href="">Fragrances</a>

                        <ul class="children">
                            <?php
                            foreach ($fragrances as $fragrance) {
                                ?>
                                <li class="cat-item cat-item-239">
                                    <a href="<?= yii::$app->homeUrl . 'product/fragrance?fragrance=' . $fragrance->name ?>"><?= $fragrance->name ?></a>
                                </li>
                            <?php } ?>

                        </ul>
                    </li>

                </ul>
            </div>
        </aside>
        <div data-role="main" class="ui-content">
            <form method="post" action="/action_page_post.php">
                <div data-role="rangeslider">
                    <label for="price-min">Price:</label>
                    <input type="range" name="price-min" id="price-min" value="200" min="0" max="1000">
                    <label for="price-max">Price:</label>
                    <input type="range" name="price-max" id="price-max" value="800" min="0" max="1000">
                </div>
                <input type="submit" data-inline="true" value="Submit">
                <p>The range slider can be useful for allowing users to select a specific price range when browsing products.</p>
            </form>
        </div>

    </div>
</div>
