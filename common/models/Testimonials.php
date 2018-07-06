<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "testimonials".
 *
 * @property integer $id
 * @property string $image
 * @property string $name
 * @property string $content
 * @property integer $status
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 */
class Testimonials extends \yii\db\ActiveRecord {

	/**
	 * @inheritdoc
	 */
	public static function tableName() {
		return 'testimonials';
	}

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			[['content'], 'string'],
			[['content'], 'required'],
			[['status', 'CB', 'UB'], 'integer'],
			[['DOC', 'DOU'], 'safe'],
			[['image', 'name'], 'string', 'max' => 100],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [
		    'id' => 'ID',
		    'image' => 'Image',
		    'name' => 'Name',
		    'content' => 'Content',
		    'status' => 'Status',
		    'CB' => 'Cb',
		    'UB' => 'Ub',
		    'DOC' => 'Doc',
		    'DOU' => 'Dou',
		];
	}

}
