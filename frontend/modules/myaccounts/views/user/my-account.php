<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
?>
<?php
if (isset($meta_title) && $meta_title != '')
    $this->title = $meta_title;
else
    $this->title = 'carnation';
?>
<title><?= $this->title ?></title>
<div class="pad-20 hide-xs"></div>

<div class="container">
    <div class="breadcrumb">
        <span class="current-page">My account</span>
        <ol class="path">
            <li><?= Html::a('<span>Home</span>', ['/site/index'], ['class' => '']) ?></li>
            <li class="active">My account</li>
        </ol>
    </div>
</div>

<div id="our-product" class="my-account">
    <div class="container">
        <div class="col-lg-4 col-md-4 col-sm-12 left-accordation">
            <div class="panel panel-default">
                <div class="panel-body lit-blue">
                    <div class="slide-container">
                        <div class="list-group" id="mg-multisidetabs">
                            <a href="#" class="list-group-item active-head "><span>Orders</span><span class="glyphicon glyphicon-menu-down mg-icon pull-right"></span></a>
                            <div class="panel list-sub" style="display: block">
                                <div class="panel-body">
                                    <div class="list-group">
                                        <a href="my-orders.php" class="list-group-item"><span class="fa fa-caret-left pull-left"></span><span>My orders</span></a>
                                    </div>
                                </div>
                            </div>

                            <a href="#" class="list-group-item active-head "><span>My stuff</span><span class="glyphicon glyphicon-menu-down mg-icon pull-right"></span></a>
                            <div class="panel list-sub" style="display: block">
                                <div class="panel-body">
                                    <div class="list-group">
                                        <a href="reviews&ratings.php" class="list-group-item"><span class="fa fa-caret-left pull-left"></span><span>My reviews & ratings</span></a>
                                        <a href="wish-list.php" class="list-group-item"><span class="fa fa-caret-left pull-left"></span><span>My wishlist</span></a>
                                    </div>
                                </div>
                            </div>

                            <a href="#" class="list-group-item active-head "><span>settings</span><span class="glyphicon glyphicon-menu-down mg-icon pull-right"></span></a>
                            <div class="panel list-sub" style="display: block">
                                <div class="panel-body">
                                    <div class="list-group">
                                        <a href="personal-info.php" class="list-group-item"><span class="fa fa-caret-left pull-left"></span><span>personal information</span></a>
                                        <a href="#" class="list-group-item"><span class="fa fa-caret-left pull-left"></span><span>change password</span></a>
                                        <a href="#" class="list-group-item"><span class="fa fa-caret-left pull-left"></span><span>addresses</span></a>
                                        <a href="#" class="list-group-item"><span class="fa fa-caret-left pull-left"></span><span>profile settings</span></a>
                                        <a href="#" class="list-group-item"><span class="fa fa-caret-left pull-left"></span><span>update email/mobile</span></a>
                                        <a href="#" class="list-group-item"><span class="fa fa-caret-left pull-left"></span><span>deactivate account</span></a>
                                    </div>
                                </div>
                            </div>

                        </div><!-- ./ end list-group -->
                    </div><!-- ./ end slide-container -->
                </div><!-- ./ end panel-body -->
            </div><!-- ./ end panel panel-default-->
        </div><!-- ./ endcol-lg-6 col-lg-offset-3 -->

        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 my-account-cntnt">
            <p class="span-msg">The account information has been saved.</p>
            <p class="customer-name">Hello, Customer!</p>
            <p>From  My Account Dashboard you have the ability to view a snapshot of your recent account activity and update your account
                information. Select a link  to view or edit information.</p>
        </div>

    </div>
</div>

<div class="pad-20"></div>
