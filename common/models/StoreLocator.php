<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "store_locator".
 *
 * @property integer $id
 * @property string $location
 * @property string $image
 * @property string $detail
 * @property integer $status
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 */
class StoreLocator extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'store_locator';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['location', 'detail'], 'required'],
            [['detail'], 'string'],
            [['status', 'CB', 'UB'], 'integer'],
            [['DOC', 'DOU'], 'safe'],
            [['location'], 'string', 'max' => 200],
            [['image'], 'required', 'on' => 'create'],
//            [['image'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'location' => 'Location',
            'image' => 'Image',
            'detail' => 'Detail',
            'status' => 'Status',
            'CB' => 'Cb',
            'UB' => 'Ub',
            'DOC' => 'Doc',
            'DOU' => 'Dou',
        ];
    }
}
