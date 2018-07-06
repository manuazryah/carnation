<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sbscribe".
 *
 * @property integer $id
 * @property string $email
 * @property string $date
 * @property integer $status
 */
class Sbscribe extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sbscribe';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email'], 'required'],
            [['date'], 'safe'],
            [['status'], 'integer'],
            [['email'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'date' => 'Date',
            'status' => 'Status',
        ];
    }
}
