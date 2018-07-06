<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
//use yii\grid\GridView;
use yii\widgets\ListView;
use yii\helpers\ArrayHelper;
use common\models\Category;
use common\models\SubCategory;
use yii\helpers\Url;

if (isset($meta_title) && $meta_title != '')
        $this->title = $meta_title;
else
        $this->title = 'Carnation';
$this->params['breadcrumbs'][] = $this->title;

?>

<div id="wpo-mainbody" class="container wpo-mainbody ">
        <!--<nav class="woocommerce-breadcrumb" itemprop="breadcrumb"><a class="home" href="index.php">Home</a>&nbsp;/&nbsp;Brand</nav>-->

        <div class="row brands-list">
                <!-- MAIN CONTENT -->
                <div id="wpo-content" class="wpo-content col-xs-12 no-sidebar">
                        <article id="post-8" class="post-8 page type-page status-publish hentry">
                                <div class="content in-brand-section">
                                        <div class="woocommerce">
                                                <div class="brand-index"> <b>Brand Index:</b>
                                                        <a class="index" href="#0"> 0 - 9</a>
                                                        <a class="index" href="#A">A </a>
                                                        <a class="index" href="#B"> B </a>
                                                        <a class="index" href="#C">C </a>
                                                        <a class="index" href="#D">D</a>
                                                        <a class="index" href="#E">E</a>
                                                        <a class="index" href="#F">F </a>
                                                        <a class="index" href="#G">G</a>
                                                        <a class="index" href="#H">H</a>
                                                        <a class="index" href="#I">I</a>
                                                        <a class="index" href="#J">J</a>
                                                        <a class="index" href="#K">K</a>
                                                        <a class="index" href="#L">L</a>
                                                        <a class="index" href="#M">M</a>
                                                        <a class="index" href="#N">N</a>
                                                        <a class="index" href="#O">O</a>
                                                        <a class="index" href="#P">P </a>
                                                        <a class="index" href="#q">Q </a>
                                                        <a class="index" href="#R">R</a>
                                                        <a class="index" href="#S">S</a>
                                                        <a class="index" href="#T">T</a>
                                                        <a class="index" href="#U">U</a>
                                                        <a class="index" href="#V">V</a>
                                                        <a class="index" href="#W">W</a>
                                                        <a class="index" href="#X">X </a>
                                                        <a class="index" href="#Y">Y</a>
                                                        <a class="index" href="#Z">Z</a>
                                                </div>

                                                <div class="barnd-box" id="0">
                                                        <div class="alpha-order">0 - 9</div>
                                                        <div class="row">
                                                                <?php
                                                                
                                                                foreach ($brands as $brand) {
                                                                        $product_image = Yii::$app->basePath . '/../uploads/cms/brands/' . $brand->id . '/large.' . $brand->image;
                                                                        if (file_exists($product_image)) {
                                                                                $first_letter = substr($brand->brand, 0, 1);
                                                                                if (is_numeric($first_letter)) {
                                                                                        ?>
                                                                                        <div class="col-md-2 col-sm-3 brands" >

                                                                                                <a class=" brand-logo" href="<?= Yii::$app->homeUrl . 'product/index?id=' . $brand->id ?>">
                                                                                                        <img src="<?= Yii::$app->homeUrl . 'uploads/cms/brands/' . $brand->id . '/large.' . $brand->image ?>" class="attachment-shop_single wp-post-image img-responsive"  alt="product13"></a>
                                                                                        </div>
                                                                                        <?php
                                                                                }
                                                                                ?>
                                                                                <?php
                                                                        }
                                                                }
                                                                
                                                                ?>
                                                        </div>
                                                </div>
                                                <?php
                                               
                                                foreach (range('A', 'Z') as $char) {
                                                        $query = "SELECT * FROM `brand` WHERE `brand` LIKE '" . $char . "%'";

                                                        $brands = \common\models\Brand::findBySql($query)->all();

                                                        if (count($brands) > 0) {
                                                                ?>
                                                                <div class="barnd-box" id="<?= $char ?>">
                                                                        <div class="alpha-order"><?= $char ?></div>
                                                                        <div class="row">
                                                                                <?php
                                                                                foreach ($brands as $brand) {
                                                                                        $product_image = Yii::$app->basePath . '/../uploads/cms/brands/' . $brand->id . '/large.' . $brand->image;
                                                                                        if (file_exists($product_image)) {
                                                                                                $first_letter = substr($brand->brand, 0, 1);
                                                                                                if ($first_letter == $char || $first_letter == strtolower($char)) {
                                                                                                        ?>
                                                                                                        <div class="col-md-2 col-sm-3 brands" >

                                                                                                                <a class=" brand-logo" href="<?= Yii::$app->homeUrl . 'product/index?id=' . $brand->id ?>">
                                                                                                                        <img src="<?= Yii::$app->homeUrl . 'uploads/cms/brands/' . $brand->id . '/large.' . $brand->image ?>" class="attachment-shop_single wp-post-image img-responsive"  alt="product13"></a>
                                                                                                        </div>
                                                                                                        <?php
                                                                                                }
                                                                                                ?>
                                                                                        <?php } else {
                                                                                                ?>
                                                                                                <div class="col-md-2 col-sm-3 brands" >

                                                                                                        <a class=" brand-logo" href="<?= Yii::$app->homeUrl . 'product/index?id=' . $brand->id ?>">
                                                                                                                <img src="<?= Yii::$app->homeUrl . 'uploads/cms/brands/no-image.jpg' ?>" class="attachment-shop_single wp-post-image img-responsive"  alt="product13"></a>
                                                                                                </div>
                                                                                                <?php
                                                                                        }
                                                                                }
                                                                                ?>
                                                                        </div>
                                                                </div>
                                                        <?php } ?>
                                                        <?php
                                                         // $p++;
                                                }
                                                ?>


                                        </div>
                                </div>
                        </article>
                </div>
        </div>
</div>