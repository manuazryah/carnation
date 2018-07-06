<?php

namespace frontend\controllers;

use yii;
use common\models\Product;
use common\models\Cart;
use common\models\User;
use frontend\models\CartsignupForm;
use common\models\Settings;
use yii\base\Component;
use yii\db\MigrationInterface;
use yii\di\Instance;
use yii\db\Expression;
use common\models\OrderMaster;
use common\models\OrderDetails;
use common\models\CreateYourOwn;

class CartController extends \yii\web\Controller {

    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function init() {
        date_default_timezone_set('Asia/Kolkata');
    }

    public function actionIndex() {
        return $this->render('index');
    }

    public function actionBuynow() {
        if (yii::$app->request->isAjax) {
            /*             * ************* */
            $canonical_name = Yii::$app->request->post()['product'];
            $qty = Yii::$app->request->post()['qty'];
            $product = Product::find()->where(['canonical_name' => $canonical_name, 'status' => 1])->one();
            if ($product->stock > 0) {
                $condition = Cart::usercheck();
                $user_id = isset(Yii::$app->user->identity->id) ? Yii::$app->user->identity->id : '';


                $cart = Cart::find()->where(['product_id' => $product->id])->andWhere($condition)->one();
                if (!empty($cart)) {
                    $quantity = $cart->quantity + $qty;
                    $stock = Cart::productStock($product->id);
                    $cart->quantity = $quantity;
                    if ($stock >= $quantity) {
                        $cart->save();
                    }
                } else {
                    Cart::add_to_cart($user_id, Yii::$app->session['temp_user'], $product->id, $qty);
                }
                Cart::cart_content();
            } else {
                echo '9';
                exit;
            }
        }
    }

    public function actionMycart() {
        if (isset(Yii::$app->user->identity->id)) {
            if (isset(Yii::$app->session['temp_user'])) {
                Cart::changecart(Yii::$app->session['temp_user']);
            }
        }
        $condition = Cart::usercheck();
        $cart_items = Cart::find()->where($condition)->all();
        if (!empty($cart_items)) {
            Cart::check_product();
            if (isset(Yii::$app->user->identity->id)) {
                \common\models\TempSession::deleteAll(['user_id' => Yii::$app->user->identity->id]);
            }
            if (!isset(Yii::$app->user->identity->id)) {
                yii::$app->session['after_login'] = 'cart/proceed';
            }
            $subtotal = Cart::total($cart_items);
            $shippinng_limit = Settings::findOne(1)->value;
            $ship_charge = Settings::findOne(2)->value;
            $shipping = $shippinng_limit > $subtotal ? $ship_charge : '0';
            $grand_total = $shipping + $subtotal;
            return $this->render('cart', ['cart_items' => $cart_items, 'subtotal' => $subtotal, 'shipping' => $shipping, 'grand_total' => $grand_total, 'ship_charge' => $ship_charge]);
        } else {
            return $this->render('emptycart');
        }
    }

    public function actionGetcartcount() {
        if (yii::$app->request->isAjax) {
            $date = $this->date();
            Cart::deleteAll('date <= :date', ['date' => $date]);
            if (isset(Yii::$app->user->identity->id)) {
                if (isset(Yii::$app->session['temp_user'])) {
                    /*                     * *******Change tempuser cart to login user********* */
                    Cart::changecart(Yii::$app->session['temp_user']);
//
                }
            }
            $condition = Cart::usercheck();
            $cart_items = Cart::find()->where($condition)->all();
            if (!empty($cart_items)) {
//                $this->check_product($cart_items);
                $cart_items = Cart::find()->where($condition)->all();
                echo count($cart_items);
                exit;
            } else {
                echo "0";
                exit;
            }
        }
    }

    public function actionGetcarttotal() {
        if (yii::$app->request->isAjax) {
            $cart_total = \common\components\Cartcount::Total();
            echo sprintf("%0.2f", $cart_total);
            exit;
        }
    }

