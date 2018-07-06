<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order_details".
 *
 * @property integer $id
 * @property integer $master_id
 * @property integer $order_id
 * @property integer $product_id
 * @property integer $quantity
 * @property string $amount
 * @property string $delivered_date
 * @property string $rate
 * @property string $doc
 * @property integer $status
 */
class OrderDetails extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'order_details';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
                [['master_id', 'order_id', 'product_id', 'quantity', 'amount', 'rate', 'status'], 'required'],
                [['master_id', 'product_id', 'quantity', 'status'], 'integer'],
                [['amount', 'rate', 'tax'], 'number'],
                [['delivered_date', 'doc', 'item_type'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'master_id' => 'Master ID',
            'order_id' => 'Order ID',
            'product_id' => 'Product ID',
            'quantity' => 'Quantity',
            'amount' => 'Amount',
            'delivered_date' => 'Delivered Date',
            'rate' => 'Rate',
            'doc' => 'Doc',
            'status' => 'Status',
        ];
    }

}
