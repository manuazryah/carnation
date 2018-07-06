<?php

/**
 * Description of SetLnguage
 *
 * @author user
 */

namespace common\components;

use Yii;
use yii\base\Component;
use common\models\Cart;

class Cartcount extends Component {
    /*
     * check cookie set or not, if not set default language is Ebglish
     */

    public static function Count() {
        $date = Cart::date();
        Cart::deleteAll('date <= :date', ['date' => $date]);
        if (isset(Yii::$app->user->identity->id)) {
            if (isset(Yii::$app->session['temp_user'])) {
                /*                 * *******Change tempuser cart to login user********* */
                Cart::changecart(Yii::$app->session['temp_user']);
//
            }
        }
        $condition = Cart::usercheck();
        $cart_items = Cart::find()->where($condition)->all();
        if (!empty($cart_items)) {
//                $this->check_product($cart_items);
            $cart_items = Cart::find()->where($condition)->all();
            return count($cart_items);
//            echo count($cart_items);
//            exit;
        } else {
            return '0';
//            echo "0";
//            exit;
        }
    }
    public static function Total() {
        $date = Cart::date();
        Cart::deleteAll('date <= :date', ['date' => $date]);
        $condition = Cart::usercheck();
        $cart_items = Cart::find()->where($condition)->all();
        if (!empty($cart_items)) {
            $cart_total = Cart::total($cart_items);
            return $cart_total;
//            echo count($cart_items);
//            exit;
        } else {
            return '0';
//            echo "0";
//            exit;
        }
    }

//    function date() {
//        $date = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . ' - 8 days'));
//        return $date;
//    }

    /*
     * set cookie
     */
}
