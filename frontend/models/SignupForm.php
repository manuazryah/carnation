<?php

namespace frontend\models;

use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model {

        public $email;
        public $password;
        public $first_name;
        public $last_name;
        public $dob;
        public $mobile_no;
        public $country_code;
        public $country;
        public $gender;
        public $password_repeat;
        public $day;
        public $month;
        public $year;
        public $rules = true;
        public $notification = 0;

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        ['email', 'trim'],
                        ['email', 'required'],
                        ['email', 'email'],
                        ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],
                    ['password', 'required'],
                        ['password', 'string', 'min' => 6],
//            [['country', 'gender','mobile_no'], 'integer'],
                    [['first_name', 'last_name'], 'string', 'max' => 50],
                        [['first_name', 'last_name', 'mobile_no'], 'required'],
//            ['rules', 'required', 'requiredValue' => 1, 'message' => 'Please agree the terms and conditions'],
                    ['password_repeat', 'compare', 'compareAttribute' => 'password', 'message' => "Passwords don't match"],
                        ['rules', 'required', 'requiredValue' => 1, 'message' => 'Please agree the terms and conditions'],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'rules' => 'I have read and agree to the Privacy Policy',
                ];
        }

        /**
         * Signs user up.
         *
         * @return User|null the saved model or null if saving fails
         */
        public function signup() {
                $guest = $this->usercheck();
                if ($guest) {
                        return $guest;
                } else {
                        if (!$this->validate()) {
                                return null;
                        }

                        $user = new User();
                        $user->first_name = $this->first_name;
                        $user->last_name = $this->last_name;
                        $user->country = $this->country;
//            $user->gender = $this->gender;
                        $user->country_code = $this->country_code;
                        $user->mobile_no = $this->mobile_no;
                        $user->email = $this->email;
                        $user->email_verification = 0;
                        $user->setPassword($this->password);
                        $user->generateAuthKey();
            $user->save();
                        return $user->save() ? $user : null;
                }
        }

        public function usercheck() {
                $user_guest = User::find()->where(['email' => $this->email, 'usertype' => 2])->one();
                if (!empty($user_guest)) {
                        $user_guest->first_name = $this->first_name;
                        $user_guest->last_name = $this->last_name;
                        $user_guest->country = $this->country;
                        $user_guest->dob = $this->year . '-' . $this->month . '-' . $this->day;
                        $user_guest->gender = $this->gender;
                        $user_guest->country_code = $this->country_code;
                        $user_guest->mobile_no = $this->mobile_no;
                        $user_guest->usertype = 1;
                        $user_guest->email_verification = 0;
                        $user_guest->notification = $this->notification;
                        $user_guest->setPassword($this->password);
                        $user_guest->generateAuthKey();
                        if ($user_guest->save()) {
                                return $user_guest;
                        }
                } else {
                        return FALSE;
                }
        }

}