    public function actionCart_remove() {
        if (yii::$app->request->isAjax) {
            $id = Yii::$app->request->post()['id'];
            $condition = Cart::usercheck();
            $cart_items = Cart::find()->where($condition)->all();
            $cart = Cart::find()->where(['id' => yii::$app->EncryptDecrypt->Encrypt('decrypt', $id)])->andWhere($condition)->one();
            if ($cart) {
                $cart->delete();
            } else {
                echo json_encode(array('msg' => 'failed', 'reason' => 'Cannot find.'));
                exit;
            }
            $contents = Cart::find()->where($condition)->all();
            if (!empty($contents)) {
                if (count($cart_items) != Yii::$app->request->post()['count']) {
                    echo json_encode(array('msg' => 'failed', 'content' => 'empty'));
                    exit;
                } else {
                    Cart::check_cart($condition);
                    $subtotal = Cart::total($contents);
                    $shippinng_limit = Settings::findOne(1)->value;
                    $ship_charge = Settings::findOne(2)->value;
                    $shipping = $shippinng_limit > $subtotal ? $ship_charge : 0;
                    $grandtotal = $shipping + $subtotal;
                    echo json_encode(array('msg' => 'success', 'subtotal' => sprintf('%0.2f', $subtotal), 'grandtotal' => sprintf('%0.2f', $grandtotal), 'shipping' => sprintf('%0.2f', $shipping), 'count' => count($contents)));
                    exit;
                }
//            } else {
//                echo json_encode(array('msg' => 'failed', 'content' => 'empty'));
//                exit;
            } else {
                echo json_encode(array('msg' => 'failed', 'content' => 'empty'));
                exit;
            }
        }
    }

    public function actionRemove_cart() {
        if (yii::$app->request->isAjax) {
            $id = Yii::$app->request->post()['id'];
            $condition = Cart::usercheck();
//        $cart_items = Cart::find()->where($condition)->all();
            $cart = Cart::find()->where(['id' => yii::$app->EncryptDecrypt->Encrypt('decrypt', $id)])->andWhere($condition)->one();
            if ($cart) {
                $cart->delete();
                echo json_encode(array('msg' => 'success', 'href' => Yii::$app->request->referrer));
                exit;
//                return $this->redirect(Yii::$app->request->referrer);
            }
        }
    }

    public function actionFindstock() {
        if (yii::$app->request->isAjax) {
            $cart_id = Yii::$app->request->post()['cartid'];
            $qty = Yii::$app->request->post()['quantity'];
            if (isset($cart_id)) {
                $cart = Cart::findOne(yii::$app->EncryptDecrypt->Encrypt('decrypt', $cart_id));
                if ($qty == 0 || $qty == "") {
                    $qty = 1;
                }
                $product = Product::find()->where(['id' => $cart->product_id, 'status' => '1'])->one();
                if (!empty($product)) {
                    $quantity = $qty > $product->stock ? $product->stock : $qty;
                    if ($product->offer_price == '0' || $product->offer_price == '') {
                        $price = $product->price;
                    } else {
                        $price = $product->offer_price;
                    }
                    $total = $price * $quantity;
                    echo json_encode(array('msg' => 'success', 'quantity' => $quantity, 'total' => sprintf('%0.2f', $total)));
                } else {
                    echo json_encode(array('msg' => 'error', 'quantity' => '', 'total' => sprintf('%0.2f', '0')));
                }
            }
        }
    }

    public function actionUpdatecart() {
        if (yii::$app->request->isAjax) {
            $cart_id = Yii::$app->request->post()['cartid'];
            $qty = Yii::$app->request->post()['quantity'];
            if (isset($cart_id)) {
                $cart = Cart::findone(yii::$app->EncryptDecrypt->Encrypt('decrypt', $cart_id));
                $product = Product::findOne($cart->product_id);
                if ($qty == 0 || $qty == "") {
                    $qty = 1;
                }
                $cart->quantity = $qty > $product->stock ? $product->stock : $qty;
                if ($cart->save()) {
                    $condition = Cart::usercheck();
                    Cart::check_cart($condition);
                    $cart_items = Cart::find()->where($condition)->all();
                    if (!empty($cart_items)) {
                        if (count($cart_items) != Yii::$app->request->post()['count']) {
                            $this->redirect(array('cart/mycart'));
                        }
                        $subtotal = Cart::total($cart_items);
                        $shippinng_limit = Settings::findOne(1)->value;
                        $ship_charge = Settings::findOne(2)->value;
                        $shipping = $shippinng_limit > $subtotal ? $ship_charge : 0;
                        $grandtotal = $shipping + $subtotal;
                        $cart_count = Cart::cart_count();
                    }
                    echo json_encode(array('msg' => 'success', 'subtotal' => sprintf('%0.2f', $subtotal), 'grandtotal' => sprintf('%0.2f', $grandtotal), 'shipping' => sprintf('%0.2f', $shipping), 'cart_count' => $cart_count));
                } else {
                    echo json_encode(array('msg' => 'error', 'content' => 'Cannot be Changed'));
                }
            }
        }
    }

