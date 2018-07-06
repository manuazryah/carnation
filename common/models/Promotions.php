<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "promotions".
 *
 * @property integer $id
 * @property integer $promotion_type
 * @property string $promotion_code
 * @property integer $product_id
 * @property integer $user_id
 * @property integer $type
 * @property string $amount_range
 * @property integer $time
 * @property string $starting_date
 * @property string $expiry_date
 * @property integer $status
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 */
class Promotions extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'promotions';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['promotion_code'], 'unique'],
                        [['promotion_type', 'type', 'time', 'status', 'CB', 'UB', 'code_usage'], 'integer'],
                        [['price'], 'number'],
                        [['starting_date', 'expiry_date', 'DOC', 'DOU', 'brand'], 'safe'],
                        [['promotion_code', 'amount_range'], 'string', 'max' => 250],
                        [['promotion_type', 'promotion_code', 'code_usage'], 'required', 'on' => 'create'],
                        [['user_id', 'product_id', 'code_used'], 'safe'],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'promotion_type' => 'Promotion Type',
                    'promotion_code' => 'Promotion Code',
                    'product_id' => 'Product ',
                    'user_id' => 'User ',
                    'brand' => 'Brand',
                    'type' => 'Type',
                    'amount_range' => 'Amount Range (Promotion applicable for above)',
                    'time' => 'Time',
                    'starting_date' => 'Starting Date',
                    'expiry_date' => 'Expiry Date',
                    'status' => 'Status',
                    'code_usage' => 'Usage',
                    'code_used' => 'code_used',
                    'CB' => 'Cb',
                    'UB' => 'Ub',
                    'DOC' => 'Doc',
                    'DOU' => 'Dou',
                    'price' => 'Percentage',
                ];
        }

}
