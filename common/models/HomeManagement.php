<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "home_management".
 *
 * @property int $id
 * @property int $type
 * @property string $heading
 * @property string $products
 * @property string $image
 * @property int $sort_order
 */
class HomeManagement extends \yii\db\ActiveRecord {

        /**
         * @inheritdoc
         */
        public static function tableName() {
                return 'home_management';
        }

        /**
         * @inheritdoc
         */
        public function rules() {
                return [
                        [['type', 'sort_order'], 'integer'],
                        [['heading', 'image'], 'string', 'max' => 250],
                        [['products'], 'safe'],
                ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels() {
                return [
                    'id' => 'ID',
                    'type' => 'Type',
                    'heading' => 'Heading',
                    'products' => 'Products',
                    'image' => 'Image',
                    'sort_order' => 'Sort Order',
                ];
        }

        public static function Products($id) {

                $designation = explode(',', $id);
                $designations = '';
                $i = 0;
                if (!empty($designation)) {
                        foreach ($designation as $des) {

                                if ($i != 0) {
                                        $designations .= ',';
                                }
                                $designation_name = Product::findOne($des);
                                if(!empty($designation_name)){
                                $designations .= $designation_name->product_name;
                                }else{
                                $designations = '';
                                }
                                $i++;
                        }
                }

                return $designations;
        }

}
