<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\widgets\ListView;
use common\components\EmptyDataWidget;
?>
<?php
if (isset($meta_title) && $meta_title != '')
    $this->title = $meta_title;
else
    $this->title = 'carnation';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content_breadcum">
    <div class="container">
        <ul class="breadcrumb">
            <li><?= Html::a('<i class="fa fa-home"></i>', ['/site/index']) ?></li>
            <li><a href="">My Wishlist</a></li>
        </ul>
        <h1 class="page-title">My Wishlist</h1>

    </div>
</div>
<div class="container">
    <div class="row my-account">
        <?= Yii::$app->controller->renderPartial('_leftside_menu'); ?>
        <div id="content" class="col-sm-9 content-myaccount">      
            <?php
            if ($dataProvider->totalCount > 0) {
                ?>
                <?=
                ListView::widget([
                    'dataProvider' => $dataProvider,
                    'itemView' => 'my_wish_list',
                    'pager' => [
                        'firstPageLabel' => 'first',
                        'lastPageLabel' => 'last',
                        'prevPageLabel' => '<',
                        'nextPageLabel' => '>',
                        'maxButtonCount' => 3,
                    ],
                ]);
                ?>
                <?php
            } else {
                ?>
                <div class="settings">
                    <div class="col-lg-12 col-md-12 col-sm-12 hidden-xs empty-data right-box" style="width: 98%;">
                        <?= EmptyDataWidget::widget(['path' => Yii::$app->homeUrl . 'image/empty-wishlist.png', 'msg' => 'Your Wishlist is Empty']) ?>
                    </div>
                    <div class="hidden-lg hidden-md hidden-sm col-xs-12 my-account-cntnt empty-data right-box" style="width: 98%;">
                        <?= EmptyDataWidget::widget(['path' => Yii::$app->homeUrl . 'image/empty-wishlist.png', 'msg' => 'Your Wishlist is Empty']) ?>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>
