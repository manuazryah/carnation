<?php

namespace frontend\models;

use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class CartsignupForm extends Model {

    public $email;
    public $first_name;
    public $last_name;
    public $mobile_no;
    public $country_code;
    public $offer = false;
    public $newsletter = 0;

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
            [['mobile_no'], 'safe'],
            [['first_name', 'last_name'], 'string', 'max' => 50],
            [['first_name', 'last_name', 'mobile_no'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'offer' => 'Receive offers from our partners',
            'newsletter' => 'Sign up for our newsletter.',
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup() {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->username = '';
        $user->first_name = $this->first_name;
        $user->last_name = $this->last_name;
        $user->country = '1';
        $user->dob = '00-00-0000';
        $user->gender = '';
        $user->country_code = $this->country_code;
        $user->mobile_no = $this->mobile_no;
        $user->email = $this->email;
        $user->password = '';

        return $user->save() ? $user : null;
    }

}
