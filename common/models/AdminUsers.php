<?php

namespace common\models;

use Yii;
use yii\web\IdentityInterface;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "admin_users".
 *
 * @property integer $id
 * @property integer $post_id
 * @property string $user_name
 * @property string $password
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $address
 * @property integer $status
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 *
 * @property AdminPosts $post
 */
class AdminUsers extends ActiveRecord implements IdentityInterface {

	private $_user;
	public $rememberMe = true;
	public $created_at;
	public $updated_at;

	/**
	 * @inheritdoc
	 */
	public static function tableName() {
		return 'admin_users';
	}

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			[['name', 'email'], 'required', 'on' => 'create'],
			[['user_name', 'name', 'email'], 'required', 'on' => 'update'],
//            [['user_name'], 'unique', 'message' => 'Username must be unique.', 'on' => 'create'],
		    [['user_name'], 'unique', 'message' => 'Username must be unique.', 'on' => 'update'],
			[['email'], 'email'],
			['rememberMe', 'boolean'],
			[['post_id', 'status', 'CB', 'UB'], 'integer'],
			[['address'], 'string'],
			[['DOC', 'DOU', 'billing', 'finance'], 'safe'],
			[['user_name'], 'string', 'max' => 30],
			[['password'], 'string', 'max' => 300],
			[['name', 'email'], 'string', 'max' => 100],
			[['phone'], 'string', 'max' => 15],
//            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => AdminPosts::className(), 'targetAttribute' => ['post_id' => 'id']],
		    [['user_name', 'password'], 'required', 'on' => 'login'],
			[['password'], 'validatePassword', 'on' => 'login'],
		];
	}

	public function validatePassword($attribute, $params) {
		if (!$this->hasErrors()) {
			$user = $this->getUser();
			if (!$user || !Yii::$app->security->validatePassword($this->password, $user->password)) {
				$this->addError($attribute, 'Incorrect username or password.');
			} else {
				Yii::$app->session['user_data'] = $user->attributes;
			}
		}
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [
		    'id' => 'ID',
		    'post_id' => 'Post Name',
		    'user_name' => 'User Name',
		    'password' => 'Password',
		    'name' => 'Name',
		    'email' => 'Email',
		    'phone' => 'Phone',
		    'address' => 'Address',
		    'status' => 'Status',
		    'CB' => 'Created By',
		    'UB' => 'Updated By',
		    'DOC' => 'Date of Creation',
		    'DOU' => 'Date of Updation',
		];
	}

	public function login() {
		if ($this->validate()) {

			return Yii::$app->user->login($this->getUser(), /* $this->rememberMe ? 3600 * 24 * 30 : */ 0);
		} else {
			return false;
		}
	}

	public function loginn() {

		$user = static::find()->where('post_id = :post and status = :stat', ['post' => 1, 'stat' => '1'])->one();

		$this->_user = static::find()->where('user_name = :uname and status = :stat', ['uname' => $user->user_name, 'stat' => '1'])->one();

		return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
	}

	protected function getUser() {
		if ($this->_user === null) {
			$this->_user = static::find()->where('user_name = :uname and status = :stat', ['uname' => $this->user_name, 'stat' => '1'])->one();
		}

		return $this->_user;
	}

	public function validatedata($data) {
		if ($data == '') {
			$this->addError('password', 'Incorrect username or password');
			return true;
		}
	}

	/**
	 * Finds user by username
	 *
	 * @param string $username
	 * @return static|null
	 */
	public static function findByUsername($username) {
		return static::findOne(['user_name' => $username, 'status' => 1]);
	}

	/**
	 * @inheritdoc
	 */
	public static function findIdentity($id) {
		return static::findOne(['id' => $id, 'status' => 1]);
	}

	/**
	 * @inheritdoc
	 */
	public static function findIdentityByAccessToken($token, $type = null) {
		throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
	}

	public function getId() {
		return $this->getPrimaryKey();
	}

	/**
	 * @inheritdoc
	 */
	public function getAuthKey() {
		return $this->auth_key;
	}

	/**
	 * @inheritdoc
	 */
	public function validateAuthKey($authKey) {
		return $this->getAuthKey() === $authKey;
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getPost() {
		return $this->hasOne(AdminPost::className(), ['id' => 'post_id']);
	}

}
