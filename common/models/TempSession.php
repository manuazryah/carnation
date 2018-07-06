<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "temp_session".
 *
 * @property integer $id
 * @property string $session_id
 * @property integer $user_id
 * @property integer $type_id
 * @property string $value
 */
class TempSession extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'temp_session';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['user_id', 'type_id', 'value'], 'integer'],
                        [['session_id'], 'string', 'max' => 255],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'session_id' => 'Session ID',
                    'user_id' => 'User ID',
                    'type_id' => 'Type ID',
                    'value' => 'Value',
                ];
        }

}
