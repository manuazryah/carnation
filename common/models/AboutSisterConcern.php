<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "about_sister_concern".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $link
 * @property string $image
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 */
class AboutSisterConcern extends \yii\db\ActiveRecord {

	/**
	 * @inheritdoc
	 */
	public static function tableName() {
		return 'about_sister_concern';
	}

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			[['title', 'content', 'CB', 'UB', 'DOC'], 'required'],
			[['content'], 'string'],
			[['CB', 'UB'], 'integer'],
			[['DOC', 'DOU', 'link'], 'safe'],
			[['title'], 'string', 'max' => 200],
			[['image'], 'string', 'max' => 100],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [
		    'id' => 'ID',
		    'title' => 'Title',
		    'content' => 'Content',
		    'link' => 'Link',
		    'image' => 'Image',
		    'CB' => 'Cb',
		    'UB' => 'Ub',
		    'DOC' => 'Doc',
		    'DOU' => 'Dou',
		];
	}

}
