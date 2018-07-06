<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AppointmentWidget
 *
 * @author
 * JIthin Wails
 */

namespace common\components;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use yii\web\NotFoundHttpException;
use common\models\Cart;
use common\models\OrderMaster;
use common\models\OrderDetails;
use common\models\Settings;
use common\models\OrderPromotions;

//use common\models\RecentlyViewed;

class CartSummaryWidget extends Widget {

//    public $id;

    public function init() {
        parent::init();
        if (!isset(Yii::$app->user->identity->id)) {
            return '';
        }
    }

    public function run() {
        $user_id = Yii::$app->user->identity->id;
        $master = OrderMaster::find()->where(['user_id' => Yii::$app->user->identity->id, 'order_id' => Yii::$app->session['orderid']])->andWhere(['not in', 'status', [4, 5]])->one();
        $cart_items = OrderDetails::find()->where(['order_id' => $master->order_id])->all();
//        $subtotal = Cart::total($cart_items);
        $shipping = $master->shipping_charge;
//        $grand_total = $shipping + $subtotal;
        $promotions = OrderPromotions::find()->where(['order_master_id' => $master->id])->sum('promotion_discount');
        return $this->render('cart_summary', ['cart_items' => $cart_items, 'shipping' => $shipping, 'master' => $master, 'promotions' => $promotions]);
//        return $this->render('cart_summary', ['cart_items' => $cart_items, 'shipping' => $shipping, 'subtotal' => $subtotal, 'promotions' => $promotions, 'grand_total' => $grand_total]);
        //return Html::encode($this->message);
    }

}

?>
