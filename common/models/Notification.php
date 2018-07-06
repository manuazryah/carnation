<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "notification".
 *
 * @property integer $id
 * @property integer $notification_type
 * @property integer $order_id
 * @property string $content
 * @property string $message
 * @property integer $status
 * @property string $date
 */
class Notification extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notification';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['notification_type', 'order_id', 'status'], 'integer'],
            [['content', 'message'], 'string'],
            [['date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'notification_type' => 'Notification Type',
            'order_id' => 'Order ID',
            'content' => 'Content',
            'message' => 'Message',
            'status' => 'Status',
            'date' => 'Date',
        ];
    }
}
