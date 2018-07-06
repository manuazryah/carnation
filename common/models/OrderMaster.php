<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order_master".
 *
 * @property integer $id
 * @property string $order_id
 * @property integer $user_id
 * @property string $total_amount
 * @property string $discount_amount
 * @property string $net_amount
 * @property string $order_date
 * @property integer $ship_address_id
 * @property integer $bill_address_id
 * @property integer $currency_id
 * @property string $user_comment
 * @property integer $payment_mode
 * @property integer $admin_comment
 * @property integer $payment_status
 * @property integer $admin_status
 * @property string $doc
 * @property integer $shipping_status
 * @property integer $status
 * @property integer $gift_wrap
 * @property integer $gift_wrap_value
 */
class OrderMaster extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public $order_date_from;
        public $order_date_to;
        public $amount_from;
        public $amount_to;
        public $order_search;
        public $user_search;

        public static function tableName() {
                return 'order_master';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
//                        [['order_id', 'user_id', 'total_amount', 'order_date'], 'required'],
                        [['user_id', 'ship_address_id', 'bill_address_id', 'currency_id', 'payment_mode', 'admin_comment', 'payment_status', 'admin_status', 'shipping_status', 'status'], 'integer'],
                        [['total_amount', 'discount_amount', 'net_amount', 'tax_amount'], 'number'],
                        [['order_date', 'doc', 'gift_wrap', 'gift_wrap_value','invoice_no'], 'safe'],
                        [['user_comment'], 'string'],
//            [['order_id'], 'string', 'max' => 200],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'order_id' => 'Order ID',
                    'user_id' => 'User Name',
                    'total_amount' => 'Total Amount',
                    'discount_amount' => 'Discount Amount',
                    'net_amount' => 'Net Amount',
                    'order_date' => 'Order Date',
                    'ship_address_id' => 'Ship Address ID',
                    'bill_address_id' => 'Bill Address ID',
                    'currency_id' => 'Currency ID',
                    'user_comment' => 'User Comment',
                    'payment_mode' => 'Payment Mode',
                    'admin_comment' => 'Admin Comment',
                    'payment_status' => 'Payment Status',
                    'admin_status' => 'Admin Status',
                    'doc' => 'Doc',
                    'shipping_status' => 'Shipping Status',
                    'status' => 'Status',
                    'gift_wrap' => 'Gift Wrap',
                    'gift_wrap_value' => 'Gift Wrap Value',
                ];
        }

        public static function getOrderTotal() {
                $order = OrderMaster::find()->where(['status' => 4])->andWhere(['<>', 'status', 5])->andWhere(['<>', 'admin_status', 5])->all();
                return count($order);
        }

        public static function getDeliveredTotal() {
                $order = OrderMaster::find()->where(['admin_status' => 4])->andWhere(['!=', 'admin_status', 5])->andWhere(['!=', 'status', 5])->andWhere(['status' => 4])->all();
                return count($order);
        }

        public static function getCanceledTotal() {
                $order = OrderMaster::find()->where(['status' => 5])->andWhere(['admin_status' => 5])->all();
                return count($order);
        }

        public static function getPendingOrderTotal() {
                $order = OrderMaster::find()->where(['admin_status' => 0])->andWhere(['!=', 'admin_status', 5])->andWhere(['!=', 'status', 5])->andWhere(['status' => 4])->all();
                return count($order);
        }

        public static function getAmountTotal($from_date, $to, $field_name) {
                if ($from_date != '' && $to != '') {
                        $from_date = $from_date . ' 00:00:00';
                        $to = $to . ' 60:60:60';
                        return OrderMaster::find()->where(['>=', 'order_date', $from_date])->andWhere(['<=', 'order_date', $to])->sum($field_name);
                } elseif ($from_date != '' || $to != '') {
                        return 0;
                } else {
                        return OrderMaster::find()->sum($field_name);
                }
        }

       public static function getAmountTotals($model, $field_name) {
                $total_amount = 0;
                foreach ($model as $value) {
                        $total_amount += $value->$field_name;
                }
                return $total_amount;
        }

}
