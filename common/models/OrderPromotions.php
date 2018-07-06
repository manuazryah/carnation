<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order_promotions".
 *
 * @property integer $id
 * @property integer $order_master_id
 * @property integer $promotion_id
 * @property string $promotion_discount
 */
class OrderPromotions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_promotions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_master_id', 'promotion_id'], 'integer'],
            [['promotion_discount'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_master_id' => 'Order Master ID',
            'promotion_id' => 'Promotion ID',
            'promotion_discount' => 'Promotion Discount',
        ];
    }
}
