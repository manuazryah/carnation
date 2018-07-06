<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "emirates".
 *
 * @property integer $id
 * @property string $name
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property integer $DOU
 * @property integer $status
 */
class Emirates extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'emirates';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['id','status'], 'integer'],
            [['DOC'], 'safe'],
            [['name'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'CB' => 'Cb',
            'UB' => 'Ub',
            'DOC' => 'Doc',
            'DOU' => 'Dou',
            'status' => 'Status',
        ];
    }
}
