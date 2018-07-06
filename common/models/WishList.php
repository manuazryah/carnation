<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "wish_list".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $session_id
 * @property integer $product
 * @property string $date
 */
class WishList extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'wish_list';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['user_id', 'product'], 'integer'],
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
            'product' => 'Product',
            'date' => 'Date',
        ];
    }

}
