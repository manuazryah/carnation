<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "brands".
 *
 * @property int $id
 * @property string $image
 * @property int $status
 * @property int $CB
 * @property int $UB
 * @property string $DOC
 * @property string $DOU
 */
class Brands extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'brands';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['status', 'CB', 'UB'], 'integer'],
                        [['DOC', 'DOU'], 'safe'],
                        [['image'], 'string', 'max' => 250],
                        [['image'], 'required'],
                        [['image'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'image' => 'Image (200*120)',
                    'status' => 'Status',
                    'CB' => 'Cb',
                    'UB' => 'Ub',
                    'DOC' => 'Doc',
                    'DOU' => 'Dou',
                ];
        }

}
