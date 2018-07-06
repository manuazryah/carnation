<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\widgets\ListView;
?>
<?php
if (isset($meta_title) && $meta_title != '')
    $this->title = $meta_title;
else
    $this->title = 'carnation';
?>
<title><?= $this->title ?></title>
<style>
    .summary{
        display: none;
    }
</style>
<div class="pad-20 hide-xs"></div>

<div class="container">
    <div class="breadcrumb">
        <span class="current-page">My orders</span>
        <ol class="path">
            <li><?= Html::a('<span>Home</span>', ['/site/index'], ['class' => '']) ?></li>
            <li><?= Html::a('<span>My account</span>', ['/myaccounts/user/index'], ['class' => '']) ?></li>
            <li class="active">My orders</li>
        </ol>
    </div>
</div>

<div id="our-product" class="my-account">
    <div class="container">
        <?= Yii::$app->controller->renderPartial('_leftside_menu'); ?>

        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 my-account-cntnt">
            <div id="reviews-ratings">
                <?=
                ListView::widget([
                    'dataProvider' => $dataProvider,
                    'itemView' => 'my_reviews',
                    'pager' => [
                        'firstPageLabel' => 'first',
                        'lastPageLabel' => 'last',
                        'prevPageLabel' => '<',
                        'nextPageLabel' => '>',
                        'maxButtonCount' => 3,
                    ],
                ]);
                ?>
            </div>
        </div>

    </div>
</div>

<div class="pad-20"></div>
