<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "from_our_blog".
 *
 * @property integer $id
 * @property string $title
 * * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keyword
 * @property string $blog_date
 * @property string $content
 * @property string $image
 * @property integer $status
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 */
class FromOurBlog extends \yii\db\ActiveRecord {

	/**
	 * @inheritdoc
	 */
	public static function tableName() {
		return 'from_our_blog';
	}

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			[['title', 'content', 'blog_date'], 'required'],
			[['blog_date', 'DOC', 'DOU', 'featured'], 'safe'],
			[['content'], 'string'],
			[['status', 'CB', 'UB'], 'integer'],
			[['title', 'image', 'canonical_name'], 'string', 'max' => 250],
			[['image'], 'file', 'extensions' => 'png, jpg, jpeg'],
			[['meta_description', 'meta_keyword', 'content'], 'string'],
			[['meta_title'], 'string', 'max' => 500],
			[['canonical_name'], 'unique']
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [
		    'id' => 'ID',
		    'title' => 'Title',
		    'meta_title' => 'Meta Title',
                    'canonical_name'=>'Canonical',
		    'meta_description' => 'Meta Description',
		    'meta_keyword' => 'Meta Keyword',
		    'blog_date' => 'Date',
		    'content' => 'Content',
		    'image' => 'Image (750 * 537)',
		    'status' => 'Status',
		    'CB' => 'Cb',
		    'UB' => 'Ub',
		    'DOC' => 'Doc',
		    'DOU' => 'Dou',
		];
	}

}
