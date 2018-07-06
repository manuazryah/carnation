<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_address".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property string $address
 * @property string $landmark
 * @property string $location
 * @property integer $emirate
 * @property integer $post_code
 * @property string $mobile_number
 * @property integer $status
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 */
class UserAddress extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'user_address';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name', 'address', 'location', 'emirate', 'mobile_number'], 'required'],
            [['user_id', 'emirate', 'post_code', 'status', 'CB', 'UB', 'mobile_number'], 'integer'],
            [['address'], 'string'],
            [['DOC', 'DOU', 'country_code'], 'safe'],
            [['name', 'location'], 'string', 'max' => 100],
            [['landmark'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'name' => 'Name',
            'address' => 'Address',
            'landmark' => 'Landmark',
            'location' => 'Location',
            'emirate' => 'Emirate',
            'post_code' => 'Post Code',
            'mobile_number' => 'Mobile Number',
            'status' => 'Status',
            'CB' => 'Cb',
            'UB' => 'Ub',
            'DOC' => 'Doc',
            'DOU' => 'Dou',
        ];
    }

}
