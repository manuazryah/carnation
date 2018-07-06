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

//use common\models\RecentlyViewed;

class CartDetailWidget extends Widget {

//    public $id;

    public function init() {
        parent::init();
        if (!isset(Yii::$app->user->identity->id)) {
            return '';
        }
    }

    public function run() {
//        $condition = Cart::usercheck();
//        $cart = Cart::find()->where($condition)->all();
        return $this->render('cart_detail'
//                ,['cart_items' => $cart_items, 'subtotal' => $master, 'shipping_limit' => $shipping_limit, 'promotions' => $promotions]
        );
        //return Html::encode($this->message);
    }

}

?>