    public function actionProceed() {
        if (isset(Yii::$app->user->identity->id)) {
            yii::$app->session['after_login'] = '';
            $cart = Cart::find()->where(['user_id' => Yii::$app->user->identity->id])->all();
            if (!empty($cart)) {
                $order_id = Cart::checkout();
                Yii::$app->session['orderid'] = $order_id;
                return $this->redirect(array('checkout/promotion'));
            } else {
                return $this->redirect(array('cart/mycart'));
            }
        } else {
            return $this->redirect(array('cart/mycart'));
        }
    }

    public function actionGetcart() {
        if (yii::$app->request->isAjax) {
            Cart::cart_content();
        }
    }

    public function actionRemoveWishlist() {
        if (yii::$app->request->isAjax) {
            $id = Yii::$app->request->post()['wish_list_id'];
            $model = \common\models\WishList::findOne($id);
            $model->delete();
            echo 1;
            exit;
        }
    }
    public function actionSetGiftWrap() {
        if (yii::$app->request->isAjax) {
            $value = Yii::$app->request->post()['value'];
            if ($value == 1) {
                Yii::$app->session['gift_wrap'] = $value;
                return 1;
            } else {
                Yii::$app->session['gift_wrap'] = 0;
                return 0;
            }
        }
    }
     public function actionPromotionCheck() {
        if (Yii::$app->request->isAjax) {
            if (isset(Yii::$app->user->identity->id)) {

                $code = $_POST['code'];
                $promotion_total_amount = $_POST['promotion_amount'];
                if (empty($promotion_total_amount) && $promotion_total_amount == '')
                    $promotion_total_amount = 0;
                $code_exists = \common\models\Promotions::find()->where(['promotion_code' => $code, 'status' => 1])->one();
                $cart_products = Cart::find()->where(['user_id' => Yii::$app->user->identity->id])->all();
                $cart_promotions = \common\models\TempSession::find()->where(['user_id' => Yii::$app->user->identity->id, 'type_id' => 3])->all();
                $cart_amount = Cart::total($cart_products);
                if (count($cart_promotions) < 1) {
                    if (!empty($code_exists)) {
                        $used_code = Cart::UsedCode($_POST['code']); /* check if code used in this order */
                        if ($used_code == 0) {
                            $date_check = Cart::CheckDate($code_exists); /* check code expiry date */
                            if ($date_check == 1) {
                                $used = Cart::CodeUsed($code_exists); /* check code is used or not (in case of single use) */
                                if ($used == 0) {
                                    $exist = Cart::PromotionProduct($code_exists, $code); /* check if that product or user is in this order */
                                    if ($exist == 1) {
                                        $amount_range = Cart::AmountRange($code_exists, $cart_amount); /* check the amount range with order total amount */
                                        if ($amount_range == 0) {

                                            if ($code_exists->promotion_type == 1) {
                                                $condition = Cart::usercheck();
                                                $cart_items = Cart::find()->where($condition)->all();
                                                $price = Cart::Promotionuniqueproduct($code_exists, $code, $cart_items);
                                            } else {
                                                $price = $cart_amount;
                                            }
                                            if ($code_exists->type == 1) {
                                                $promotion_discount = ($price * $code_exists->price) / 100;
                                            } else {
                                                $promotion_discount = $code_exists->price;
                                            }
                                            $promotion_total_amount = $promotion_total_amount + $promotion_discount;
                                            $grand_total = Cart::net_amount($cart_amount, $cart_products);
                                            $overall_grand_total = $grand_total - $promotion_total_amount;
                                            $temp_promotion = Cart::SaveTemp(3, $code_exists->id);
                                            $arr_variable = array('msg' => '7', 'discount_id' => $code_exists->id, 'code' => $code, 'amount' => sprintf("%0.2f", $promotion_discount), 'total_promotion_amount' => sprintf("%0.2f", $promotion_total_amount), 'overall_grand_total' => sprintf("%0.2f", $overall_grand_total), 'temp_session' => $temp_promotion->id);
                                        } else {
                                            $arr_variable = array('msg' => '5', 'amount' => $code_exists->amount_range);
                                        }
                                    } else {
                                        $arr_variable = array('msg' => '4');
                                    }
                                } else {
                                    $arr_variable = array('msg' => '3');
                                }
                            } else {
                                $arr_variable = array('msg' => '2');
                            }
                        } else {
                            $arr_variable = array('msg' => '8');
                        }
                    } else {
                        $arr_variable = array('msg' => '1');
                    }
                } else {
                    $arr_variable = array('msg' => '9');
                }
            } else {
                $arr_variable = array('msg' => '6');
            }
            $data['result'] = $arr_variable;
            echo json_encode($data);
        }
    }

