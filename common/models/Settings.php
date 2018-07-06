<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "settings".
 *
 * @property integer $id
 * @property string $label
 * @property string $value
 * @property string $prefix
 * @property string $DOU
 */
class Settings extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'settings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['label', 'value'], 'required'],
            [['value'], 'number'],
            [['DOU'], 'safe'],
            [['label','prefix'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'label' => 'Label',
            'value' => 'Value',
            'prefix' => 'Prefix',
            'DOU' => 'Dou',
        ];
    }
}
