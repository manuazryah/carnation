<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;

$action = Yii::$app->controller->id . '/' . Yii::$app->controller->action->id;
?>
<div class="col-lg-4 col-md-4 col-sm-12 left-accordation">
    <div class="panel panel-default">
        <div class="panel-body lit-blue">
            <div class="slide-container">
                <div class="list-group" id="mg-multisidetabs">
                    <a href="#" class="list-group-item active-head "><span>Orders</span><span class="glyphicon glyphicon-menu-down mg-icon pull-right"></span></a>
                    <div class="panel list-sub" style="display: block">
                        <div class="panel-body">
                            <div class="list-group">
                                <?= Html::a('<span class="fa fa-caret-left pull-left"></span><span>My orders</span>', ['/myaccounts/my-orders/index'], ['class' => '' . $action == 'my-orders/index' ? 'list-group-item active' : 'list-group-item']) ?>
                            </div>
                        </div>
                    </div>

                    <a href="#" class="list-group-item active-head "><span>My stuff</span><span class="glyphicon glyphicon-menu-down mg-icon pull-right"></span></a>
                    <div class="panel list-sub" style="display: block">
                        <div class="panel-body">
                            <div class="list-group">
                                <?= Html::a('<span class="fa fa-caret-left pull-left"></span><span>My reviews & ratings</span>', ['/myaccounts/user/my-reviews'], ['class' => 'list-group-item']) ?>
                                <?= Html::a('<span class="fa fa-caret-left pull-left"></span><span>My Wishlist</span>', ['/myaccounts/user/wish-list'], ['class' => 'list-group-item']) ?>
                            </div>
                        </div>
                    </div>

                    <a href="#" class="list-group-item active-head "><span>settings</span><span class="glyphicon glyphicon-menu-down mg-icon pull-right"></span></a>
                    <div class="panel list-sub" style="display: block">
                        <div class="panel-body">
                            <div class="list-group">
                                <?= Html::a('<span class="fa fa-caret-left pull-left"></span><span>personal information</span>', ['/myaccounts/user/personal-info'], ['class' => 'list-group-item']) ?>
                                <?= Html::a('<span class="fa fa-caret-left pull-left"></span><span>change password</span>', ['/myaccounts/user/change-password'], ['class' => 'list-group-item']) ?>
                                <?= Html::a('<span class="fa fa-caret-left pull-left"></span><span>addresses</span>', ['/myaccounts/user/user-address'], ['class' => 'list-group-item']) ?>
                                <?php // Html::a('<span class="fa fa-caret-left pull-left"></span><span>profile settings</span>', ['/myaccounts/user/personal-info'], ['class' => 'list-group-item']) ?>
                                <?= Html::a('<span class="fa fa-caret-left pull-left"></span><span>update email/mobile</span>', ['/myaccounts/user/update-contact-info'], ['class' => 'list-group-item']) ?>
                                <?php // Html::a('<span class="fa fa-caret-left pull-left"></span><span>deactivate account</span>', ['/myaccounts/user/personal-info'], ['class' => 'list-group-item'])  ?>
                            </div>
                        </div>
                    </div>

                </div><!-- ./ end list-group -->
            </div><!-- ./ end slide-container -->
        </div><!-- ./ end panel-body -->
    </div><!-- ./ end panel panel-default-->
</div><!-- ./ endcol-lg-6 col-lg-offset-3 -->