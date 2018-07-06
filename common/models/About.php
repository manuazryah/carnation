<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "about".
 *
 * @property integer $id
 * @property string $index_title
 * @property string $index_content
 * @property string $about_title
 * @property string $about_content
 * @property string $chairman_image
 * @property string $chairman_name
 * @property string $chairman_position
 * @property string $chairman_message
 * @property string $about_image
 * @property integer $CB
 * @property integer $UB
 * @property string $DOC
 * @property string $DOU
 */
class About extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'about';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['index_content', 'about_content', 'chairman_message', 'carnation_history', 'our_vision', 'our_mission'], 'string'],
                        [['CB', 'UB'], 'integer'],
                        [['DOC', 'DOU'], 'safe'],
                        [['index_title', 'about_title', 'chairman_image', 'chairman_name'], 'string', 'max' => 200],
                        [['chairman_position'], 'string', 'max' => 100],
                ];
        }
        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'index_title' => 'Index Title (in home page)',
                    'index_content' => 'Index Content (in home page)',
                    'about_title' => 'About Title (in about page)',
                    'about_content' => 'About Content (in about page)',
                    'chairman_image' => 'Chairman Image (in about page)',
                    'chairman_name' => 'Chairman Name (in about page)',
                    'chairman_position' => 'Chairman Position (in about page)',
                    'chairman_message' => 'Chairman Message (in about page)',
                    'about_image' => 'About Image',
                    'CB' => 'Cb',
                    'UB' => 'Ub',
                    'DOC' => 'Doc',
                    'DOU' => 'Dou',
                ];
        }

}
