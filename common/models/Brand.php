<?php

namespace common\models;

use Yii;
use yii\imagine\Image;
use Imagine\Image\Box;

/**
 * This is the model class for table "brand".
 *
 * @property integer $id
 * @property string $brand
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keyword
 * @property string $page_url
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 * @property integer $status
 */
class Brand extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'brand';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['brand'], 'required'],
                        [['brand'], 'unique'],
                        [['CB', 'UB', 'status'], 'integer'],
                        [['DOC', 'DOU', 'meta_title', 'meta_description', 'meta_keyword', 'page_url', 'image'], 'safe'],
                        [['brand'], 'string', 'max' => 200],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'brand' => 'Brand',
                    'meta_title' => 'Meta Title',
                    'meta_description' => 'Meta Description',
                    'meta_keyword' => 'Meta Keyword',
                    'page_url' => 'Page Url',
                    'CB' => 'Cb',
                    'UB' => 'Ub',
                    'DOC' => 'Doc',
                    'DOU' => 'Dou',
                    'status' => 'Status',
                ];
        }

        public function copybrand($path, $model) { 
                Image::thumbnail($path, 150, 75)
                        ->save(\yii::$app->basePath . '/../uploads/cms/brands/' . $model->id . '/small.'  . $model->image, ['quality' => 50]);
                return true;
        }

}
