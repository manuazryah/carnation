<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "fregrance".
 *
 * @property integer $id
 * @property string $name
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 * @property integer $status
 */
class Fregrance extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fregrance';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'CB', 'UB', 'DOC'], 'required'],
            [['CB', 'UB', 'status'], 'integer'],
            [['DOC', 'DOU'], 'safe'],
            [['name'], 'string', 'max' => 200],
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
