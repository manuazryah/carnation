<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "principals".
 *
 * @property integer $id
 * @property string $terms_conditions
 * @property string $privacy_policy
 * @property string $return_policy
 * @property string $faq
 * @property integer $status
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 */
class Principals extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'principals';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['terms_conditions', 'privacy_policy', 'return_policy', 'faq'], 'string'],
            [['status', 'CB', 'UB'], 'integer'],
            [['DOC', 'DOU'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'terms_conditions' => 'Terms Conditions',
            'privacy_policy' => 'Privacy Policy',
             'return_policy' => 'Delivery Information',
		    'payment_policy' => 'Payment Policy',
            'faq' => 'Faq',
            'status' => 'Status',
            'CB' => 'Cb',
            'UB' => 'Ub',
            'DOC' => 'Doc',
            'DOU' => 'Dou',
        ];
    }
}