    /*
     * Remove Coupon code
     */

    public function actionPromotionRemove() {
        if (Yii::$app->request->isAjax) {
            $remov_id = $_POST['id'];
            $promo_codes = $_POST['promo_codes'];
            $temp_id = $_POST['temp_id'];

            $codes = explode(',', $promo_codes);
            $cart_products = Cart::find()->where(['user_id' => Yii::$app->user->identity->id])->all();
            $cart_amount = Cart::total($cart_products);
            $promocodes = '';
            $promotion_total_discount = 0;
            $promotion_discount = 0;
            foreach ($codes as $codes) {

                $code_exists = \common\models\Promotions::findOne($codes);
                if (isset($codes) && $codes != '') {
                    if ($remov_id != $codes) {
                        if ($code_exists->type == 1) {
                            $promotion_discount = ($cart_amount * $code_exists->price) / 100;
                        } else {
                            $promotion_discount = $code_exists->price;
                        }
                        $promotion_total_discount += $promotion_discount;
                        $promocodes .= $codes . ',';
                    }
                }
            }
            $temp_session = \common\models\TempSession::findOne($temp_id);
            $temp_session->delete();
            $grand_total = Cart::net_amount($cart_amount, $cart_products);
            $overall_grand_total = $grand_total - $promotion_total_discount;

            $data = array('code' => $promocodes, 'total_promotion_amount' => sprintf("%0.2f", $promotion_discount), 'overall_grand_total' => sprintf("%0.2f", $overall_grand_total));
            echo json_encode($data);
        }
    }

    /*
     * Promotion amount cahnge when quanity change
     */

    public function actionPromotionQuantityChange() {

        if (Yii::$app->request->isAjax && isset(Yii::$app->user->identity->id)) {
            $promo_codes = isset($_POST['promo_codes'])? $_POST['promo_codes'] : '';
            if ($promo_codes) {
                $cart_products = Cart::find()->where(['user_id' => Yii::$app->user->identity->id])->all();
                $cart_amount = Cart::total($cart_products);
                $codes = explode(',', $promo_codes);
                $applied_codes = array();
                $promocodes = '';
                $promotion_total_discount = 0;
                \common\models\TempSession::deleteAll(['user_id' => Yii::$app->user->identity->id, 'type_id' => 3]);
                $c = 0;
                foreach ($codes as $codes) {
                    if (isset($codes) && $codes != '') {
                        $c++;
                        $code_exists = \common\models\Promotions::findOne($codes);
                        $amount_range = Cart::AmountRange($code_exists, $cart_amount);
                        if ($amount_range == 0) {
                            if ($c != 1) {
                                $promocodes .= ',';
                            }
                            $promocodes .= $codes;
                            if ($code_exists->promotion_type == 1) {
                                $condition = Cart::usercheck();
                                $cart_items = Cart::find()->where($condition)->all();
                                $price = Cart::Promotionuniqueproduct($code_exists, $code, $cart_items);
                            } else {
                                $price = $cart_amount;
                            }

                            if ($code_exists->type == 1) {
                                $promotion_discount = ($price * $code_exists->price) / 100;
                            } else {
                                $promotion_discount = $code_exists->price;
                            }

                            $promotion_total_discount += $promotion_discount;
                            $temp_promotion = Cart::SaveTemp(3, $codes);
                            $applied_codes[] = ['discount_id' => $codes, 'code' => $code_exists->promotion_code, 'amount' => sprintf("%0.2f", $promotion_discount), 'temp_session' => $temp_promotion->id];
                        }
                    }
                }

                $grand_total = Cart::net_amount($cart_amount, $cart_products);
                $overall_grand_total = $grand_total - $promotion_total_discount;
                $data = array('promotion' => $applied_codes, 'code' => $promocodes, 'total_promotion_amount' => sprintf("%0.2f", $promotion_discount), 'overall_grand_total' => sprintf("%0.2f", $overall_grand_total), 'promotion_total_discount' => sprintf("%0.2f", $promotion_total_discount), 'cart_amount' => $cart_amount);
                echo json_encode($data);
            }
        }
    }

    /*     * *********************End*********************************************** */

    function date() {
        $date = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . ' - 45 days'));
        return $date;
    }

    /*
     * Add promotion code
     */
}
