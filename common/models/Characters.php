<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "characters".
 *
 * @property integer $id
 * @property string $gender
 * @property string $name
 * @property string $price
 * @property string $img
 * @property integer $status
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 */
class Characters extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'characters';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name', 'price', 'gender'], 'required'],
            [['img'], 'required', 'on' => 'create'],
            [['price'], 'number'],
            [['status', 'CB', 'UB'], 'integer'],
            [['DOC', 'DOU', 'gender'], 'safe'],
            [['img'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'gender' => 'Gender',
            'name' => 'Name',
            'price' => 'Price',
            'img' => 'Img',
            'status' => 'Status',
            'CB' => 'Cb',
            'UB' => 'Ub',
            'DOC' => 'Doc',
            'DOU' => 'Dou',
        ];
    }

}
