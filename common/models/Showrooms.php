<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "showrooms".
 *
 * @property integer $id
 * @property string $title
 * @property string $address
 * @property string $email-id
 * @property string $image
 * @property string $map
 * @property integer $status
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 */
class Showrooms extends \yii\db\ActiveRecord {

	/**
	 * @inheritdoc
	 */
	public static function tableName() {
		return 'showrooms';
	}

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			[['address', 'title', 'email'], 'required'],
			[['image'], 'required', 'on' => 'create'],
			[['address'], 'string'],
			[['status', 'CB', 'UB'], 'integer'],
			[['DOC', 'DOU'], 'safe'],
			[['title'], 'string', 'max' => 100],
			[['email', 'image'], 'string', 'max' => 200],
			[['map'], 'string', 'max' => 500],
			[['image'], 'file', 'extensions' => 'png, jpg, jpeg'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [
		    'id' => 'ID',
		    'title' => 'Title',
		    'address' => 'Address',
		    'email' => 'Email ID',
		    'image' => 'Image',
		    'map' => 'Map',
		    'status' => 'Status',
		    'CB' => 'Cb',
		    'UB' => 'Ub',
		    'DOC' => 'Doc',
		    'DOU' => 'Dou',
		];
	}

}
