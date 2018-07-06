<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "map_locations".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $latitude
 * @property string $longitude
 * @property integer $status
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 */
class MapLocations extends \yii\db\ActiveRecord {

	/**
	 * @inheritdoc
	 */
	public static function tableName() {
		return 'map_locations';
	}

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			[['status', 'CB', 'UB'], 'integer'],
			[['DOC', 'DOU'], 'safe'],
			[['title', 'content', 'latitude', 'longitude'], 'required'],
			[['title', 'content', 'latitude', 'longitude'], 'string', 'max' => 500],
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
		    'latitude' => 'Latitude',
		    'longitude' => 'Longitude',
		    'status' => 'Status',
		    'CB' => 'Cb',
		    'UB' => 'Ub',
		    'DOC' => 'Doc',
		    'DOU' => 'Dou',
		];
	}

}
