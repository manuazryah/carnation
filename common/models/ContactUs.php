<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "contact_us".
 *
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $country_code
 * @property string $mobile_no
 * @property integer $country
 * @property string $reason
 * @property string $date
 */
class ContactUs extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'contact_us';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['first_name', 'last_name', 'email', 'reason', 'mobile_no'], 'required'],
                        [['email'], 'email'],
                        [['date'], 'safe'],
                        [['first_name', 'last_name', 'email', 'reason', 'country'], 'string', 'max' => 100],
                        [['country_code', 'mobile_no'], 'string', 'max' => 50],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'first_name' => 'First Name',
                    'last_name' => 'Last Name',
                    'email' => 'Email',
                    'country_code' => 'Country Code',
                    'mobile_no' => 'Mobile No',
                    'country' => 'Country',
                    'reason' => 'Reason',
                    'date' => 'Date',
                ];
        }

}
