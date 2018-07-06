<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\widgets\ListView;
use common\components\EmptyDataWidget;
?>
<div class="content_breadcum">
    <div class="container">
        <ul class="breadcrumb">
            <li><?= Html::a('<i class="fa fa-home"></i>', ['/site/index']) ?></li>
            <li><a href="">My Orders</a></li>
        </ul>
        <h1 class="page-title">My Orders</h1>

    </div>
</div>
<div class="container">
    <div class="row my-account">
        <?= Yii::$app->controller->renderPartial('_leftside_menu'); ?>
        <div id="content" class="col-sm-9 content-myaccount"> 
            <h3 class="title2">My Order History</h3>
            <div class="acordion-tab">
                <!--                <ul class="nav md-pills nav-justified pills-secondary">
                                    <li class="nav-item active">
                                        <a class="nav-link active" data-toggle="tab" href="#tab1" role="tab">Orders</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#tab2" role="tab">Open Orders</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#tab3" role="tab">Canceled Orders</a>
                                    </li>
                                </ul>-->

                <!-- Tab panels -->
                <div class="tab-content">

                    <!--Panel 1-->
                    <div class="tab-pane fade in active" id="tab1" role="tabpanel">
                        <?php
                        if ($dataProvider->totalCount > 0) {
                            ?>
                            <?=
                            ListView::widget([
                                'dataProvider' => $dataProvider,
                                'itemView' => 'my-order-items',
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
                                    <?= EmptyDataWidget::widget(['path' => Yii::$app->homeUrl . 'image/empty-cart.png', 'msg' => 'Your Cart is Empty']) ?>
                                </div>
                                <div class="hidden-lg hidden-md hidden-sm col-xs-12 my-account-cntnt empty-data right-box" style="width: 98%;">
                                    <?= EmptyDataWidget::widget(['path' => Yii::$app->homeUrl . 'image/empty-cart.png', 'msg' => 'Your Cart is Empty']) ?>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="pad-20"></div>
