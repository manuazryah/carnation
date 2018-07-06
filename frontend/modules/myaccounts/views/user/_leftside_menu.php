<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;

$action = Yii::$app->controller->id . '/' . Yii::$app->controller->action->id;
//echo $action;
//exit;
?>
<aside id="column-left" class="col-sm-3 hidden-xs">
    <div class="box">
        <div class="box-heading"><span>Account</span></div>
        <div class="list-group">
            <?= Html::a('My Account', ['/myaccounts/user/index'], ['class' => '' . $action == 'user/index' ? 'list-group-item active' : 'list-group-item']) ?>
            <?= Html::a('Change Password', ['/myaccounts/user/change-password'], ['class' => '' . $action == 'user/change-password' ? 'list-group-item active' : 'list-group-item']) ?>
            <?= Html::a('Address Book', ['/myaccounts/user/user-address'], ['class' => '' . $action == 'user/user-address' ? 'list-group-item active' : 'list-group-item']) ?>
            <?= Html::a('My Orders', ['/myaccounts/user/my-orders'], ['class' => '' . $action == 'user/my-orders' ? 'list-group-item active' : 'list-group-item']) ?>
            <?= Html::a('My Wishlist', ['/myaccounts/user/wish-list'], ['class' => '' . $action == 'user/wish-list' ? 'list-group-item active' : 'list-group-item']) ?>
            <a class="list-group-item">
                <?= Html::beginForm(['/site/logout'], 'post') ?>
                <?= Html::submitButton('Logout', ['style' => 'border: none;background: #fff;padding: 0px']) ?>
                <?= Html::endForm() ?>
            </a>
        </div>
    </div>
    <span class="latest_default_width" style="display:none; visibility:hidden"></span>
</aside>