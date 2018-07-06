<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "recently_viewed".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $session_id
 * @property integer $product_id
 * @property string $date
 */
class RecentlyViewed extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'recently_viewed';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['user_id', 'product_id'], 'integer'],
            [['date', 'session_id'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'session_id' => 'Session ID',
            'product_id' => 'Product ID',
            'date' => 'Date',
        ];
    }

}
