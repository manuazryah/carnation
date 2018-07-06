<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "forgot_password_tokens".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $token
 * @property string $date
 */
class ForgotPasswordTokens extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'forgot_password_tokens';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'token'], 'required'],
            [['user_id'], 'integer'],
            [['date'], 'safe'],
            [['token'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'token' => 'Token',
            'date' => 'Date',
        ];
    }
}
