<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "currency".
 *
 * @property integer $id
 * @property string $currency_name
 * @property string $currency_symbol
 * @property string $currency_value
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 * @property integer $status
 */
class Currency extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'currency';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['currency_name', 'currency_symbol', 'status'], 'required'],
            [['CB', 'UB', 'status'], 'integer'],
            [['DOC', 'DOU'], 'safe'],
            [['currency_name', 'currency_symbol', 'currency_value'], 'string', 'max' => 255],
            [['currency_name'], 'unique'],
            [['currency_symbol'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'currency_name' => 'Currency Name',
            'currency_symbol' => 'Currency Symbol',
            'currency_value' => 'Currency Value',
            'CB' => 'Cb',
            'UB' => 'Ub',
            'DOC' => 'Doc',
            'DOU' => 'Dou',
            'status' => 'Status',
        ];
    }
}
